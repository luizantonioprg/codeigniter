<?php

class Reset_model extends CI_Model{

  public function store($new){
    $this->db->insert("password_resets",$new);
  }
  public function isExpired($email){
    $this->db->select('token, created_at,email');
    $this->db->where('email', $email);
    $query = $this->db->get('password_resets');
    return $query->result_array();
  }
  public function alreadyExists($email){
    $this->db->where('email', $email)->from('password_resets');
    $query = $this->db->get();
    return $query->result();
  }
   public function alreadyExists2($email){
    $this->db->where('email', $email)->from('users');
    $query = $this->db->get();
    return $query->num_rows();
  }
 
  public function resetPassword($email,$novaSenha){
    $this->db->set('senha', $novaSenha);
    $this->db->where('email', $email);
    $this->db->update('users'); 
  }
  public function deleteAfterResetPassword($email){
    $this->db->where('email', $email);
    $this->db->delete('password_resets'); 
  }

}