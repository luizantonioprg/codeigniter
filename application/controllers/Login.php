<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  public function index(){

    if($_SESSION['loggedin']['privilegio']=='USUÁRIO'):
    $this->load->model("categories_model");
    $this->load->model("planos_model");
    $this->load->model("reservas_model");
    $this->load->model("user_model");
    $this->load->model("pagamentos_model");
    

  
    $data = ['categorias'=>$this->categories_model->getActiveCategories(),'planos'=>$this->planos_model->getAll(),'reservas'=>$this->reservas_model->getAllReservasDoUsuario($this->user_model->user_id($_SESSION['loggedin']['email'])),'id_do_usuario'=>$this->user_model->user_id($_SESSION['loggedin']['email']),'pagamentos'=>$this->pagamentos_model->getSpecific($this->user_model->user_id($_SESSION['loggedin']['email']))];
    $this->load->view('templates/header');
    $this->load->view('dashboard/dashboarduser',$data);
    else:
      $this->load->model("user_model");
      $this->load->model("categories_model");
      $this->load->model("parking_model");
      $this->load->model("planos_model");
      $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getAll(),'usuarios'=>$this->user_model->getAll()];
      $this->load->view('templates/header');
      $this->load->view('dashboard/dashboardadmin',$data);

    endif;
  }
	public function signIN(){
		$this->load->model("login_model");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[60]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[8]');

		if ($this->form_validation->run() == FALSE)
		{
      $this->load->helper('cookie');
      setcookie('n4Ka2LP',true);

      $this->load->model("categories_model");
      $data = ['categorias'=>$this->categories_model->getActiveCategories()];

			$this->load->view('templates/header');
			$this->load->view('site/index',$data);
			
		}
		else
		{
      setcookie("n4Ka2LP", "", time() - 3600);// unset
      $email = $_POST['email'];
      $senha = md5($_POST['senha']);
      $user = $this->login_model->findUser($email,$senha);

      if($user['privilegio']== 'USUÁRIO'){
        $this->session->set_userdata("loggedin",$user);
        $this->load->model("categories_model");
        $this->load->model("planos_model");
        $this->load->model("reservas_model");
        $this->load->model("user_model");
        $this->load->model("pagamentos_model");
        $data = ['categorias'=>$this->categories_model->getActiveCategories(),'planos'=>$this->planos_model->getAll(),'reservas'=>$this->reservas_model->getAllReservasDoUsuario($this->user_model->user_id($_SESSION['loggedin']['email'])),'id_do_usuario'=>$this->user_model->user_id($this->user_model->user_id($_SESSION['loggedin']['email'])),'pagamentos'=>$this->pagamentos_model->getSpecific($this->user_model->user_id($_SESSION['loggedin']['email']))];
        $this->load->view('templates/header');
        $this->load->view('dashboard/dashboarduser',$data);
      }else if($user['privilegio']== 'ADMIN'){
        $this->session->set_userdata("loggedin",$user);
        $this->load->model("user_model");
        $this->load->model("categories_model");
        $this->load->model("parking_model");
        $this->load->model("planos_model");
        $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll()];
        $this->load->view('templates/header');
        $this->load->view('dashboard/dashboardadmin',$data);

      }else{
        $this->load->helper('cookie');
        setcookie('n4Ka2LP',true);
  
        $this->load->model("categories_model");
        $data = ['categorias'=>$this->categories_model->getActiveCategories(),'credenciais_invalidas'=>'CREDENCIAIS INVÁLIDAS'];
  
        $this->load->view('templates/header');
        $this->load->view('site/index',$data);
      }
    
    }
  }


}