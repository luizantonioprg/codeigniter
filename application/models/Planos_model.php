<?php

class Planos_model extends CI_Model{
  public function getAll(){
    $query = $this->db->get('planos');
    return $query->result();
  }
  public function store($pagamento){
    $this->db->insert("pagamentos",$pagamento);
  }
  public function update_user_credits($id,$credito){
    $this->db->set('credito',$credito);
    $this->db->where('id', $id);
    $this->db->update('users'); // gives UPDATE `mytable` SET `field` = 'field+1' WHERE `id` = 2
  }
  public function retorna_credito_do_plano($select){
    $query = $this->db->query($select);
    $arr = $query->result();
    foreach($arr as $item):
      return $item->rendimento;
    endforeach;
  }
  public function update($id,$arr){
    $this->db->where('id', $id);
    $this->db->update('planos', $arr);
  }
}
?>