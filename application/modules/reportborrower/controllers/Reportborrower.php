<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportborrower extends CI_Controller {

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
	function viewReportborrower(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){

      $borrower  = (trim($_POST['borrower']) != "") ? "AND A.BorrowerID = '".$_POST["borrower"]."'" : "";
      $sdate     = (trim($_POST['startdate']) != "") ? "AND B.StartDate >= '".$_POST["startdate"]."'" : "";
      $edate     = (trim($_POST['enddate']) != "") ? "AND B.StartDate <= '".$_POST["enddate"]."'" : "";
      $bookid    = (trim($_POST['bookid']) != "") ? "AND B.BookID = '".$_POST["bookid"]."'" : "";
      $isbn      = (trim($_POST['isbn']) != "") ? "AND D.Isbn = '".$_POST["isbn"]."'" : "";
      $author    = (trim($_POST['author']) != "") ? "AND D.Author = '".$_POST["author"]."'" : "";
      
      $qry = $this->db->query("
                    
                              SELECT    A.BorrowerID, A.CustomerName, A.MobilePhone, A.IdentityID,
                                        B.BookID, B.StartDate, B.EndDate, B.TotalBook,
                                        C.ReturnDate, C.TotalReturnBook, C.TotalCost, C.DamageOrLostBook,
                                        D.TitleBuku
                              FROM      M_Borrowers A
                              LEFT      JOIN T_Borrowing B ON A.BorrowerID=B.BorrowerID
                              INNER     JOIN M_Book D ON B.BookID=D.BookID
                              LEFT      JOIN T_ReturnBook C ON B.BorrowingID=C.BorrowingID
                              WHERE     A.IsActive ='Y'
                                        AND B.IsActive='Y'
                                        AND C.IsActive='Y'
                                        ".$sdate."
                                        ".$edate."
                                        ".$borrower."
                                        ".$bookid."
                                        ".$isbn."
                                        ".$author."
                                        Order By A.BorrowerID


                              ");
      if ($qry->num_rows() > 0) {
        $str = $qry->result();
        $startdt = (trim($_POST['startdate']) != "") ? $_POST['startdate'] : "";
        $enddt   = (trim($_POST['enddate']) != "") ? $_POST['enddate'] : "";
        //$this->jcode($res);
      }
      else{
        $str = "";
        $startdt = "";
        $enddt   = "";
        //$this->jcode($str);
      }

      $this->load->view('Reportborrower_search', array('keys'=>$str, 'StartDate' => $startdt, 'EndDate' => $enddt ));

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
    else if(trim($uri) == "searchborrower"){
        $varbl = $_GET["query"];
        $query = $this->db->query(" SELECT  BorrowerID, CustomerName, MobilePhone, HomePhone, Address, IdentityID, Email,
                                            DateOfBirth, Gender, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate
                                    FROM    M_Borrowers
                                    WHERE   IsActive  = 'Y'
                                            AND (CustomerName LIKE '%".$varbl."%' OR BorrowerID LIKE '%".$varbl."%')
                              ");
         if ($query->num_rows() > 0) {
          $arr = $query->result();
          foreach($arr as $key){
            $data["suggestions"][] = ["value" => $key->BorrowerID." - ".$key->CustomerName, "key" => $key->BorrowerID, "keynm" => $key->CustomerName];
          }
         }
         else{
          $data["suggestions"][] = ["value" => '', "key" => '', "keynm" => ''];
         }

         $this->jcode($data);
         exit;
    }
    else if(trim($uri) == "print" ){
      $this->load->model('Reportborrower_model');
      $data['title']        = 'Print History Borrower';
      $data['isi']          = 'reportborrower/Reportborrower_print';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $this->load->view('reportborrower/Reportborrower_print',$data);
    }
    else if(trim($uri) == "export" ){
      $this->load->model('Reportborrower_model');
      $data['title']        = 'Export History Borrower';
      $data['isi']          = 'reportborrower/Reportborrower_export';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $data['filenm']       = "Report-HIstory-Borrowers";
      $this->load->view('reportborrower/Reportborrower_export',$data);
    }
    else{
      $this->load->model('Reportborrower_model');
      $data['title']        = 'Report History Borrower';
      $data['isi']          = 'reportborrower/Reportborrower_view';
      $data['cardata']      = $this->Reportborrower_model->ViewGetReportBorrower()->result();
      $data['str']          =  "";
      $this->load->view('reportborrower/Reportborrower_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


}