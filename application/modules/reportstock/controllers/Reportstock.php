<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportstock extends CI_Controller {

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index() {
		$data=array('title'=>'Bryn Rentcar - Halaman Administrator',
      					'isi' =>'dasbor/dasbor_view'
      						);
		$this->load->view('layout/wrapper',$data);	
	}


	//galeri widget
	function viewReportstock(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){

      $bookid   = (trim($_POST['bookid']) != "") ? "AND X.BookID = '".$_POST["bookid"]."'" : "";
      $isbn     = (trim($_POST['isbn']) != "") ? "AND Z.Isbn LIKE '%".$_POST["isbn"]."%'" : "";
      $title    = (trim($_POST['title']) != "") ? "AND Z.TitleBuku LIKE '%".$_POST["title"]."%'" : "";
      $author   = (trim($_POST['author']) != "") ? "AND Z.Author LIKE '%".$_POST["author"]."%'" : "";
      $bookshelf= (trim($_POST['shelf']) != "") ? "AND Z.BookshelfID = '".$_POST["shelf"]."'" : "";
      $category = (trim($_POST['category']) != "") ? "AND Z.CategoryCode = '".$_POST["category"]."'" : "";
      
      $qry = $this->db->query("
                    
                              SELECT X.BookID, Z.TitleBuku, SUM(X.StockAvailable) + SUM(X.Borrowing) + SUM(X.ReturnBook) + SUM(X.lostBook)  AS StockIn,
                                     SUM(X.StockAvailable) AS StockAvailable, SUM(X.Borrowing) AS Borrowing, 
                                     SUM(X.ReturnBook) AS ReturnBook, SUM(X.lostBook) AS lostBook
                              FROM  ( 
                                    SELECT BookID, StockBook AS StockAvailable,
                                         0 AS Borrowing, 0 AS ReturnBook, 0 AS lostBook, 'Stock' AS Info
                                    FROM   M_Book
                                    WHERE  IsActive ='Y'
                                    GROUP  BY BookID

                                    UNION ALL


                                    SELECT A.BookID, 0 AS StockBook, A.TotalBook AS Borrowing, 0 AS  ReturnBook, 0 AS lostBook, 'Borrowing' AS Info
                                    FROM   T_Borrowing A
                                    WHERE  A.IsActive = 'Y'
                                         AND A.Status = '5'
                                    GROUP  BY A.BookID

                                    UNION ALL



                                    SELECT B.BookID, 0 AS StockBook, 0 AS Borrowing, SUM(TotalReturnBook) AS ReturnBook, 0 AS LostBook, 'ReturnBook' AS Info
                                    FROM   T_ReturnBook A
                                    INNER  JOIN T_Borrowing B ON A.BorrowingID=B.BorrowingID
                                    WHERE  A.IsActive='Y'
                                         AND B.IsActive='Y'
                                         AND A.Status='5'
                                         AND TotalReturnBook > 0
                                    GROUP  BY B.BookID

                                    UNION ALL


                                    SELECT B.BookID, 0 AS StockBook, 0 AS Borrowing, 0 AS ReturnBook, SUM(B.TotalBook) AS lostBook, 'ReturnLostBook' AS Info
                                    FROM   T_ReturnBook A
                                    INNER  JOIN T_Borrowing B ON A.BorrowingID=B.BorrowingID
                                    WHERE  A.IsActive='Y'
                                         AND B.IsActive='Y'
                                         AND A.Status='5'
                                         AND A.DamageOrLostBook='Lost'
                                    GROUP  BY B.BookID
                                  ) X

                                INNER JOIN M_Book Z ON X.BookID=Z.BookID
                                WHERE Z.IsActive='Y'
                                      ".$bookid."
                                      ".$isbn."
                                      ".$title."
                                      ".$author."
                                      ".$bookshelf."
                                      ".$category."
                                GROUP BY X.BookID


                              ");
      if ($qry->num_rows() > 0) {
        $str = $qry->result();
        //$this->jcode($res);
      }
      else{
        $str = "";
        //$this->jcode($str);
      }

      $this->load->view('Reportstock_search', array('keys'=>$str));

    }
    else if(trim($uri) == "searchbook"){
        $varbl = $_GET["query"];
        $query = $this->db->query(" SELECT  BookID, Isbn, TitleBuku, Author, NumberOfPages, CategoryCode, BookshelfID, 
                                            Status, IsActive, StockBook
                                    FROM    M_Book
                                    WHERE   IsActive  = 'Y'
                                            AND Status = '5'
                                            AND StockBook > 0
                                            AND (TitleBuku LIKE '%".$varbl."%' OR BookID LIKE '%".$varbl."%')
                              ");
         if ($query->num_rows() > 0) {
          $arr = $query->result();
          foreach($arr as $key){
            $data["suggestions"][] = ["value" => $key->BookID."-".$key->TitleBuku, "key" => $key->BookID, "keynm" => $key->TitleBuku];
          }
         }
         else{
          $data["suggestions"][] = ["value" => '', "key" => '', "keynm" => ''];
         }

         $this->jcode($data);
         exit;
    }
    else if(trim($uri) == "searchbookshelf"){
        $varbl = $_GET["query"];
        $query = $this->db->query(" SELECT  BookshelfID, ShelfName, Position, Descripton,
                                            IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate
                                    FROM    M_BookShelf
                                    WHERE   IsActive  = 'Y'
                                            AND (ShelfName LIKE '%".$varbl."%' OR BookshelfID LIKE '%".$varbl."%')
                              ");
         if ($query->num_rows() > 0) {
          $arr = $query->result();
          foreach($arr as $key){
            $data["suggestions"][] = ["value" => $key->BookshelfID." - ".$key->ShelfName, "key" => $key->BookshelfID, "keynm" => $key->ShelfName];
          }
         }
         else{
          $data["suggestions"][] = ["value" => '', "key" => '', "keynm" => ''];
         }

         $this->jcode($data);
         exit;
    }
    else if(trim($uri) == "searchcategory"){
        $varbl = $_GET["query"];
        $query = $this->db->query(" SELECT  CategoryCode, CategoryName, 
                                            Descripton, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate
                                    FROM    M_Category
                                    WHERE   IsActive  = 'Y'
                                            AND (CategoryName LIKE '%".$varbl."%' OR CategoryCode LIKE '%".$varbl."%')
                              ");
         if ($query->num_rows() > 0) {
          $arr = $query->result();
          foreach($arr as $key){
            $data["suggestions"][] = ["value" => $key->CategoryCode." - ".$key->CategoryName, "key" => $key->CategoryCode, "keynm" => $key->CategoryName];
          }
         }
         else{
          $data["suggestions"][] = ["value" => '', "key" => '', "keynm" => ''];
         }

         $this->jcode($data);
         exit;
    }
    else if(trim($uri) == "print" ){
      $this->load->model('Reportstock_model');
      $data['title']        = 'Print Stock Book';
      $data['isi']          = 'reportstock/Reportstock_print';
      $data['keys']         = unserialize(urldecode($uri1));
      $this->load->view('reportstock/Reportstock_print',$data);
    }
    else if(trim($uri) == "export" ){
      $this->load->model('Reportstock_model');
      $data['title']        = 'Export Stock Book';
      $data['isi']          = 'reportstock/Reportstock_export';
      $data['keys']         = unserialize(urldecode($uri1));
      $data['filenm']       = "Report-Stock-Book";
      $this->load->view('reportstock/Reportstock_export',$data);
    }
    else{
      $this->load->model('Reportstock_model');
      $data['title']        = 'Report Stock Book';
      $data['isi']          = 'reportstock/Reportstock_view';
      $data['cardata']      = $this->Reportstock_model->ViewGetReportStock()->result();
      $data['str']          = "";
      $this->load->view('reportstock/Reportstock_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


}