<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Returnbook extends CI_Controller {

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
	function viewReturnbook(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $qry = $this->db->query(" SELECT  A.ReturnBookID, A.BorrowingID, A.ReturnDate, A.TotalReturnBook, A.LateCharge, A.Description, A.Status, 
                                        A.IsActive, A.EntryBy, A.EntryDate, A.LastUpdateBy, A.LastUpdateDate ,
                                        B.StartDate, B.EndDate, B.TotalBook, C.CustomerName, C.BorrowerID, 
                                        D.BookID, D.TitleBuku, D.LightDamageCosts, D.HeavyDamageCosts, D.LostCost, D.DailyLateFee, 
                                        A.DamageOrLostBook, A.DamageCost, A.TotalCost
                                FROM    T_ReturnBook A
                                INNER   JOIN T_Borrowing B ON A.BorrowingID=B.BorrowingID
                                INNER   JOIN M_Borrowers C ON B.BorrowerID=C.BorrowerID
                                INNER   JOIN M_Book D ON B.BookID=D.BookID
                                WHERE   A.IsActive ='Y'
                                        AND A.ReturnBookID = '$uri1'");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        $this->jcode($res);
      }
      else{
        $str["ReturnBookID"]   = "";
        $str["BorrowingID"]    = "";
        $str["CustomerName"]   = "";
        $str["BorrowerID"]     = "";
        $str["BookID"]         = "";
        $str["TitleBuku"]      = "";
        $str["StartDate"]      = "";
        $str["EndDate"]        = "";
        $str["ReturnDate"]     = "";
        $str["TotalReturnBook"]= "";
        $str["TotalBook"]      = "";
        $str["LateCharge"]     = "";
        $str["Description"]    = "";
        $str["LightDamageCosts"]  = "";
        $str["HeavyDamageCosts"]  = "";
        $str["LostCost"]          = "";
        $str["DailyLateFee"]      = "";
        $str["DamageOrLostBook"]  = "";
        $str["DamageCost"]        = "";
        $str["TotalCost"]         = "";

        $str["Status"]         = "";
        $str["IsActive"]       = "";
       
        $this->jcode($str);
      }
      exit();
    }
     else if(trim($uri) == "search"){
        $varbl = $_GET["query"];
        $query = $this->db->query(" SELECT A.BorrowingID, A.BorrowerID, A.BookID, A.StartDate, A.EndDate, A.TotalBook, A.Description, 
                                           A.Status, A.IsActive , B.StockBook, B.TitleBuku, C.CustomerName,
                                           B.LightDamageCosts, B.HeavyDamageCosts, B.LostCost, B.DailyLateFee,
                                           D.ReturnBookID, D.DamageOrLostBook, D.DamageCost, D.TotalCost, D.ReturnDate, D.LateCharge
                                    FROM   T_Borrowing A 
                                    INNER  JOIN M_Book B ON A.BookID=B.BookID
                                    INNER  JOIN M_Borrowers C ON A.BorrowerID=C.BorrowerID
                                    LEFT   JOIN T_ReturnBook D ON A.BorrowingID = D.BorrowingID
                                    WHERE  A.IsActive  = 'Y'
                                           AND A.Status ='5'
                                           AND A.BorrowingID NOT IN (SELECT BorrowingID FROM T_ReturnBook WHERE IsActive = 'Y')
                                           AND (C.CustomerName LIKE '%".$varbl."%' OR A.BorrowingID LIKE '%".$varbl."%')
                              ");
         if ($query->num_rows() > 0) {
          $arr = $query->result();
          foreach($arr as $key){
            $data["suggestions"][] = ["value" => $key->BorrowingID."-".$key->CustomerName, 
                                      "key" => $key->BorrowingID, 
                                      "keynm" => $key->CustomerName,
                                      "borid" => $key->BorrowerID,
                                      "bookid" => $key->BookID,
                                      "booknm" => $key->TitleBuku,
                                      "sdate" => $key->StartDate,
                                      "edate" => $key->EndDate,
                                      "total" => $key->TotalBook,
                                      "light" => $key->LightDamageCosts,
                                      "heavy" => $key->HeavyDamageCosts,
                                      "lost" => $key->LostCost,
                                      "late" => $key->DailyLateFee,
                                      "stock" => $key->TotalBook,
                                      "rtnbk" => $key->ReturnBookID
                                      ];
          }
         }
         else{
          $data["suggestions"][] = ["value" => "", 
                                    "key" => "", 
                                    "keynm" => "",
                                    "borid" => "",
                                    "bookid" => "",
                                    "booknm" => "",
                                    "sdate" => "",
                                    "edate" => "",
                                    "total" => "",
                                    "light" => "",
                                    "heavy" => "",
                                    "lost" => "",
                                    "late" => "",
                                    "stock" => "",
                                    "rtnbk" => ""
                                    ];
         }

         $this->jcode($data);
         exit;
    }
    else if (trim($uri) == "save") {

      //post file
      $borrowing   = $_GET['borrowing'];
      $return      = $_GET['return'];
      $rdate       = $_GET['returndate'];
      $total       = $_GET["total"];
      $late        = $_GET["late"];
      $desc        = ucwords(strtolower($_GET['desc']));
      $damage      = $_GET["damage"];
      $dmcost      = $_GET["amount"];
      $amount      = $_GET["cost"];

      $res = $this->db->query("SELECT ReturnBookID FROM T_ReturnBook WHERE ReturnBookID = '".$_GET['id']."'");
          if ($res->num_rows() == 0) {
						
            $this->db->query("INSERT INTO T_ReturnBook
																		( ReturnBookID, BorrowingID, ReturnDate, TotalReturnBook, LateCharge, Description,  
                                      DamageOrLostBook, DamageCost , TotalCost,
                                      Status, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
															VALUES 
																		( '".$return."', '".$borrowing."',  '".$rdate."',  ".$total.",  ".$late.", '".$desc."',
                                      '".$damage."', ".$dmcost.", ".$amount.", 
                                      '1', 'Y', '".$usernm."', '".$datetm."', '".$usernm."',  '".$datetm."')	
														");
						$msg = "Save";
          }
					else {

            $res = $this->db->query("SELECT Status FROM T_ReturnBook WHERE ReturnBookID = '".$_GET['id']."'")->row();
            if(trim($res->Status) == "5" || trim($res->Status) == "7"){
                $ret_arr['status']  = "post";
                $ret_arr['msg']     = "Failed To Save, Data Already Posted !!!";
                header('Content-Type: text/html');
                echo json_encode($ret_arr);
                exit;
            }
            else
            {
  						$this->db->query("UPDATE 	T_ReturnBook
  																			SET			BorrowingID             = '".$borrowing."',
                                                ReturnDate              = '".$rdate."',
                                                TotalReturnBook         = ".$total.",
                                                LateCharge              = ".$late.",
                                                Description             = '".$desc."',
                                                DamageOrLostBook        = '".$damage."',
                                                DamageCost              = ".$dmcost.",
                                                TotalCost               = ".$amount.",
  																							IsActive 								= 'Y',
                                                Status                  = '1',
  																							LastUpdateDate      		= '".$datetm."',
  																							LastUpdateBy        		= '".$usernm."'
  																			WHERE 	ReturnBookID 			      = '".$_GET['id']."'
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

        $res = $this->db->query("SELECT A.Status, A.TotalReturnBook, B.BookID , A.BorrowingID
                                 FROM   T_ReturnBook A
                                 INNER  JOIN T_Borrowing B ON A.BorrowingID=B.BorrowingID 
                                 WHERE  A.ReturnBookID = '".$uri1."'
                                ")->row();
        if(trim($res->Status) == "5" || trim($res->Status) == "7"){
            $ret_arr['status']  = "post";
            $ret_arr['caption'] = "Already Posted !!!";
            $this->jcode($ret_arr);
            exit();
        }
        else{
            $borrow  = $res->BorrowingID;
            $rtnbook = $res->TotalReturnBook; 
            $bookst  = $res->BookID; 
            $qry     = $this->db->query("SELECT BookID, StockBook FROM M_Book WHERE BookID = '".$bookst."'")->row();
            $stockvl = $qry->StockBook + $rtnbook;
            $booksts = (trim($stockvl) > 0) ? "5" : "7";
          
            $this->db->query("UPDATE  T_ReturnBook 
                              SET     Status          = '5',
                                      LastUpdateDate  = '".$datetm."',
                                      LastUpdateBy    = '".$usernm."' 
                              WHERE   ReturnBookID     = '".$uri1."'
                            ");
             //update book
            $this->db->query("UPDATE  M_Book 
                              SET     Status          = '".$booksts."',
                                      StockBook       = ".$stockvl.",
                                      LastUpdateDate  = '".$datetm."',
                                      LastUpdateBy    = '".$usernm."' 
                              WHERE   BookID          = '".$bookst."'
                            ");

            //update borrowing
            $this->db->query("UPDATE  T_Borrowing 
                              SET     Status          = '7',
                                      LastUpdateDate  = '".$datetm."',
                                      LastUpdateBy    = '".$usernm."' 
                              WHERE   BorrowingID     = '".$borrow."'
                            ");

            $ret_arr['status']  = "ok";
            $ret_arr['caption'] = "Posted Success !!!";
            $this->jcode($ret_arr);
            exit();
    
        }
    }
    else if(trim($uri) == "export"){
      $this->load->model('Returnbook_model');
      $data['title']        = 'Export Return Book';
      $data['isi']          = 'returnbook/Returnbook_export';
      $data['filenm']       = "Return Book Transaction";
      $data['datartn']      = $this->Returnbook_model->ViewGetReturnbook()->result();
      $this->load->view('returnbook/Returnbook_export',$data);
    }
    else if(trim($uri) == "print"){
      $this->load->model('Returnbook_model');
      $data['title']        = 'Print Return Book';
      $data['isi']          = 'returnbook/Returnbook_print';
      $data['datartn']      = $this->Returnbook_model->ViewGetReturnbook()->result();
      $this->load->view('returnbook/Returnbook_print',$data);
    }
    else if (trim($uri) == "delete") {
      $res = $this->db->query("SELECT Status FROM T_ReturnBook WHERE ReturnBookID = '".$uri1."'")->row();
        if(trim($res->Status) == "5" || trim($res->Status) == "7"){
            $ret_arr['status']  = "post";
            $ret_arr['caption'] = "Failed To Delete, Data Already Posted !!!";
            $this->jcode($ret_arr);
            exit();
        }
        else
        {
          $this->db->query("UPDATE  T_ReturnBook 
                            SET     IsActive        = 'N',
                                    LastUpdateDate  = '".$datetm."',
                                    LastUpdateBy    = '".$usernm."' 
                            WHERE   ReturnBookID    = '".$uri1."'
                          ");

          $ret_arr['status']  = "ok";
          $ret_arr['caption'] = "Delete Success !!!";
          $this->jcode($ret_arr);
          exit();
        }
    }
    else{
      $this->load->model('Returnbook_model');
      $data['title']        = 'Data Return Book';
      $data['isi']          = 'returnbook/Returnbook_view';
      $data['datartn']      = $this->Returnbook_model->ViewGetReturnbook()->result();
      $this->load->view('returnbook/Returnbook_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}