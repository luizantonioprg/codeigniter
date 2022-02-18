<?php

class Reservas_model extends CI_Model{
  public function getAllReservasDoUsuario($id){
    $this->db->order_by('reservas.id', 'desc');
    $query = $this->db->select('reservas.id,parking.titulo,users.nome,reservas.data,reservas.rua,reservas.complemento,reservas.bairro,reservas.cidade,reservas.estado')
    ->from('reservas')
    ->join('users', 'users.id = reservas.id_usuario')
    ->join('parking', 'parking.id = reservas.id_estacionamento')
    ->where('id_usuario',$id)
    ->get();
  
  
  return $query->result();
  
  }
  public function disponibilidade($select){
    $query = $this->db->query($select);
    return $query->num_rows();
  }
  public function store($reserva){
    $this->db->insert("reservas",$reserva);
  }
  public function getAll(){
    $this->db->order_by('reservas.id', 'desc');
    $query = $this->db->select('parking.titulo,users.nome,reservas.data')
    ->from('reservas')
    ->join('users', 'users.id = reservas.id_usuario')
    ->join('parking', 'parking.id = reservas.id_estacionamento')
    ->get();


  return $query->result();
  }
  public function busca1($select){
    $query = $this->db->query($select);
    return $query->result();
  }
  public function filtro1($select){
    $query = $this->db->query($select);
    return $query->result();
  }
}