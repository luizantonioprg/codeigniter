<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Populate extends CI_Controller {

  public function all_parkings(){
    $this->load->model("parking_model");
    header('Content-Type: application/json');
    echo json_encode( $this->parking_model->getAll() );
  }
  public function teste(){
    $this->load->model("parking_model");
    header('Content-Type: application/json');
    echo json_encode( $this->parking_model->teste() );
  }
  
  public function filtro1(){
    if(isset($_GET['select_municipios'])){
      $_GET['select_municipios'] = str_replace("'","\\'",$_GET['select_municipios']);
      // print_r($_GET);
      // return;
    }

    if(sizeof($_GET)==1 && array_key_exists("datepicker",$_GET)){
      //echo "só tem 1 e é datepicker";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.titulo,parking.cidade,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where datas like '%".$_GET['datepicker']."%' order by parking.id desc;";
    }else if(sizeof($_GET)==2 && array_key_exists("datepicker",$_GET) && array_key_exists("select_categorias",$_GET)){
      // echo "tem 2  que são datepicker e categoria";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.titulo,parking.cidade,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where datas like '%".$_GET['datepicker']."%'"."and id_categoria=".$_GET['select_categorias']." order by parking.id desc;";
    }else if(sizeof($_GET)==2 && array_key_exists("datepicker",$_GET) && array_key_exists("select_estados",$_GET)){
      // echo "tem 2  que são datepicker e estado";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.titulo,parking.cidade,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where datas like '%".$_GET['datepicker']."%'"." and uf='".$_GET['select_estados']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==2 && array_key_exists("datepicker",$_GET) && array_key_exists("select_municipios",$_GET)){
      // echo "tem 2  que são datepicker e cidades";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.titulo,parking.cidade,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where datas like '%".$_GET['datepicker']."%'"." and cidade='".$_GET['select_municipios']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==3 && array_key_exists("datepicker",$_GET) && array_key_exists("select_categorias",$_GET) && array_key_exists("select_estados",$_GET)){
      // echo "tem 3  que são datepicker,categoria e estados";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.titulo,parking.cidade,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where datas like '%".$_GET['datepicker']."%'"."and id_categoria='".$_GET['select_categorias']."'"." and uf='".$_GET['select_estados']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==3 && array_key_exists("datepicker",$_GET) && array_key_exists("select_categorias",$_GET) && array_key_exists("select_municipios",$_GET)){
      // echo "tem 3  que são datepicker,categoria e cidades";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.titulo,parking.cidade,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where datas like '%".$_GET['datepicker']."%'"."and id_categoria='".$_GET['select_categorias']."'"." and cidade='".$_GET['select_municipios']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==3 && array_key_exists("datepicker",$_GET) && array_key_exists("select_estados",$_GET) && array_key_exists("select_municipios",$_GET)){
      // echo "tem 3  que são datepicker,estados e cidades";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where datas like '%".$_GET['datepicker']."%'"."and uf='".$_GET['select_estados']."'"." and cidade like '".$_GET['select_municipios']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==1 && array_key_exists("select_categorias",$_GET)){
      // echo "só tem 1 e é categorias";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where id_categoria=".$_GET['select_categorias']." order by parking.id desc;";
    }else if(sizeof($_GET)==2 && array_key_exists("select_categorias",$_GET) && array_key_exists("select_estados",$_GET)){
      // echo "só tem 2 que são categoria e estado";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where id_categoria=".$_GET['select_categorias']." and uf='".$_GET['select_estados']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==2 && array_key_exists("select_categorias",$_GET) && array_key_exists("select_municipios",$_GET)){
      // echo "só tem 2 que são categoria e cidade";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where id_categoria=".$_GET['select_categorias']." and cidade='".$_GET['select_municipios']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==3 && array_key_exists("select_categorias",$_GET) && array_key_exists("select_estados",$_GET) && array_key_exists("select_municipios",$_GET)){
      // echo "só tem 3 que são categoria, estado e cidade";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where id_categoria=".$_GET['select_categorias']." and uf='".$_GET['select_estados']."'"." and cidade='".$_GET['select_municipios']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==1 && array_key_exists("select_estados",$_GET)){
      // echo "Só tem 1 e é select_estados";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where uf='".$_GET['select_estados']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==2 && array_key_exists("select_estados",$_GET) && array_key_exists("select_municipios",$_GET)){
      // echo "só tem 2 que são estado e cidade";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where uf='".$_GET['select_estados']."'"."and cidade='".$_GET['select_municipios']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==1 && array_key_exists("select_municipios",$_GET)){
      // echo "só tem 1 e é cidade";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where cidade='".$_GET['select_municipios']."'"." order by parking.id desc;";
    }else if(sizeof($_GET)==4 && array_key_exists("datepicker",$_GET) && array_key_exists("select_categorias",$_GET) && array_key_exists("select_estados",$_GET) && array_key_exists("select_municipios",$_GET)){
      // echo "tem todos";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where datas like '%".$_GET['datepicker']."%'"." and id_categoria=".$_GET['select_categorias']." and uf='".$_GET['select_estados']."'"." and cidade='".$_GET['select_municipios']."'"." order by parking.id desc;";
    }else{
      // echo "tem nada";
      $select = "SELECT categories.titulo as titulo_categoria,parking.id,parking.cidade,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria order by parking.id desc;";
    }

    $this->load->model("parking_model");
    $arr = $this->parking_model->filtro1($select);

    header('Content-Type: application/json');
    echo json_encode($arr);

  }

  public function buscar_estacionamentos(){
    $this->load->model("parking_model");
    $select = "SELECT categories.titulo as titulo_categoria,parking.titulo,parking.rua,parking.cidade,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where parking.titulo like '%".$_GET['txt']."%'"." OR cep like '%".$_GET['txt']."%'"." OR rua like '%".$_GET['txt']."%'"." OR bairro like '%".$_GET['txt']."%'"." OR cidade like '%".$_GET['txt']."%'"." OR uf like '%".$_GET['txt']."%'"." OR numero like '%".$_GET['txt']."%'"." OR descricao like '%".$_GET['txt']."%'"." OR numero_vagas like '%".$_GET['txt']."%'"." OR datas like '%".$_GET['txt']."%'"." OR categories.titulo like '%".$_GET['txt']."%'" ;

    $arr = $this->parking_model->busca1($select);

    header('Content-Type: application/json');
    echo json_encode($arr);

  }
  // public function sql(){
  //   $_GET['txt']='categoria a';
  //   $this->load->model("parking_model");
  //   $select = "SELECT categories.titulo as titulo_categoria,parking.titulo,parking.rua,parking.bairro,parking.numero,parking.uf,parking.numero_vagas FROM parking inner join categories on categories.id = parking.id_categoria where parking.titulo like '%".$_GET['txt']."%'"." OR cep like '%".$_GET['txt']."%'"." OR rua like '%".$_GET['txt']."%'"." OR bairro like '%".$_GET['txt']."%'"." OR cidade like '%".$_GET['txt']."%'"." OR uf like '%".$_GET['txt']."%'"." OR numero like '%".$_GET['txt']."%'"." OR descricao like '%".$_GET['txt']."%'"." OR numero_vagas like '%".$_GET['txt']."%'"." OR datas like '%".$_GET['txt']."%'"." OR categories.titulo like '%".$_GET['txt']."%'" ;
  //   print_r($this->parking_model->testSQL($select));
  // }
  public function buscar_reservas(){
    $this->load->model("reservas_model");
    if(isset($_GET['txt'])):
    $select = "SELECT users.nome,parking.titulo,reservas.rua,reservas.cidade,reservas.bairro,reservas.estado,reservas.complemento,reservas.data from reservas inner join parking on parking.id = reservas.id_estacionamento inner join users on reservas.id_usuario=users.id where users.nome like '%".$_GET['txt']."%'"."OR parking.titulo like '%".$_GET['txt']."%'"."OR reservas.rua like '%".$_GET['txt']."%'"."or reservas.cidade like '%".$_GET['txt']."%'"."or reservas.bairro like '%".$_GET['txt']."%'"."or reservas.estado like'%".$_GET['txt']."%'"."or reservas.complemento like'%".$_GET['txt']."%'"."or reservas.data like'%".$_GET['txt']."%'";

    else:
$select = "SELECT users.nome,parking.titulo,reservas.rua,reservas.cidade,reservas.bairro,reservas.estado,reservas.complemento,reservas.data from reservas inner join parking on parking.id = reservas.id_estacionamento inner join users on reservas.id_usuario=users.id;";
    endif;
    $arr = $this->reservas_model->busca1($select);
    header('Content-Type: application/json');
    echo json_encode($arr);
  }
  public function filtro2(){
    if(sizeof($_GET)==1 && array_key_exists("datepicker",$_GET)){
      //echo 'só datepicker';
      $select = "SELECT users.nome,parking.titulo,reservas.rua,reservas.cidade,reservas.bairro,reservas.estado,reservas.complemento,reservas.data from reservas inner join parking on parking.id = reservas.id_estacionamento inner join users on reservas.id_usuario=users.id where reservas.data like '%".$_GET['datepicker']."%'";
    }else if(sizeof($_GET)==1 && array_key_exists("select_estacionamento",$_GET)){
      // echo 'só estacionamento';
      $select = "SELECT users.nome,parking.titulo,reservas.rua,reservas.cidade,reservas.bairro,reservas.estado,reservas.complemento,reservas.data from reservas inner join parking on parking.id = reservas.id_estacionamento inner join users on reservas.id_usuario=users.id where parking.titulo like '%".$_GET['select_estacionamento']."%'";
    }else if(sizeof($_GET)==2 && array_key_exists("datepicker",$_GET) && array_key_exists("select_estacionamento",$_GET)){
      // echo 'datepicker e estacionamneto';
      $select = "SELECT users.nome,parking.titulo,reservas.rua,reservas.cidade,reservas.bairro,reservas.estado,reservas.complemento,reservas.data from reservas inner join parking on parking.id = reservas.id_estacionamento inner join users on reservas.id_usuario=users.id where parking.titulo like '%".$_GET['select_estacionamento']."%' and reservas.data like '%".$_GET['datepicker']."%'";
    }else {
      // echo 'nada';
      $select = "SELECT users.nome,parking.titulo,reservas.rua,reservas.cidade,reservas.bairro,reservas.estado,reservas.complemento,reservas.data from reservas inner join parking on parking.id = reservas.id_estacionamento inner join users on reservas.id_usuario=users.id";
    }

    $this->load->model("reservas_model");
    $arr = $this->reservas_model->filtro1($select);

    header('Content-Type: application/json');
    echo json_encode($arr);
  }
  public function buscar_pagamentos(){
    $this->load->model("pagamentos_model");
    if(isset($_GET['txt2'])):
      $select= "select users.nome,data_pagamento,plano from pagamentos inner join users on pagamentos.id_usuario=users.id where users.nome like '%".$_GET['txt2']."%' or data_pagamento like '%".$_GET['txt2']."%' or plano like '%".$_GET['txt2']."%'";

    else:
      $select= "select users.nome,data_pagamento,plano from pagamentos inner join users where pagamentos.id_usuario=users.id";
    endif;
    $arr = $this->pagamentos_model->busca1($select);
    header('Content-Type: application/json');
    echo json_encode($arr);
  }
  public function filtro3(){
    if(sizeof($_GET)==1 && array_key_exists("datepicker2",$_GET)){
      //só data
      
      $select = "SELECT data_pagamento,plano,users.nome from pagamentos inner join users on users.id=pagamentos.id_usuario where data_pagamento like '%".$_GET['datepicker2']."%'";
    }else if(sizeof($_GET)==1 && array_key_exists("select_estacionamentos2",$_GET)){
      //só estacionamento
      $select = "SELECT data_pagamento,plano,users.nome from pagamentos inner join users on users.id=pagamentos.id_usuario where data_pagamento like '%".$_GET['select_estacionamentos2']."%'";
    }else if(sizeof($_GET)==2 && array_key_exists("select_estacionamentos2",$_GET) && array_key_exists("datepicker2",$_GET) ){
      // data e estacionamento
      $select = "SELECT data_pagamento,plano,users.nome from pagamentos inner join users on users.id=pagamentos.id_usuario where data_pagamento like '%".$_GET['select_estacionamentos2']."% and data_pagamento like '%'".$_GET['datepicker2']."%'";
    }else{
      //nada
      $select = "SELECT data_pagamento,plano,users.nome from pagamentos inner join users on users.id=pagamentos.id_usuario";
    }
    $this->load->model("pagamentos_model");
    $arr = $this->pagamentos_model->filtro1($select);
    header('Content-Type: application/json');
    echo json_encode($arr);
  }
}
?>