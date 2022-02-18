<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller {
public function testando(){
$this->load->model("categories_model");
echo $this->categories_model->getActiveCategories();
}
  public function recupera(){
    $this->load->view('templates/header');
    $this->load->view('site/recupera');
  }
  public function redefine(){
    $this->load->view('templates/header');
    $this->load->view('site/redefine');
  }
  public function email(){
      $this->load->model("reset_model");
      $res = $this->reset_model->alreadyExists2($_POST['email']);
                $this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[60]');

		if ($this->form_validation->run() == FALSE)
		{
					$this->load->view('templates/header');
					$this->load->view('site/recupera');
		}
		else
		{
         		if($res >= 1){

                                 $token = bin2hex(random_bytes(16));
                                 $email = $_POST['email'];
                                 $this->load->config('email');
                                 $this->load->library('email');
            
            $from = $this->config->item('smtp_user');
            $to = $email;
            $subject = "REDEFINIÇÃO DE SENHA";
            $message = "
            <h1>Olá ,".$_POST['email']."!<h1><br>
            <p>Você está recebendo esse e-mail porque solicitou uma redefinição de senha para a sua conta da Staccione.<br>
            Acesse o link abaixo para concluir a solicitação e voltar a ter acesso ao sistema.</p>"."<br>".
            "<a href='http://ambiente-desenvolvimento15.provisorio.ws/gomes/codeigniter/reset/redefine?token=$token&email=$email'>LINK</a>";

            $this->email->set_newline("\r\n");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);

            
            if ($this->email->send()) {
              
              $data = ['email_enviado'=>'EMAIL ENVIADO COM SUCESSO'];
              $this->load->model("reset_model");
              $response = $this->reset_model->alreadyExists($email);
              if(empty($response)){
      // CADASTRA NO BANCO		
                  $dataString = date("Y-m-d H:i:s");// agora
                  $new = array(
                      "email" => $email,
                      "token" => $token,
                      "created_at" => $dataString,
                      // "url" =>"http://localhost/danton/welcome/paginaRedefinicaoSenha?token=$token&email=$email",
                  );
                  $this->reset_model->store($new);		
      // FIM -------------
              }else{
                //substituir registro
                $dataString = date("Y-m-d H:i:s");// agora
                $new = array(
                    "email" => $email,
                    "token" => $token,
                    "created_at" => $dataString,
                    // "url" =>"http://localhost/danton/welcome/paginaRedefinicaoSenha?token=$token&email=$email",
                );
                $this->reset_model->deleteAfterResetPassword($email);	// deleta pq ja existe uma solicitaçao
                $this->reset_model->store($new);	
              }

              $this->load->view('templates/header');
              $this->load->view('site/recupera',$data);
            
            } else {
                show_error($this->email->print_debugger());
            }
         }else{
              $data = ['email_inexistente'=>"Este email nao existe na base de dados, dra. Fernanda ;)"];
	      $this->load->view('templates/header');
              $this->load->view('site/recupera',$data);
         }

    }// fim else


		
  }

  public function redefinir(){
    $this->load->model("reset_model");
    $response = $this->reset_model->isExpired($_POST['senderEmail']);
    $tokenDoBanco = $response[0]['token'];

$created_at = $response[0]['created_at'];
    $email = $response[0]['email'];
    //$url = $response[0]['url'];

    $senderToken = $_POST['senderToken'];
        if($senderToken == $tokenDoBanco && $_POST['senderEmail'] == $email){
          $dataString = date("Y-m-d H:i:s");// agora
          $nowInTime = new DateTime($dataString);	
          $diferença = $nowInTime->diff(new DateTime($created_at));
                if($diferença->h >= 3){
                    //link expirou
                    $data = ['link_expirado'=>'O LINK EXPIROU.SOLICITE NOVO E-MAIL.'];
                    $this->load->view('templates/header');
                    $this->load->view('site/redefine',$data);
                }else{
                  //atualiza senha
                  $this->load->library('form_validation');
                  $this->form_validation->set_rules('senderSenha', 'Password', 'trim|required|min_length[8]');
                  $this->form_validation->set_rules('senderConfirmarSenha', 'Password Confirmation', 'trim|required|matches[senderSenha]');
                    if ($this->form_validation->run() == FALSE)
                    {
                      $data = ['token'=>$tokenDoBanco,'email'=>$email];
                      $this->load->view('templates/header');
                      $this->load->view('site/redefine',$data);
                      
                    }
                    else{
                      $novaSenha =  md5($_POST['senderSenha']);
                      $this->reset_model->resetPassword($email,$novaSenha);
                      $this->reset_model->deleteAfterResetPassword($email);

                      $data = ['senha_redefinida'=>'SENHA REDEFINIDA COM SUCESSO','reset' => 'TRUE'];
                      $this->load->view('templates/header');
                      $this->load->view('site/redefine',$data);
                      
                    }
                }
        }else{
          // credenciais invalidas
          $data = ['credenciais_invalidas'=>'CREDENCIAIS INVÁLIDAS'];
          $this->load->view('templates/header');
          $this->load->view('site/redefine',$data);
    
        }
  }
}
?>

