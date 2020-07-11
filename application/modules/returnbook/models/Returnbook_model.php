<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Returnbook_model extends CI_Model{

	function ViewGetReturnbook(){
		return $this->db->query("
					             SELECT  A.ReturnBookID, A.BorrowingID, A.ReturnDate, A.TotalReturnBook, A.Description, A.Status, 
              						A.IsActive, A.EntryBy, A.EntryDate, A.LastUpdateBy, A.LastUpdateDate ,
              						B.StartDate, B.EndDate, B.TotalBook, C.CustomerName, C.BorrowerID, 
              						D.BookID, D.TitleBuku, A.DamageOrLostBook,
                                                        REPLACE(FORMAT(A.LateCharge ,2),'.00','') AS LateCharge,
                                                        REPLACE(FORMAT(A.DamageCost ,2),'.00','') AS DamageCost,
                                                        REPLACE(FORMAT(A.TotalCost ,2),'.00','') AS TotalCost
              					FROM 	T_ReturnBook A
              					INNER   JOIN T_Borrowing B ON A.BorrowingID=B.BorrowingID
              					INNER   JOIN M_Borrowers C ON B.BorrowerID=C.BorrowerID
              					INNER   JOIN M_Book D ON B.BookID=D.BookID
              					WHERE   A.IsActive ='Y'

              				");
	}	
}

?>