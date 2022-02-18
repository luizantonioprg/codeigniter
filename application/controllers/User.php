<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
  public function info(){
    $this->load->model("user_model");
    header('Content-Type: application/json');
    echo json_encode( $this->user_model->user($_GET['id']) );
  }
  public function edit(){
    $id = $_POST['id_usuario'];

    $this->load->model('user_model');
    $arr = $this->user_model->user($id);
    foreach($arr as $item):
      $emailDoBanco = $item->email;
    endforeach;

    $this->load->library('form_validation');
    $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[60]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[60]');
    $this->form_validation->set_rules('senha', 'Nova Senha', 'trim|min_length[8]|max_length[100]');
    $this->form_validation->set_rules('confirmar', 'Confirmar Nova Senha', 'trim|matches[senha]');

    if ($this->form_validation->run() == FALSE)
    {
          $this->load->helper('cookie');
          setcookie('p4VkYpf',true);
          $this->load->model("categories_model");
          $this->load->model("user_model");
          $this->load->model("planos_model");
          $this->load->model('reservas_model');
          $this->load->model('pagamentos_model');
          $data = ['categorias'=>$this->categories_model->getActiveCategories(),'id_do_usuario'=>$this->user_model->user_id($_SESSION['loggedin']['email']),'planos'=>$this->planos_model->getAll(),'reservas'=>$this->reservas_model->getAllReservasDoUsuario($id),'pagamentos'=>$this->pagamentos_model->getSpecific($this->user_model->user_id($_SESSION['loggedin']['email']))];
          $this->load->view('templates/header');
          $this->load->view('dashboard/dashboarduser',$data);
    }
    else
    {
      if($_POST['email'] == $emailDoBanco){
        setcookie("p4VkYpf", "", time() - 3600);
        setcookie('OOpTqs',true);
  
  
          if(!empty($_POST['senha']) && !empty($_POST['confirmar'])){
            $user = array(
              "nome" => $_POST['nome'],
              "email" => $_POST['email'],
              "senha" => md5($_POST['confirmar']),
            );
          }else{
            $user = array(
              "nome" => $_POST['nome'],
              "email" => $_POST['email']
            );
          }
  
  
          $this->load->model('user_model');
          $this->load->model("planos_model");
          $this->load->model('categories_model');
          $this->load->model('reservas_model');
          $this->load->model('pagamentos_model');
          $this->user_model->update_user($id,$user);
  
          
          $data = ['usuario_atualizado' =>'DADOS ATUALIZADOS COM SUCESSO','categorias'=>$this->categories_model->getActiveCategories(),'id_do_usuario'=>$this->user_model->user_id($_SESSION['loggedin']['email']),'planos'=>$this->planos_model->getAll(),'reservas'=>$this->reservas_model->getAllReservasDoUsuario($id),'pagamentos'=>$this->pagamentos_model->getSpecific($this->user_model->user_id($_SESSION['loggedin']['email']))];
          $this->load->view('templates/header');
          $this->load->view('dashboard/dashboarduser',$data);
      }else{
        $this->load->model('user_model');
        $this->load->model("planos_model");
        $this->load->model('categories_model');
        $this->load->model('reservas_model');
        $this->load->model('pagamentos_model');
        $data = ['email_invalido' =>'EMAIL INVÁLIDO','categorias'=>$this->categories_model->getActiveCategories(),'id_do_usuario'=>$this->user_model->user_id($_SESSION['loggedin']['email']),'planos'=>$this->planos_model->getAll(),'reservas'=>$this->reservas_model->getAllReservasDoUsuario($id),'pagamentos'=>$this->pagamentos_model->getSpecific($this->user_model->user_id($_SESSION['loggedin']['email']))];
        $this->load->view('templates/header');
        $this->load->view('dashboard/dashboarduser',$data); 
      }    
     
    }
  }

  public function signUP(){

    $this->load->library('email');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome_signup', 'Nome', 'trim|required|min_length[3]|max_length[60]');
		$this->form_validation->set_rules('email_signup', 'Email', 'trim|required|valid_email|max_length[60]|is_unique[users.email]');
		$this->form_validation->set_rules('senha_signup', 'Senha', 'trim|required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('confirmar_senha_signup', 'Confirmar Senha', 'trim|required|matches[senha_signup]');

		if ($this->form_validation->run() == FALSE)
		{
      setcookie('4kPoqKKam',true);
			$this->load->view('templates/header');
			$this->load->view('site/index');
			
		}
		else
		{
      setcookie("4kPoqKKam", "", time() - 3600);
      
			$this->load->model("user_model");
			$user = array(
        "nome" => $_POST['nome_signup'],
				"email" => $_POST['email_signup'],
				"senha" => md5($_POST['senha_signup']),
				"privilegio" => "USUÁRIO",  
			);
			$this->user_model->store($user);


      $this->db->initialize(); 
      $this->session->set_userdata("loggedin",$user);
      $this->load->model("categories_model");
      $this->load->model("user_model");
      $this->load->model("planos_model");
      $this->load->model("reservas_model");
      $this->load->model('pagamentos_model');




      $data = ['categorias'=>$this->categories_model->getActiveCategories(),'id_do_usuario'=>$this->user_model->user_id($_SESSION['loggedin']['email']),'planos'=>$this->planos_model->getAll(),'reservas'=>$this->reservas_model->getAllReservasDoUsuario($this->user_model->user_id($_SESSION['loggedin']['email'])),'pagamentos'=>$this->pagamentos_model->getSpecific($this->user_model->user_id($_SESSION['loggedin']['email']))];
      $this->load->view('templates/header');
      $this->load->view('dashboard/dashboarduser',$data);
    }
  }
  public function logout(){
		$this->session->unset_userdata("loggedin");
		redirect("/");
	}
   public function integra(){
    // print_r($_GET);
    $this->load->model("parking_model");
    $_SESSION['estac_titulo'] = $_GET['titulo'];
    if(empty($this->parking_model->dataparking($_GET['titulo']))){
      redirect('/');
    }else{
      // nova
    $vagas_multidatepicker = array();
    $titulo = $_GET['titulo'];
    $this->load->model('parking_model');
    $id_estacionamento = $this->parking_model->getId($titulo);
    
    //pegar as datas
        $datas = $this->parking_model->getDatas($titulo);
        $datasArr = explode(",",$datas);
    //usar metodo disponibilidadeNovo
        for($i =0;$i<sizeof($datasArr);$i++){
$current_date = trim($datasArr[$i]," ");
          $select = "SELECT * FROM `reservas` WHERE data like '%$current_date%' and id_estacionamento=$id_estacionamento";
          $vagas_ja_reservadas = intval($this->parking_model->disponibilidadeNovo($select));
          //usar metodo vagasNovo (titulo)
          $capacidade_total_diaria =intval($this->parking_model->vagas($id_estacionamento)) ;
          // subtrair total - disponibilidade, se ok, coloca na array
          if($capacidade_total_diaria - $vagas_ja_reservadas > 0){
              array_push($vagas_multidatepicker,$datasArr[$i]);
          }
        }
$this->load->model('user_model');
// $data = ['estacionamento'=> $this->parking_model->getDatas($titulo),'titulo'=> $titulo,'info'=>  $this->parking_model->dataparking($titulo),'vagas'=>$vagas_multidatepicker,id_do_usuario'=>$this->user_model->user_id($_SESSION['loggedin']['email'];
      // nova
      $data = ['estacionamento'=>$this->parking_model->dataparking($_GET['titulo']),'vagas'=>$vagas_multidatepicker,'id_do_usuario'=>$this->user_model->user_id($_SESSION['loggedin']['email'])];
      $this->load->view('templates/header');
      $this->load->view('site/integra',$data);
    }
  }// fim funcao integra

  /* ADMIN */
  public function allParkings(){
    $this->load->model('parking_model');
    $arr= $this->parking_model->getAll();
    header('Content-Type: application/json');
    echo json_encode($arr);
  }
  public function specificParking(){
    $titulo = $_GET['titulo'];
    $this->load->model('parking_model');
    $arr= $this->parking_model->dataparking($titulo);
    header('Content-Type: application/json');
    echo json_encode($arr);
    
  }

  public function allReservas(){
    $this->load->model('reservas_model');
    $arr= $this->reservas_model->getAll();
    header('Content-Type: application/json');
    echo json_encode($arr);
    
  }
  public function allPagamentos(){
    $this->load->model('pagamentos_model');
    $arr= $this->pagamentos_model->getAll();
    header('Content-Type: application/json');
    echo json_encode($arr);
    
  }
  public function cadastrar_usuario(){
    $this->load->library('form_validation');
		$this->form_validation->set_rules('nome2', 'Nome', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('email2', 'Email', 'trim|required|valid_email|max_length[60]|is_unique[users.email]');
		$this->form_validation->set_rules('senha2', 'Senha', 'trim|required|min_length[8]|max_length[60]');
    $this->form_validation->set_rules('privilegio', 'Privilegio', 'trim|required');
		$this->form_validation->set_rules('confirmar_senha2', 'Confirmar Senha', 'trim|required|matches[senha2]');

		if ($this->form_validation->run() == FALSE)
		{
      $this->load->helper('cookie');
      $this->load->model("parking_model");
      $this->load->model("planos_model");
      $this->load->model("categories_model");
      $this->load->model("user_model");
      $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=> $this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll()];
      setcookie('TTTlpq',true);
			$this->load->view('templates/header');
			$this->load->view('dashboard/dashboardadmin',$data);
			
		}
		else
		{
			setcookie('TTTlpqSUCESS',true);
			$this->load->model("user_model");
			$user = array(
        "nome" => $_POST['nome2'],
				"email" => $_POST['email2'],
				"senha" => md5($_POST['senha2']),
				"privilegio" => $_POST['privilegio'],
			);
			$this->user_model->store($user);
      $this->load->model("parking_model");
      $this->load->model("planos_model");
      $this->load->model("categories_model");
      $this->load->model("user_model");

			$data = ['usuario_cadastrado'=>'USUARIO CADASTRADO COM SUCESSO','estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=> $this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll()];
			$this->load->view('templates/header');
			$this->load->view('dashboard/dashboardadmin',$data);
  }
}
  public function editar_planos(){
    $this->load->library('form_validation');
		// $this->form_validation->set_rules('titulo', 'Titulo', 'trim|required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|max_length[150]');
		$this->form_validation->set_rules('rendimento', 'Rendimento', 'trim|required|integer');

		if ($this->form_validation->run() == FALSE)
		{
      $this->load->helper('cookie');
      setcookie('QQQomdaw',true);
      $this->load->model("parking_model");
      $this->load->model("planos_model");
      $this->load->model("categories_model");
      $this->load->model("user_model");
      $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=> $this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll()];
    
			$this->load->view('templates/header');
			$this->load->view('dashboard/dashboardadmin',$data);
			
		}
		else
		{
      $this->load->helper('cookie');
      setcookie('QQQomdaw',true);
      $id = $_POST['id_plano'];
      $arr = array(
        "descrição" => $_POST['descricao'],
        "rendimento" => $_POST['rendimento'],
        
      );
      $this->load->model("parking_model");
      $this->load->model("planos_model");
      $this->load->model("categories_model");
      $this->load->model("user_model");
      $this->planos_model->update($id,$arr);
      $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'plano_atualizado'=>"PLANO ATUALIZADO COM SUCESSO",'categorias'=> $this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll()];
      
			$this->load->view('templates/header');
			$this->load->view('dashboard/dashboardadmin',$data);
    }
  }
public function teste(){
$this->load->model("categories_model");
print_r($this->categories_model->category_info(8));
}
 public function editar_categoria(){
    $id = $_POST['id_categoria'];
    $this->load->library('form_validation');
    $this->form_validation->set_rules('titulo_categoria', 'Titulo', 'trim|required|max_length[50]');

		if ($this->form_validation->run() == FALSE)
		{
      //setcookie('pLOFFTO',true);
      // $this->load->model("parking_model");
      // $this->load->model("planos_model");
      // $this->load->model("categories_model");
      // $this->load->model("user_model");
      // $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getAll(),'usuarios'=>$this->user_model->getAll()];
      $this->load->model("categories_model");
      $data = ['categoria'=>$this->categories_model->category_info($_POST['id_categoria'])];
      $this->load->view('templates/header');
      $this->load->view('dashboard/editar_categoria',$data);
    }else{
// aqui luiz
$titulo_b = "";
$this->load->model("categories_model");
foreach($this->categories_model->category_info($_POST['id_categoria']) as $item){
	$titulo_b = $item->titulo;
}

            if($_POST['titulo_categoria'] == $titulo_b){

            $data = ['categoria_atualizada_mesmo_titulo'=>"Atualizado.O novo título é igual ao anterior.Procure ajuda 192",'categoria'=>$this->categories_model->category_info($_POST['id_categoria'])];
                        
            $this->load->view('templates/header');
            $this->load->view('dashboard/editar_categoria',$data);
return;
		}
		
            
    
      $this->load->model("categories_model");
      $todasCategorias = $this->categories_model->getAll();
      foreach($todasCategorias as $item):
          if(strtoupper($item->titulo) == strtoupper($_POST['titulo_categoria'])):
            //setcookie('pLOFFTO',true);
            $this->load->model("parking_model");
            $this->load->model("planos_model");
            $this->load->model("categories_model");
            $this->load->model("user_model");
            // $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'titulo_existe'=>"TITULO JÁ EXISTENTE",'categorias'=>$this->categories_model->getAll(),'usuarios'=>$this->user_model->getAll()];

            $data = ['titulo_existe'=>"TITULO JÁ EXISTENTE",'categoria'=>$this->categories_model->category_info($_POST['id_categoria'])];
                        
            $this->load->view('templates/header');
            $this->load->view('dashboard/editar_categoria',$data);
           return;
          endif;
        endforeach;

          
      
         
           // setcookie('pLOFFTO',true);
            $arr = array(
              "titulo" => $_POST['titulo_categoria'],
            );
            $this->load->model("categories_model");
            $this->categories_model->update($id,$arr);
        
        
            $this->load->model("parking_model");
            $this->load->model("planos_model");
            $this->load->model("categories_model");
            $this->load->model("user_model");
            $this->categories_model->update($id,$arr);
            $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categoria_atualizada'=>"CATEGORIA ATUALIZADA",'categorias'=>$this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll()];


            $data = ['categoria_atualizada'=>"CATEGORIA ATUALIZADA",'categoria'=>$this->categories_model->category_info($_POST['id_categoria'])];
            
            $this->load->view('templates/header');
            $this->load->view('dashboard/editar_categoria',$data);
          

     
    }
   
  }
  public function deletar_categoria(){
    $id = $_POST['id_categoria'];
    $this->load->model("categories_model");
    $this->categories_model->delete($id);
    setcookie('TRAtrad',true);
    $this->load->model("parking_model");
    $this->load->model("planos_model");
    $this->load->model("categories_model");
    $this->load->model("user_model");
    
    $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categoria_deletada'=>"CATEGORIA DELETADA",'categorias'=>$this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll()];
    
    $this->load->view('templates/header');
    $this->load->view('dashboard/dashboardadmin',$data);
  }
  public function cadastrar_categoria(){
  
    $this->load->library('form_validation');
    $this->form_validation->set_rules('titulo_categoria', 'Titulo', 'trim|required|max_length[50]|is_unique[categories.titulo]');

		if ($this->form_validation->run() == FALSE)
		{
      setcookie('PapKolo',true);
      $this->load->model("parking_model");
      $this->load->model("planos_model");
      $this->load->model("categories_model");
      $this->load->model("user_model");
      $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll()];
      
      $this->load->view('templates/header');
      $this->load->view('dashboard/dashboardadmin',$data);
    }else{
      setcookie('PapKolo',true);
      $categoria = array(
        "titulo" => $_POST['titulo_categoria'],
      );
      $this->load->model("parking_model");
      $this->load->model("planos_model");
      $this->load->model("user_model");
      $this->load->model("categories_model");
      $this->categories_model->store($categoria);
      $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getActiveCategories(),'categoria_cadastrada'=>"CATEGORIA CADASTRADA COM SUCESSO",'usuarios'=>$this->user_model->getAll()];
      
      $this->load->view('templates/header');
      $this->load->view('dashboard/dashboardadmin',$data);

    }


  }
  public function editar_usuario(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[50]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]');
    $this->form_validation->set_rules('senha', 'Senha', 'trim|required|max_length[50]');
    $this->form_validation->set_rules('privilegio', 'Privilégio', 'trim|required|max_length[10]');

		if ($this->form_validation->run() == FALSE)
		{
      //setcookie('PimpTOK',true);
      // $this->load->model("parking_model");
      // $this->load->model("planos_model");
      // $this->load->model("categories_model");
      // $this->load->model("user_model");
      // $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getAll(),'usuarios'=>$this->user_model->getAll()];
      
      // $this->load->view('templates/header');
      // $this->load->view('dashboard/dashboardadmin',$data);

      $this->load->model('user_model');
      $data = ['usuario'=>$this->user_model->user_info($_POST['id_usuario'])];
      $this->load->view('templates/header');
      $this->load->view('dashboard/editar_usuario',$data);
    }else{
      $this->load->model("user_model");
      $id = $_POST['id_usuario'];
      $email_do_usuario = $this->user_model->getEmail($id);
      foreach($this->user_model->getAll() as $item):
        if($_POST['email']== $item->email && $_POST['email'] !== $email_do_usuario):
          // setcookie('PimpTOK',true);
          // $this->load->model("parking_model");
          // $this->load->model("planos_model");
          // $this->load->model("categories_model");
          // $this->load->model("user_model");
          // $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getAll(),'usuarios'=>$this->user_model->getAll(),'email_invalido'=>"ESSE EMAIL JA ESTA SENDO USADO"];
          
          // $this->load->view('templates/header');
          // $this->load->view('dashboard/dashboardadmin',$data);
            $this->load->model('user_model');
            $data = ['usuario'=>$this->user_model->user_info($_POST['id_usuario']),'email_invalido'=>"ESSE EMAIL JA ESTA SENDO USADO"];
            $this->load->view('templates/header');
            $this->load->view('dashboard/editar_usuario',$data);
          return;
        endif;
      endforeach;
      //setcookie('PimpTOK',true);
      $id = $_POST['id_usuario'];
      if(isMd5($_POST['senha'])==0){
        $usuario = array(
          "nome" => $_POST['nome'],
          "email" => $_POST['email'],
          "senha" => md5($_POST['senha']),
          "privilegio" => $_POST['privilegio'],
        );
      }else{
        $usuario = array(
          "nome" => $_POST['nome'],
          "email" => $_POST['email'],
          "senha" => $_POST['senha'],
          "privilegio" => $_POST['privilegio'],
        );
      }

      $this->load->model("user_model");
      $this->user_model->update_user($id,$usuario);
      // setcookie('PimpTOK',true);
      // $this->load->model("parking_model");
      // $this->load->model("planos_model");
      // $this->load->model("categories_model");
      // $this->load->model("user_model");
      // $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getAll(),'usuarios'=>$this->user_model->getAll(),'usuario_editado'=>"USUARIO EDITADO"];
      
      // $this->load->view('templates/header');
      // $this->load->view('dashboard/dashboardadmin',$data);

      $this->load->model('user_model');
      $data = ['usuario'=>$this->user_model->user_info($_POST['id_usuario']),'usuario_editado'=>"USUARIO EDITADO"];
      $this->load->view('templates/header');
      $this->load->view('dashboard/editar_usuario',$data);
    }

  }
  public function deletar_usuario(){
    $id = $_POST['id_usuario'];
    $this->load->model("user_model");
    $this->user_model->delete($id);
    setcookie('QQOKADMLOO',true);
    $this->load->model("parking_model");
    $this->load->model("planos_model");
    $this->load->model("categories_model");
    $this->load->model("user_model");
    
    $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categoria_deletada'=>"CATEGORIA DELETADA",'categorias'=>$this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll(),'usuario_deletado'=>"USUARIO DELETADO COM SUCESSO"];
    
    $this->load->view('templates/header');
    $this->load->view('dashboard/dashboardadmin',$data);
  }

  // cadastrar estacionamento
  public function cadastrar_estacionamento(){
    $this->load->library('form_validation');
		$this->form_validation->set_rules('titulo_estacionamento', 'Titulo', 'trim|required|min_length[3]|max_length[30]|is_unique[parking.titulo]');
		$this->form_validation->set_rules('cep', 'Cep', 'trim|required|min_length[8]|max_length[15]');
		$this->form_validation->set_rules('rua', 'Rua', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('bairro', 'Bairro', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('cidade', 'Cidade', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('uf', 'UF', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('numero', 'Número', 'trim|required|integer');
		//$this->form_validation->set_rules('userfile', 'Imagem', 'required');
		$this->form_validation->set_rules('numero_vagas', 'numero_vagas', 'trim|required|integer');
		$this->form_validation->set_rules('categoriass', 'categoriass', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('descricao2', 'descricao', 'trim|required|max_length[10000]');
    // $this->form_validation->set_rules('userfile', 'Datas', 'trim|required|max_length[10000]');
    $this->form_validation->set_rules('datas', 'Datas', 'trim|required|max_length[10000]');
		if ($this->form_validation->run() == FALSE)
		{
      setcookie('RRRGBA',true);
      $this->load->model("user_model");
      $this->load->model("categories_model");
      $this->load->model("parking_model");
      $this->load->model("planos_model");
      $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll()];
      $this->load->view('templates/header');
      $this->load->view('dashboard/dashboardadmin',$data);

    

			
		}
		else
		{
      //setcookie('RRRGBA',true);
//cookie de sucesso
	    setcookie('RRRGBASUC',true);
// IMAGEM ---------------------
$token = bin2hex(random_bytes(16));
$time = time();
$nomeImagem = $token.'_'.$time;
  $config = array(
    // 'encrypt_name' => TRUE,
    'file_name' =>$nomeImagem,
    'upload_path' => "./uploads/",
    'allowed_types' => "gif|jpg|png|jpeg|pdf",
    'overwrite' => TRUE,
    'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
    'max_height' => "300",
    'max_width' => "300"
    );
    $this->load->library('upload', $config);
    if($this->upload->do_upload())
    {
      
      $data = array('upload_data' => $this->upload->data());
      //$this->load->view('upload_success',$data);

            $this->load->model("parking_model");
            $estacionamento = array(
              "titulo" => $_POST['titulo_estacionamento'],
              "cep" =>  $_POST['cep'],
              "rua" =>  $_POST['rua'],
              "bairro" => $_POST['bairro'],
              "cidade" =>  $_POST['cidade'],
              "uf" =>  $_POST['uf'],
              "numero" =>  $_POST['numero'],
              "imagem" =>  $config['file_name'].$this->upload->data('file_ext'),
              "descricao" =>  $_POST['descricao2'],
              "numero_vagas" =>  $_POST['numero_vagas'],
              "datas" =>  $_POST['datas'],
              "id_categoria"=>$_POST['categoriass']
      
      
            );
            $this->load->model("parking_model");
            $this->parking_model->store($estacionamento);

            $this->load->model("user_model");
            $this->load->model("categories_model");
            
            $this->load->model("planos_model");
            $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll(),"estacionamento_cadastrado"=>"ESTACIONAMENTO CADASTRADO COM SUCESSO"];

            $this->load->view('templates/header');
            $this->load->view('dashboard/dashboardadmin',$data);
    }
    else
    {
      setcookie('RRRGBA',true);
      $this->load->model("parking_model");
      $this->load->model("user_model");
      $this->load->model("categories_model");
      $this->load->model("planos_model");
      $error= array('error' => $this->upload->display_errors());
      $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll(),"imagem_nao_upload"=>$error];
      $this->load->view('templates/header');
      $this->load->view('dashboard/dashboardadmin',$data);
      

      
    }




    }
  }
  public function deletar_estacionamento(){
    
    $titulo = $_GET['titulo'];
    $this->load->model("parking_model");
    $this->parking_model->delete($titulo);
    setcookie('Toakqpl',true);

    $this->load->model("user_model");
    $this->load->model("categories_model");
    
    $this->load->model("planos_model");
    $data = ['estacionamentos'=>$this->parking_model->getAllForCombobox(),'planos'=>$this->planos_model->getAll(),'categorias'=>$this->categories_model->getActiveCategories(),'usuarios'=>$this->user_model->getAll(),"estacionamento_deletado"=>"ESTACIONAMENTO DELETADO"];
    $this->load->view('templates/header');
    $this->load->view('dashboard/dashboardadmin',$data);
  }
  public function editar_estacionamento(){
    $this->load->model('parking_model');
    $this->load->model('categories_model');
    $titulo = $_GET['titulo'];
    $_SESSION['titulo'] = $titulo;
    $data = ['estacionamento'=>$this->parking_model->dataparking2($titulo),'categorias'=>$this->categories_model->getActiveCategories()];
    $this->load->view('templates/header');
    $this->load->view('dashboard/editar_estacionamento',$data);
  }
  public function atualizar_estacionamento(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('titulo', 'titulo', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('numero_vagas', 'numero_vagas', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('cep', 'cep', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('rua', 'rua', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('bairro', 'bairro', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('cidade', 'cidade', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('uf', 'uf', 'trim|required|max_length[120]');
		$this->form_validation->set_rules('datas', 'datas', 'trim|required|max_length[10000]');
    $this->form_validation->set_rules('descricao', 'descricao', 'trim|required|max_length[10000]');

		if ($this->form_validation->run() == FALSE)
		{

      $this->load->model('parking_model');
      $this->load->model('categories_model');
      $data = ['estacionamento'=>$this->parking_model->dataparking2( $_SESSION['titulo']),'categorias'=>$this->categories_model->getActiveCategories()];
      $this->load->view('templates/header');
      $this->load->view('dashboard/editar_estacionamento',$data);
		}
		else
		{
      $this->load->model('parking_model');
      $todosOsTit = $this->parking_model->getAllForCombobox();
      foreach($todosOsTit as $titulo):
        if($_POST['titulo'] !== $_POST['titulo_velho'] && $_POST['titulo']==$titulo->titulo):
          $this->load->model('parking_model');
          $this->load->model('categories_model');

          $_SESSION['titulo']=$_POST['titulo_velho'];
          $data = ['estacionamento'=>$this->parking_model->dataparking2($_SESSION['titulo']),'categorias'=>$this->categories_model->getActiveCategories(),'titulo_invalido'=>"ESTE TITULO JA ESTA SENDO USADO"];
          $this->load->view('templates/header');
          $this->load->view('dashboard/editar_estacionamento',$data);
          return;
        endif;
      endforeach;
      

          $token = bin2hex(random_bytes(16));
          $time = time();
          $nomeImagem = $token.'_'.$time;
            $config = array(
              // 'encrypt_name' => TRUE,
              'file_name' =>$nomeImagem,
              'upload_path' => "./uploads/",
              'allowed_types' => "gif|jpg|png|jpeg|pdf",
              'overwrite' => TRUE,
              'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
              'max_height' => "300",
              'max_width' => "300"
              );
              $this->load->library('upload', $config);
                  if($this->upload->do_upload())
                  {
                    $arr = array(
                      "titulo" => $_POST['titulo'],
                      "numero_vagas" =>  $_POST['numero_vagas'],
                      "cep" =>  $_POST['cep'],
                      "rua" => $_POST['rua'],
                      "bairro" =>  $_POST['bairro'],
                      "cidade" =>  $_POST['cidade'],
                      "uf" =>  $_POST['uf'],
                      "datas" =>  $_POST['datas'],
                      "descricao" =>  $_POST['descricao'],
                      "id_categoria" =>  $_POST['categoria'],
                      "imagem" =>  $config['file_name'].$this->upload->data('file_ext'),
            
                    );

                    
                    if($_POST['titulo'] !== $_POST['titulo_velho']):
                      $_SESSION['titulo']=$_POST['titulo'];
                    else:
                      $_SESSION['titulo']=$_POST['titulo_velho'];
                    endif;

 
 

                    $this->load->model("parking_model");
                    $this->parking_model->atualizar_estacionamento($_POST['titulo_velho'],$arr);
                    $this->load->model('parking_model');
                    $this->load->model('categories_model');
        
                    $data = ['estacionamento'=>$this->parking_model->dataparking2($_SESSION['titulo']),'categorias'=>$this->categories_model->getActiveCategories(),'atualizado'=>"ESTACIONAMENTO ATUALIZADO"];
                    $this->load->view('templates/header');
                    $this->load->view('dashboard/editar_estacionamento',$data);
                    
                  }else{// erro na imagem
                   // NENHUM ARQUIVO SELECIONADO;
                  
                   $string = $this->upload->display_errors();
                   $nenhumArquivoSelecionado = 'Nenhum arquivo foi selecionado.';
                   $imagemMuitoGrande = 'A imagem selecionada excede a largura e altura máximas.';
                    if(preg_match("/{$nenhumArquivoSelecionado}/i", $string)) {// nenhum arquivo slecionado
                      $arr = array(
                        "titulo" => $_POST['titulo'],
                        "numero_vagas" =>  $_POST['numero_vagas'],
                        "cep" =>  $_POST['cep'],
                        "rua" => $_POST['rua'],
                        "bairro" =>  $_POST['bairro'],
                        "cidade" =>  $_POST['cidade'],
                        "uf" =>  $_POST['uf'],
                        "datas" =>  $_POST['datas'],
                        "descricao" =>  $_POST['descricao'],
                        "id_categoria" =>  $_POST['categoria'],
                      );
                      
                      if($_POST['titulo'] !== $_POST['titulo_velho']):
                        $_SESSION['titulo']=$_POST['titulo'];
                      else:
                        $_SESSION['titulo']=$_POST['titulo_velho'];
                      endif;

                      $this->load->model("parking_model");
                      $this->parking_model->atualizar_estacionamento($_POST['titulo_velho'],$arr);
                      $this->load->model('parking_model');
                      $this->load->model('categories_model');
          
                      $data = ['estacionamento'=>$this->parking_model->dataparking2($_SESSION['titulo']),'categorias'=>$this->categories_model->getActiveCategories(),'atualizado'=>"ESTACIONAMENTO ATUALIZADO"];
                      $this->load->view('templates/header');
                      $this->load->view('dashboard/editar_estacionamento',$data);
                    }// fim nnehum arquivo selecionado
                    else if(preg_match("/{$imagemMuitoGrande}/i", $string)){//imagem mt grande
                      $this->load->model('parking_model');
                      $this->load->model('categories_model');
          
        
                        $_SESSION['titulo']=$_POST['titulo_velho'];
                     

                      $data = ['estacionamento'=>$this->parking_model->dataparking2($_SESSION['titulo']),'categorias'=>$this->categories_model->getActiveCategories(),'imagem_grande'=>'A imagem selecionada excede a largura e altura máximas.'];
                      $this->load->view('templates/header');
                      $this->load->view('dashboard/editar_estacionamento',$data);
             
                    }// fim imagem mt grande
                  }// fim erro na imagem
    }// fim validacao 
  }// fim funcao
  public function editar_categoria_view(){
    $this->load->model('categories_model');
    $data = ['categoria'=>$this->categories_model->category_info($_POST['id_categoria'])];
    $this->load->view('templates/header');
    $this->load->view('dashboard/editar_categoria',$data);
  }
  public function editar_usuario_view(){
    $this->load->model('user_model');
    $data = ['usuario'=>$this->user_model->user_info($_POST['id_usuario'])];
    $this->load->view('templates/header');
    $this->load->view('dashboard/editar_usuario',$data);
  }
public function selecao_multipla_view(){
    $vagas_multidatepicker = array();
    $titulo = $_POST['titulo_estacionamento'];
    $this->load->model('parking_model');
    $id_estacionamento = $this->parking_model->getId($titulo);
    
    //pegar as datas
        $datas = $this->parking_model->getDatas($titulo);
        $datasArr = explode(",",$datas);
    //usar metodo disponibilidadeNovo
        for($i =0;$i<sizeof($datasArr);$i++){
	  $vaga = trim($datasArr[$i]," ");
          $select = "SELECT * FROM `reservas` WHERE data like '%$vaga%' and id_estacionamento=$id_estacionamento";
          $vagas_ja_reservadas = intval($this->parking_model->disponibilidadeNovo($select));
          //usar metodo vagasNovo (titulo)
          $capacidade_total_diaria =intval($this->parking_model->vagas($id_estacionamento)) ;
          // subtrair total - disponibilidade, se ok, coloca na array
          if($capacidade_total_diaria - $vagas_ja_reservadas > 0){
              array_push($vagas_multidatepicker,$datasArr[$i]);
          }
        }
 
       
   
    $data = ['estacionamento'=> $this->parking_model->getDatas($titulo),'titulo'=> $titulo,'info'=>  $this->parking_model->dataparking($titulo),'vagas'=>$vagas_multidatepicker];
    $this->load->view('templates/header');
    $this->load->view('dashboard/selecao_multipla',$data);
  }
}