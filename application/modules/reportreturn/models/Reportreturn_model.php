<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportreturn_model extends CI_Model{

	function ViewGetReportReturn(){
		return $this->db->get('T_ReturnBook');
	}	
}

?>