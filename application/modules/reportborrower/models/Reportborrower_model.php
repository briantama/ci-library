<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportborrower_model extends CI_Model{

	function ViewGetReportBorrower(){
		return $this->db->get('M_Borrowers');
	}	
}

?>