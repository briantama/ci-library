<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

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
	function viewCategory(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $qry = $this->db->query("SELECT * FROM M_Category WHERE CategoryCode = '$uri1'");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        $this->jcode($res);
      }
      else{
        $str["CategoryCode"]  = "";
        $str["CategoryName"]  = "";
        $str["Descripton"]    = "";
        $str["IsActive"]      = "";
        $this->jcode($str);
      }
      exit();
    }
    else if (trim($uri) == "save") {

      //post file
      $catcode   = $_GET['catcode'];
      $catname   = ucwords(strtolower($_GET['catname']));
      $desc      = ucwords(strtolower($_GET['desc']));

      $res = $this->db->query("SELECT CategoryCode FROM M_Category WHERE CategoryCode = '".$_GET['id']."'");
          if ($res->num_rows() == 0) {
						
            $this->db->query("INSERT INTO M_Category
																		( CategoryCode, CategoryName, 
                                      Descripton, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate  ) 
															VALUES 
																		( '".$catcode."', '".$catname."', '".$desc."',
                                      'Y', '".$usernm."', '".$datetm."', '".$usernm."',  '".$datetm."')	
														");
						$msg = "Save";
          }
					else {
						$this->db->query("UPDATE 	M_Category
																			SET			CategoryName            = '".$catname."',
                                              Descripton              = '".$desc."',
																							IsActive 								= 'Y',
																							LastUpdateDate      		= '".$datetm."',
																							LastUpdateBy        		= '".$usernm."'
																			WHERE 	CategoryCode			      = '".$_GET['id']."'
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
      $this->load->model('Category_model');
      $data['title']        = 'Data Category';
      $data['isi']          = 'category/Category_print';
      $data['datacat']      = $this->Category_model->ViewGetCategory()->result();
      $this->load->view('category/Category_print',$data);
    }
    else if (trim($uri) == "delete") {
        $this->db->query("UPDATE  M_Category 
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   CategoryCode    = '".$uri1."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else if(trim($uri) == "export" ){
      $this->load->model('Category_model');
      $data['title']        = 'Export Category';
      $data['isi']          = 'category/Category_export';
      $data['filenm']       = "Master Category Book";
      $data['datacat']      = $this->Category_model->ViewGetCategory()->result();
      $this->load->view('category/Category_export',$data);
    }
    else{
      $this->load->model('Category_model');
      $data['title']        = 'Data Category';
      $data['isi']          = 'category/Category_print';
      $data['datacat']      = $this->Category_model->ViewGetCategory()->result();
      $this->load->view('category/Category_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}