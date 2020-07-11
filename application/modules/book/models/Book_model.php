<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model{

	function ViewGetBook(){
		return $this->db->query("SELECT 	A.BookID, A.Isbn, A.TitleBuku, A.Author, A.NumberOfPages, A.CategoryCode, A.BookshelfID, A.ImageBook, 
                                     		A.StockBook, A.Status, A.IsActive, A.EntryBy, A.EntryDate, A.LastUpdateBy, A.LastUpdateDate,
                                     		B.CategoryName, C.ShelfCode, 
                                     		REPLACE(FORMAT(A.LightDamageCosts ,2),'.00','') AS LightDamageCosts,
                                     		REPLACE(FORMAT(A.HeavyDamageCosts ,2),'.00','') AS HeavyDamageCosts,
                                     		REPLACE(FORMAT(A.LostCost ,2),'.00','') AS LostCost, 
                                     		REPLACE(FORMAT(A.DailyLateFee ,2),'.00','') AS DailyLateFee 
								 FROM 		M_Book A
								 INNER      JOIN M_Category B ON A.CategoryCode=B.CategoryCode
								 INNER 		JOIN M_BookShelf C ON A.BookshelfID=C.BookshelfID

								");
	}	
}

?>