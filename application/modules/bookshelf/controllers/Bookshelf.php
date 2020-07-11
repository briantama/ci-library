<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookshelf extends CI_Controller {

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
	function viewBookshelf(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $qry = $this->db->query("SELECT * FROM M_BookShelf WHERE BookshelfID = '$uri1'");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        $this->jcode($res);
      }
      else{
        $str["BookshelfID"]   = 0;
        $str["ShelfCode"]     = "";
        $str["ShelfName"]     = "";
        $str["Position"]      = "";
        $str["Descripton"]    = "";
        $str["IsActive"]      = "";
        $this->jcode($str);
      }
      exit();
    }
    else if (trim($uri) == "save") {

      //post file
      $shelfcode   = ucwords(strtolower($_GET['shelfcode']));
      $shelfname   = ucwords(strtolower($_GET['shelfname']));
      $position    = ucwords(strtolower($_GET['position']));
      $desc        = ucwords(strtolower($_GET['desc']));

      $res = $this->db->query("SELECT BookshelfID FROM M_BookShelf WHERE BookshelfID = '".$_GET['id']."'");
          if ($res->num_rows() == 0) {
						
            $this->db->query("INSERT INTO M_BookShelf
																		( ShelfCode, ShelfName, Position, Descripton,
                                      IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate ) 
															VALUES 
																		( '".$shelfcode."', '".$shelfname."', '".$position."', '".$desc."',
                                      'Y', '".$usernm."', '".$datetm."', '".$usernm."',  '".$datetm."')	
														");
						$msg = "Save";
          }
					else {
						$this->db->query("UPDATE 	M_BookShelf
																			SET			ShelfCode    		    	  = '".$shelfcode."',
                                              ShelfName               = '".$shelfname."',
                                              Position                = '".$position."',
                                              Descripton              = '".$desc."',
																							IsActive 								= 'Y',
																							LastUpdateDate      		= '".$datetm."',
																							LastUpdateBy        		= '".$usernm."'
																			WHERE 	BookshelfID  			      = '".$_GET['id']."'
														");
						$msg = "Update";
          }
        
      
      $jeson['status']   = "ok";
      $jeson['id']       = $_GET['id'];
      $jeson['msg']      = "Successfuly ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }
    else if(trim($uri) == "print"){
      $this->load->model('Bookshelf_model');
      $data['title']        = 'Data Bookshelf';
      $data['isi']          = 'bookshelf/Bookshelf_print';
      $data['datashelf']    = $this->Bookshelf_model->ViewGetBookshelf()->result();
      $this->load->view('bookshelf/Bookshelf_print',$data);
    }
    else if (trim($uri) == "delete") {
        $this->db->query("UPDATE  M_BookShelf 
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   BookshelfID     = '".$uri1."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else if(trim($uri) == "export"){
      $this->load->model('Bookshelf_model');
      $data['title']        = 'Data Bookshelf';
      $data['isi']          = 'bookshelf/Bookshelf_export';
      $data['filenm']       = "Master Bookshelf";
      $data['datashelf']    = $this->Bookshelf_model->ViewGetBookshelf()->result();
      $this->load->view('bookshelf/Bookshelf_export',$data);
    }
    else{
      $this->load->model('Bookshelf_model');
      $data['title']        = 'Data Bookshelf';
      $data['isi']          = 'bookshelf/Bookshelf_view';
      $data['datashelf']    = $this->Bookshelf_model->ViewGetBookshelf()->result();
      $this->load->view('bookshelf/Bookshelf_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}