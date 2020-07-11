<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Borrowers_model extends CI_Model{

	function ViewGetBorrowes(){
		return $this->db->get('M_Borrowers');
	}	
}

?>