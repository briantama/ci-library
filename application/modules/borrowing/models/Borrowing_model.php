<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Borrowing_model extends CI_Model{

	function ViewGetBorrowing(){
		return $this->db->query("
								SELECT 		BorrowingID, BorrowerID, BookID, StartDate, EndDate, TotalBook, Description, 
                                      		Status, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate
								FROM 		T_Borrowing
								WHERE 		IsActive ='Y'
							");
	}	
}

?>