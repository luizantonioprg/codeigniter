<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagamentos extends CI_Controller {

  public function register(){
    $credito = 0;
    $this->load->model("planos_model");
    $pagamento = array(
      "id_usuario" => $_POST['id_usuario'],
      "data_pagamento" => $_POST['data_pagamento'],
      "plano" => $_POST['plano'],
    );
    $this->planos_model->store($pagamento);
    if($_POST['plano'] == 'MENSAL'){
      $this->load->model("planos_model");
      $credito = $this->planos_model->retorna_credito_do_plano("SELECT rendimento FROM planos where titulo='MENSAL'");
    }else if($_POST['plano'] == 'SEMESTRAL'){
      $this->load->model("planos_model");
      $credito = $this->planos_model->retorna_credito_do_plano("SELECT rendimento FROM planos where titulo='SEMESTRAL'");
    }else{
      $this->load->model("planos_model");
      $credito = $this->planos_model->retorna_credito_do_plano("SELECT rendimento FROM planos where titulo='ANUAL'");
    }
    $this->planos_model->update_user_credits($_POST['id_usuario'],$credito);
    
    
    
    
    
    
    
    
    
    /*REDIRECT*/
    setcookie('PAplq56',true);


    $this->load->model("categories_model");
    $this->load->model("planos_model");
    $this->load->model("reservas_model");
    $this->load->model("user_model");
    $this->load->model('pagamentos_model');
    $data = ['categorias'=>$this->categories_model->getActiveCategories(),'planos'=>$this->planos_model->getAll(),'reservas'=>$this->reservas_model->getAllReservasDoUsuario($_POST['id_usuario']),'id_do_usuario'=>$_POST['id_usuario'],'plano_adquirido'=>"SEU PLANO FOI CONTRATADO",'pagamentos'=>$this->pagamentos_model->getSpecific($_POST['id_usuario'])];
    $this->load->view('templates/header');
    $this->load->view('dashboard/dashboarduser',$data);
  }
}