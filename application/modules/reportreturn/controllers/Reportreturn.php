<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportreturn extends CI_Controller {

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
	function viewReportreturn(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){

      $return    = (trim($_POST['return']) != "") ? "AND A.ReturnBookID = '".$_POST["return"]."'" : "";
      $borrowing = (trim($_POST['borrowing']) != "") ? "AND A.BorrowingID = '".$_POST["borrowing"]."'" : "";
      $sdate     = (trim($_POST['startdate']) != "") ? "AND B.StartDate >= '".$_POST["startdate"]."'" : "";
      $edate     = (trim($_POST['enddate']) != "") ? "AND B.StartDate <= '".$_POST["enddate"]."" : "";
      $bookid    = (trim($_POST['bookid']) != "") ? "AND B.BookID = '".$_POST["bookid"]."'" : "";
      
      $qry = $this->db->query("
                    
                              SELECT    A.ReturnBookID, A.BorrowingID, A.ReturnDate, A.TotalReturnBook, A.LateCharge, A.Description,  
                                        A.DamageOrLostBook, A.DamageCost , A.TotalCost, 
                                        B.BorrowingID, B.StartDate, B.EndDate, B.TotalBook, B.BookID,
                                        D.BorrowerID, D.CustomerName, C.DailyLateFee
                              FROM      T_ReturnBook A
                              INNER     JOIN T_Borrowing B ON A.BorrowingID=B.BorrowingID
                              INNER     JOIN M_Book C ON B.BookID=C.BookID
                              INNER     JOIN M_Borrowers D ON B.BorrowerID=D.BorrowerID
                              WHERE     A.IsActive ='Y'
                                        AND B.IsActive ='Y' 


                              ");
      if ($qry->num_rows() > 0) {
        $str     = $qry->result();
        $startdt = (trim($_POST['startdate']) != "") ? $_POST['startdate'] : "";
        $enddt   = (trim($_POST['enddate']) != "") ? $_POST['enddate'] : "";
        //$this->jcode($res);
      }
      else{
        $str     = "";
        $startdt = "";
        $enddt   = "";
        //$this->jcode($str);
      }

      $this->load->view('Reportreturn_search', array('keys'=>$str, 'StartDate' => $startdt, 'EndDate' => $enddt ));

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
      $this->load->model('Reportreturn_model');
      $data['title']        = 'Print Report Return Charge Book';
      $data['isi']          = 'reportreturn/Reportreturn_print';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $this->load->view('reportreturn/Reportreturn_print',$data);
    }
    else if(trim($uri) == "export" ){
      $this->load->model('Reportreturn_model');
      $data['title']        = 'Export Report Return Charge Book';
      $data['isi']          = 'reportreturn/Reportreturn_export';
      $data['keys']         = unserialize(urldecode($uri1));
      $data["StartDate"]    = $_GET['StartDate'];
      $data["EndDate"]      = $_GET['EndDate'];
      $data['filenm']       = "Report-Return-Charge-Book";
      $this->load->view('reportreturn/Reportreturn_export',$data);
    }
    else{
      $this->load->model('Reportreturn_model');
      $data['title']        = 'Report Return Charge Book';
      $data['isi']          = 'reportreturn/Reportreturn_view';
      $data['cardata']      = $this->Reportreturn_model->ViewGetReportReturn()->result();
      $data['str']          = "";
      $this->load->view('reportreturn/Reportreturn_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }


}