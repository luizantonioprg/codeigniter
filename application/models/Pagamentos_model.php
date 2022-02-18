<?php

class Pagamentos_model extends CI_Model{
public function getAll(){
  $this->db->order_by('pagamentos.id', 'desc');
  $query = $this->db->select('data_pagamento,plano,users.nome')
  ->from('pagamentos')
  ->join('users', 'users.id = pagamentos.id_usuario')
  ->get();


return $query->result();
}
public function getSpecific($id_usuario){
  $this->db->order_by('id', 'desc');
  $query = $this->db->select('data_pagamento,plano')
  ->from('pagamentos')
  ->where('id_usuario',$id_usuario)
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
?>