<?php

class Parking_model extends CI_Model{
 public function getId($titulo){
    $query = $this->db->select('id')
    ->from('parking')
    ->where('titulo',$titulo)
    ->get();
    foreach($query->result() as $item):
      return $item->id;
    endforeach;
  }
  public function disponibilidadeNovo($select){
    $query = $this->db->query($select);
    return $query->num_rows();
  }
  public function getDatas($titulo){
    $query = $this->db->select('*')
    ->from('parking')
    ->where('titulo',$titulo)
    ->get();
    foreach($query->result() as $item):
      return $item->datas;
    endforeach;
  }
  public function getEstacionamentoTitulo($id){
    $query = $this->db->select('titulo')
    ->from('parking')
    ->where('id',$id)
    ->get();
    foreach($query->result() as $item):
      return $item->titulo;
    endforeach;
  }
  public function getAllForCombobox(){
    $query = $this->db->select('titulo')
    ->from('parking')
    ->get();
    return $query->result();
    
  }

  public function getAll(){
    // $query = $this->db->get('parking');
    // return $query->result();

    $this->db->order_by('id', 'desc');
    $query = $this->db->select('categories.titulo as titulo_categoria,parking.rua,parking.numero,parking.bairro,parking.uf,parking.numero_vagas,parking.cidade,parking.titulo')
    ->from('parking')
    ->join('categories', 'categories.id = parking.id_categoria')
    ->get();
  
  
  return $query->result();
  }

  public function teste(){
    $this->db->order_by('id', 'desc');
    $query = $this->db->select('categories.titulo as titulo_categoria,parking.rua,parking.numero,parking.bairro,parking.uf,parking.numero_vagas,parking.cidade,parking.titulo')
    ->from('parking')
    ->where('categories.id','1')
    ->join('categories', 'categories.id = parking.id_categoria')
    ->get();
    return $query->result();
  }
  public function filtro1($select){
    $this->db->order_by('id', 'desc');
    $query = $this->db->query($select);
    return $query->result();
  }



public function dataparking($titulo){
  $query = $this->db->select('*')
  ->from('parking')
  ->where('titulo',$titulo)
  ->get();
  return $query->result();
}
public function dataparking2($titulo){
  $this->db->order_by('parking.id', 'desc');
  $query = $this->db->select('categories.titulo as tituloc,cep,id_categoria,uf,rua,bairro,cidade,numero,numero_vagas,descricao,imagem,parking.titulo,datas')
  ->from('parking')
  ->join('categories', 'parking.id_categoria = categories.id')
  ->where('parking.titulo',$titulo)
  ->get();
  return $query->result();
}
public function vagas($id){
  $query = $this->db->select('numero_vagas')
  ->from('parking')
  ->where('id',$id)
  ->get();
  foreach($query->result() as $item):
    return $item->numero_vagas;
  endforeach;

}

  public function busca1($select){
    $query = $this->db->query($select);
    return $query->result();
  }
  public function testSQL($select){
    $query = $this->db->query($select);
    return $query->result();
  }
  public function store($estacionamento){
    $this->db->insert("parking",$estacionamento);
  }
  public function delete($titulo){
    $this->db->where('titulo', $titulo);
    $this->db->delete('parking');
  }
  public function atualizar_estacionamento($titulo,$arr){
    $this->db->where('titulo', $titulo);
    $this->db->update('parking', $arr);
  }
}