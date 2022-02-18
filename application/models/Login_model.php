<?php

class Login_model extends CI_Model{

  public function findUser($email,$senha){
    $this->db->where("email",$email);
    $this->db->where("senha",$senha);
    $user = $this->db->get("users")->row_array();
    return $user;
  }

}