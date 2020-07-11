<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportborrowing_model extends CI_Model{

	function ViewGetReportBorrowing(){
		return $this->db->get('T_Borrowing');
	}	
}

?>