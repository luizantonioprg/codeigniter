<?php

class User_model extends CI_Model{

  public function allAdmins(){
    $query = $this->db->select('email')
    ->from('users')
    ->get();
    return $query->result();
  }
  public function getEmail($id){
    $query = $this->db->select('email')
    ->from('users')
    ->where('id',$id)
    ->get();
    foreach($query->result() as $item):
      return $item->email;
    endforeach;

  }
  public function getAll(){
    $this->db->order_by('id', 'desc');
    $query = $this->db->get('users');
    return $query->result();
  }
  public function user($id){
    $query = $this->db->select('nome,email,credito')
    ->from('users')
    ->where('id',$id)
    ->get();
    return $query->result();
  }
  public function update_user($id,$user){
    $this->db->where('id', $id);
    $this->db->update('users', $user);
  }
  public function store($user){
    $this->db->insert("users",$user);
  }
  public function user_id($email){
    $this->db->where('email', $email)->from('users');
    $query = $this->db->get();
    foreach( $query->result() as $item):
      return $item->id;
    endforeach;
  }
  public function retornaCreditos($id){
    $this->db->where('id', $id)->from('users');
    $query = $this->db->get();
    $arr = $query->result();
    foreach($arr as $item){
      return $item->credito;
    }
  }
  public function atualizar_creditos($id,$data){
    $this->db->where('id', $id);
    $this->db->update('users', $data);
  }
  public function delete($id){
    $this->db->where('id', $id);
    $this->db->delete('users');
  }
  public function user_info($id){
    $this->db->where('id', $id)->from('users');
    $query = $this->db->get();
    return $query->result();
  }
}