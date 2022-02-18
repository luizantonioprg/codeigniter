<?php

class Categories_model extends CI_Model{
  public function getAll(){
    
    $this->db->order_by("id", "desc");
    $query = $this->db->get('categories');
    return $query->result();
  }
  public function update($id,$arr){
    $this->db->where('id', $id);
    $this->db->update('categories', $arr);
  }
  public function delete($id){
    $this->db->where('id', $id);
    $this->db->delete('categories');
  }
  public function store($categoria){
    $this->db->insert("categories",$categoria);
  }
  public function category_info($id){
    $this->db->where('id', $id)->from('categories');
    $query = $this->db->get();
    return $query->result();
  }
function array_push_assoc($array, $key, $value){
   $array[$key] = $value;
   return $array;
}
public function getActiveCategories(){
    $this->db->select('id_categoria');
    $this->db->from('parking');
    $query = $this->db->get();

    $ids = array();
      foreach($query->result_array() as $categoria):
	foreach($categoria as $titulo):
		array_push($ids,$titulo);
	endforeach;
       endforeach;
   $arrayLimpa = array_unique($ids);
   $titulos = array();

foreach($arrayLimpa as $cada):
$this->db->select("titulo");
	    $this->db->where('id', $cada)->from('categories');
    	    $query = $this->db->get();

            foreach($query->result() as $titulo):
array_push($titulos,$titulo->titulo);
                 //echo $titulo;
	    endforeach;

endforeach;



    $this->db->select('*');
    $this->db->order_by("id", "desc");
    $this->db->where_in('id', $arrayLimpa); 
    $query = $this->db->get("categories");
    return $query->result();

}


}
?>