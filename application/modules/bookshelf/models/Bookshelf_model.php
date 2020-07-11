<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookshelf_model extends CI_Model{

	function ViewGetBookshelf(){
		return $this->db->get('M_BookShelf');
	}	
}

?>