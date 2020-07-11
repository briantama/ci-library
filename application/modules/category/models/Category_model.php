<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model{

	function ViewGetCategory(){
		return $this->db->get('M_Category');
	}	
}

?>