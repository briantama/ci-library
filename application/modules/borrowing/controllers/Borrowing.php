<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Borrowing extends CI_Controller {

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
	function viewBorrowing(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $qry = $this->db->query("SELECT A.BorrowingID, A.BorrowerID, A.BookID, A.StartDate, A.EndDate, A.TotalBook, A.Description, 
                                      A.Status, A.IsActive , B.StockBook, B.TitleBuku, C.CustomerName
                                FROM  T_Borrowing A 
                                INNER JOIN M_Book B ON A.BookID=B.BookID
                                INNER JOIN M_Borrowers C ON A.BorrowerID=C.BorrowerID
                                WHERE A.BorrowingID = '$uri1'");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        $this->jcode($res);
      }
      else{
        $str["BorrowingID"]   = "";
        $str["BorrowerID"]    = "";
        $str["BookID"]        = "";
        $str["StartDate"]     = "";
        $str["EndDate"]       = "";
        $str["TotalBook"]     = "";
        $str["Descripton"]    = "";
        $str["Status"]        = "";
        $str["IsActive"]      = "";
        $str["CustomerName"]  = "";
        $str["TitleBuku"]     = "";
        $str["StockBook"]     = "";
        $this->jcode($str);
      }
      exit();
    }
     else if(trim($uri) == "search"){
        $varbl = $_GET["query"];
        $query = $this->db->query(" SELECT  BorrowerID, CustomerName, MobilePhone, HomePhone, Address, IdentityID, Email,
                                            DateOfBirth, Gender, IsActive
                                    FROM    M_Borrowers
                                    WHERE   IsActive  = 'Y'
                                            AND (CustomerName LIKE '%".$varbl."%' OR BorrowerID LIKE '%".$varbl."%')
                              ");
         if ($query->num_rows() > 0) {
          $arr = $query->result();
          foreach($arr as $key){
            $data["suggestions"][] = ["value" => $key->BorrowerID."-".$key->CustomerName, "key" => $key->BorrowerID, "keynm" => $key->CustomerName];
          }
         }
         else{
          $data["suggestions"][] = ["value" => '', "key" => '', "keynm" => ''];
         }

         $this->jcode($data);
         exit;
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
            $data["suggestions"][] = ["value" => $key->BookID."-".$key->TitleBuku, "key" => $key->BookID, "keynm" => $key->TitleBuku, "stock" => $key->StockBook];
          }
         }
         else{
          $data["suggestions"][] = ["value" => '', "key" => '', "keynm" => '', "stock" => ''];
         }

         $this->jcode($data);
         exit;
    }
    else if (trim($uri) == "save") {

      //post file
      $borrowing   = $_GET['borrowing'];
      $borrower    = $_GET['borrower'];
      $bookid      = $_GET['bookid'];
      $sdate       = $_GET['startdate'];
      $edate       = $_GET['enddate'];
      $total       = $_GET["total"];
      $desc        = ucwords(strtolower($_GET['desc']));


      $res = $this->db->query("SELECT BorrowingID FROM T_Borrowing WHERE BorrowingID = '".$_GET['id']."'");
          if ($res->num_rows() == 0) {
						
            $this->db->query("INSERT INTO T_Borrowing
																		( BorrowingID, BorrowerID, BookID, StartDate, EndDate, TotalBook, Description, 
                                      Status, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
															VALUES 
																		( '".$borrowing."', '".$borrower."',  '".$bookid."',  '".$sdate."',  '".$edate."', ".$total.", '".$desc."',
                                      '1', 'Y', '".$usernm."', '".$datetm."', '".$usernm."',  '".$datetm."')	
														");
						$msg = "Save";
          }
					else {

            $res = $this->db->query("SELECT Status, BookID, TotalBook FROM T_Borrowing WHERE BorrowingID = '".$_GET['id']."'")->row();
            if(trim($res->Status) == "5" || trim($res->Status) == "7"){
                $ret_arr['status']  = "post";
                $ret_arr['msg']     = "Failed To Save, Data Already Posted !!!";
                header('Content-Type: text/html');
                echo json_encode($ret_arr);
                exit;
            }
            else
            {
  						$this->db->query("UPDATE 	T_Borrowing
  																			SET			BorrowerID              = '".$borrower."',
                                                BookID                  = '".$bookid."',
                                                StartDate               = '".$sdate."',
                                                EndDate                 = '".$edate."',
                                                TotalBook               = ".$total.",
                                                Description             = '".$desc."',
  																							IsActive 								= 'Y',
                                                Status                  = '1',
  																							LastUpdateDate      		= '".$datetm."',
  																							LastUpdateBy        		= '".$usernm."'
  																			WHERE 	BorrowingID 			      = '".$_GET['id']."'
  														");
  						$msg = "Update";
            }

          }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $_GET['id'];
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    else if (trim($uri) == "post") {
        $res = $this->db->query("SELECT Status, BookID, TotalBook FROM T_Borrowing WHERE BorrowingID = '".$uri1."'")->row();
        if(trim($res->Status) == "5" || trim($res->Status) == "7"){
            $ret_arr['status']  = "post";
            $ret_arr['caption'] = "Already Posted !!!";
            $this->jcode($ret_arr);
            exit();
        }
        else{
          $books = $res->BookID; 
          $qry   = $this->db->query("SELECT BookID, StockBook FROM M_Book WHERE BookID = '".$books."'")->row();
          if(trim($qry->StockBook) > 0 && trim($qry->StockBook) >= trim($res->TotalBook) )
          {
            $this->db->query("UPDATE  T_Borrowing 
                              SET     Status          = '5',
                                      LastUpdateDate  = '".$datetm."',
                                      LastUpdateBy    = '".$usernm."' 
                              WHERE   BorrowingID     = '".$uri1."'
                            ");
            $num = trim($qry->StockBook) - trim($res->TotalBook);
            $sts = (trim($num) == 0) ? "Status = '7'," :"";
            $this->db->query("UPDATE  M_Book 
                              SET     StockBook       = ".$num.",
                                      ".$sts."
                                      LastUpdateDate  = '".$datetm."',
                                      LastUpdateBy    = '".$usernm."' 
                              WHERE   BookID          = '".$books."'
                            ");


            $ret_arr['status']  = "ok";
            $ret_arr['caption'] = "Posted Success !!!";
            $this->jcode($ret_arr);
            exit();
          }
          else{
            $ret_arr['status']  = "failed";
            $ret_arr['caption'] = "StockBook Not Availablle !!!";
            $this->jcode($ret_arr);
            exit();
          }


        }
    }
     else if(trim($uri) == "export"){
      $this->load->model('Borrowing_model');
      $data['title']        = 'Export Borrowing';
      $data['isi']          = 'borrowing/Borrowing_export';
      $data['filenm']       = "Borrowing Transaction";
      $data['databrw']      = $this->Borrowing_model->ViewGetBorrowing()->result();
      $this->load->view('borrowing/Borrowing_export',$data);
    }
    else if(trim($uri) == "print"){
      $this->load->model('Borrowing_model');
      $data['title']        = 'Print Borrowing';
      $data['isi']          = 'borrowing/Borrowing_print';
      $data['databrw']      = $this->Borrowing_model->ViewGetBorrowing()->result();
      $this->load->view('borrowing/Borrowing_print',$data);
    }
    else if (trim($uri) == "delete") {
      $res = $this->db->query("SELECT Status, BookID, TotalBook FROM T_Borrowing WHERE BorrowingID = '".$uri1."'")->row();
        if(trim($res->Status) == "5" || trim($res->Status) == "7"){
            $ret_arr['status']  = "post";
            $ret_arr['caption'] = "Failed To Delete, Data Already Posted !!!";
            $this->jcode($ret_arr);
            exit();
        }
        else
        {
          $this->db->query("UPDATE  T_Borrowing 
                            SET     IsActive        = 'N',
                                    LastUpdateDate  = '".$datetm."',
                                    LastUpdateBy    = '".$usernm."' 
                            WHERE   BorrowingID     = '".$uri1."'
                          ");

          $ret_arr['status']  = "ok";
          $ret_arr['caption'] = "Delete Success !!!";
          $this->jcode($ret_arr);
          exit();
        }
    }
    else{
      $this->load->model('Borrowing_model');
      $data['title']        = 'Data Borrowing';
      $data['isi']          = 'borrowing/Borrowing_view';
      $data['databrw']      = $this->Borrowing_model->ViewGetBorrowing()->result();
      $this->load->view('borrowing/Borrowing_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}