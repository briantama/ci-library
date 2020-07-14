<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Borrowers extends CI_Controller {

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


	//
	function viewBorrowers(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $qry = $this->db->query("SELECT * FROM M_Borrowers WHERE BorrowerID = '$uri1'");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        $this->jcode($res);
      }
      else{
        $str["BorrowerID"]    = "";
        $str["CustomerName"]  = "";
        $str["MobilePhone"]   = "";
        $str["HomePhone"]     = "";
        $str["DateOfBirth"]   = "";
        $str["Address"]       = "";
        $str["IdentityID"]    = "";
        $str["Email"]         = "";
        $str["Gender"]        = "";
        $str["BorrowerImage"]    = "";
        $str["IsActive"]      = "";
        $this->jcode($str);
      }

      exit();
    }
    else if (trim($uri) == "save") {
      $status = "";
      $msg    = "";
      $file_element_name = 'userfile';

      //code post 
      $custid     = strtoupper($_POST['custid']);
      $custname   = ucwords(strtolower($_POST['custname']));
      $mobphone   = $_POST['mobphone'];
      $homephone  = $_POST['homephone'];
      $identityid = $_POST['identityid'];
      $addres     = ucwords(strtolower($_POST['addres']));
      $email      = $_POST['email'];
      $gender     = $_POST['gender'];
      $birth      = $_POST["birth"];

      if ($status != "error") {
        $config['upload_path']   = './upload/borrowers/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;
        $config['encrypt_name']  = FALSE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
          $status = 'ok';
          $msg = $this->upload->display_errors('', '');

          if ($_POST['id'] != "") {
            $this->db->query("UPDATE  M_Borrowers
                                      SET     CustomerName       = '".$custname."',
                                              MobilePhone         = '".$mobphone."',
                                              HomePhone           = '".$homephone."',
                                              Address             = '".$addres."',
                                              IdentityID          = '".$identityid."',
                                              Email               = '".$email."',
                                              Gender              = '".$gender."',
                                              DateOfBirth         = '".$birth."',
                                              IsActive            = 'Y',
                                              LastUpdateDate      = '".$datetm."',
                                              LastUpdateBy        = '".$usernm."'
                                      WHERE   BorrowerID             = '".$_POST['id']."'");
          } 
          else {

            //notif save error uload image null
            $jeson['status']   = "bad";
            $jeson['msg']      = "Customer Image, ".$msg;
            $jeson['focus']    = "userfile";
            header('Content-Type: text/html');
            echo json_encode($jeson);
            exit;

            $this->db->query("INSERT INTO M_Borrowers
                                    (BorrowerID, CustomerName, MobilePhone, HomePhone, Address, IdentityID, Email,
                                     DateOfBirth, Gender, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate) 
                              VALUES 
                                    ('".$custid."', '".$custname."', '".$mobphone."','".$homephone."','".$addres."', '".$identityid."', '".$email."',
                                     '".$birth."', '".$gender."', 'Y', '".$datetm."', '".$usernm."', '".$datetm."', '".$usernm."')
                                    ");
          }
        } 
        else {
          $data = $this->upload->data();
          $image_path = $data['full_path'];
          if(file_exists($image_path)) {
            $status = "ok";
            $msg    = "Upload gambar berhasil";
          } else {
            $status = "ok";
            $msg    = "Terjadi kesalahan. Ulangi lagi.";
          }
          $ambil_gambar = $this->db->query("SELECT BorrowerImage FROM M_Borrowers WHERE BorrowerID = '".$_POST['id']."'")->row();
          if ($_POST['id'] != "") {
            unlink("./upload/borrowers/".$ambil_gambar->BorrowerImage);
            $this->db->query("UPDATE  M_Borrowers
                                      SET     BorrowerImage          = '".$data['file_name']."', 
                                              CustomerName        = '".$custname."',
                                              MobilePhone         = '".$mobphone."',
                                              HomePhone           = '".$homephone."',
                                              Address             = '".$addres."',
                                              IdentityID          = '".$identityid."',
                                              Email               = '".$email."',
                                              Gender              = '".$gender."',
                                              DateOfBirth         = '".$birth."',
                                              IsActive            = 'Y',
                                              LastUpdateDate      = '".$datetm."',
                                              LastUpdateBy        = '".$usernm."'
                                      WHERE   BorrowerID             = '".$_POST['id']."'
                            ");
          } else {
            $this->db->query("INSERT INTO M_Borrowers
                                    (BorrowerID, CustomerName, MobilePhone, HomePhone, Address, IdentityID, Email,
                                     DateOfBirth, Gender, BorrowerImage, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate ) 
                              VALUES 
                                    ('".$custid."', '".$custname."', '".$mobphone."','".$homephone."','".$addres."', '".$identityid."', '".$email."',
                                     '".$birth."', '".$gender."', '".$data['file_name']."', 'Y', '".$usernm."', '".$datetm."', '".$usernm."', '".$datetm."') 
                            ");
          }
          
        }
      }
      $jeson['status']   = $status;
      $jeson['id']       = $_POST['id'];
      $jeson['msg']      = "Borrowers Save ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }

    else if (trim($uri) == "delete") {
        $this->db->query("UPDATE  M_Borrowers 
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   BorrowerID         = '".$uri1."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else if(trim($uri) == "export"){
      $this->load->model('Borrowers_model');
      $data['title']        = 'Export Borrowers';
      $data['isi']          = 'borrowers/Borrowers_export';
      $data['filenm']       = "Master Borrower";
      $data['bordata']      = $this->Borrowers_model->ViewGetBorrowes()->result();
      $this->load->view('borrowers/Borrowers_export',$data);
    }
    else if(trim($uri) == "print"){
      $this->load->model('Borrowers_model');
      $data['title']        = 'Print Borrowers';
      $data['isi']          = 'borrowers/Borrowers_print';
      $data['bordata']      = $this->Borrowers_model->ViewGetBorrowes()->result();
      $this->load->view('borrowers/Borrowers_print',$data);
    }
    else if(trim($uri) == "print-borrowers"){
      $this->load->model('Borrowers_model');
      $where                = array('BorrowerID' =>  $uri1);
      $data['title']        = 'Print Card Borrowers';
      $data['isi']          = 'borrowers/Borrowers_printcard';
      $data['bordata']      = $this->Borrowers_model->ViewGetBorrowesUser($where, "M_Borrowers")->result();
      $this->load->view('borrowers/Borrowers_printcard',$data);
    }
    else{
      $this->load->model('Borrowers_model');
      $data['title']        = 'Data Borrowers';
      $data['isi']          = 'borrowers/Borrowers_view';
      $data['bordata']      = $this->Borrowers_model->ViewGetBorrowes()->result();
      //$this->load->view('admin/layout/wrapper',$data);
      //view code call ajax
      //$this->load->view('merk/merk_view',$data);
      $this->load->view('borrowers/Borrowers_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}