<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller {

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
	function viewBook(){
    $uri   = $this->uri->segment(3);
    $uri1  = $this->uri->segment(4);
    $uri2  = $this->uri->segment(5);
    $jdeco = json_decode(file_get_contents('php://input'));
	 
    //get date time
    $datetm= date('Y-m-d H:i:s');
    $usernm= $this->session->userdata('nama');

    if(trim($uri) == "view"){
      $qry = $this->db->query("SELECT * FROM M_Book WHERE BookID = '$uri1'");
      if ($qry->num_rows() > 0) {
        $res = $qry->row();
        $this->jcode($res);
      }
      else{
        $str["BookID"]        = "";
        $str["Isbn"]          = "";
        $str["TitleBuku"]     = "";
        $str["Author"]        = "";
        $str["NumberOfPages"] = "";
        $str["CategoryCode"]  = "";
        $str["BookshelfID"]   = "";
        $str["ImageBook"]     = "";
        $str["StockBook"]     = "";
        $str["Status"]        = "";
        $str["IsActive"]      = "";
        $str["LightDamageCosts"] = "";
        $str["HeavyDamageCosts"] = "";
        $str["LostCost"]         = "";
        $str["DailyLateFee"]     = "";
        $this->jcode($str);
      }

      exit();
    }
     else if(trim($uri) == "searchshelf"){
        $varbl = $_GET["query"];
        $query = $this->db->query(" SELECT  BookshelfID, ShelfCode, ShelfName, Position, Descripton,
                                            IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate
                                    FROM    M_BookShelf
                                    WHERE   IsActive  = 'Y'
                                            AND (BookshelfID LIKE '%".$varbl."%' OR ShelfName LIKE '%".$varbl."%')
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
                                            AND (CategoryCode LIKE '%".$varbl."%' OR CategoryName LIKE '%".$varbl."%')
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
    else if (trim($uri) == "save") {
      $status = "";
      $msg    = "";
      $file_element_name = 'userfile';

      //code post 
      $bookid     = strtoupper($_POST['bookid']);
      $isbn       = $_POST['isbn'];
      $title      = ucwords(strtolower($_POST['title']));
      $author     = $_POST['author'];
      $pages      = $_POST['pages'];
      $category   = $_POST['category'];
      $shelf      = $_POST['shelf'];
      $stock      = $_POST["stock"];
      $light      = $_POST["light"];
      $heavy      = $_POST["heavy"];
      $lost       = $_POST["lost"];
      $late       = $_POST["late"];
      $sts        = "5";

      if ($status != "error") {
        $config['upload_path']   = './upload/book/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;
        $config['encrypt_name']  = FALSE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file_element_name)) {
          $status = 'ok';
          $msg = $this->upload->display_errors('', '');

          if ($_POST['id'] != "") {
            $this->db->query("UPDATE  M_Book
                                      SET     Isbn                = '".$isbn."',
                                              TitleBuku           = '".$title."',
                                              Author              = '".$author."',
                                              NumberOfPages       = '".$pages."',
                                              CategoryCode        = '".$category."',
                                              BookshelfID         = ".$shelf.",
                                              StockBook           = ".$stock.",
                                              Status              = '".$sts."',
                                              LightDamageCosts    = ".$light.",
                                              HeavyDamageCosts    = ".$heavy.",
                                              LostCost            = ".$lost.",
                                              DailyLateFee        = ".$late.",
                                              IsActive            = 'Y',
                                              LastUpdateDate      = '".$datetm."',
                                              LastUpdateBy        = '".$usernm."'
                                      WHERE   BookID              = '".$_POST['id']."'");
          } 
          else {

            //notif save error uload image null
            $jeson['status']   = "bad";
            $jeson['msg']      = "Book Image, ".$msg;
            $jeson['focus']    = "userfile";
            header('Content-Type: text/html');
            echo json_encode($jeson);
            exit;

            $this->db->query("INSERT INTO M_Book
                                    ( BookID, Isbn, TitleBuku, Author, NumberOfPages, CategoryCode, BookshelfID, 
                                      LightDamageCosts, HeavyDamageCosts, LostCost, DailyLateFee,
                                      StockBook, Status, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate) 
                              VALUES 
                                    ('".$bookid."', '".$isbn."', '".$title."','".$author."','".$pages."', '".$category."', ".$shelf.",
                                     ".$light.", ".$heavy.",".$lost.", ".$late.",
                                     ".$stock.", '".$sts."', 'Y', '".$usernm."', '".$datetm."', '".$usernm."', '".$datetm."')
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
          $ambil_gambar = $this->db->query("SELECT ImageBook FROM M_Book WHERE BookID = '".$_POST['id']."'")->row();
          if ($_POST['id'] != "") {
            unlink("./upload/book/".$ambil_gambar->ImageBook);
            $this->db->query("UPDATE  M_Book
                                      SET     ImageBook           = '".$data['file_name']."', 
                                              Isbn                = '".$isbn."',
                                              TitleBuku           = '".$title."',
                                              Author              = '".$author."',
                                              NumberOfPages       = '".$pages."',
                                              CategoryCode        = '".$category."',
                                              BookshelfID         = ".$shelf.",
                                              StockBook           = ".$stock.",
                                              Status              = '".$sts."',
                                              LightDamageCosts    = ".$light.",
                                              HeavyDamageCosts    = ".$heavy.",
                                              LostCost            = ".$lost.",
                                              DailyLateFee        = ".$late.",
                                              IsActive            = 'Y',
                                              LastUpdateDate      = '".$datetm."',
                                              LastUpdateBy        = '".$usernm."'
                                      WHERE   BookID              = '".$_POST['id']."'
                            ");
          } else {
            $this->db->query("INSERT INTO M_Book
                                    (BookID, Isbn, TitleBuku, Author, NumberOfPages, CategoryCode, BookshelfID, ImageBook, 
                                     LightDamageCosts, HeavyDamageCosts, LostCost, DailyLateFee,
                                     StockBook, Status, IsActive, EntryBy, EntryDate, LastUpdateBy, LastUpdateDate ) 
                              VALUES 
                                    ('".$bookid."', '".$isbn."', '".$title."','".$author."','".$pages."', '".$category."', ".$shelf.", '".$data['file_name']."',
                                     ".$light.", ".$heavy.",".$lost.", ".$late.",
                                     ".$stock.", '".$sts."', 'Y', '".$usernm."', '".$datetm."', '".$usernm."', '".$datetm."')
                            ");
          }
        }
      }
      $jeson['status']   = $status;
      $jeson['id']       = $_POST['id'];
      $jeson['msg']      = "Book Save ".$msg;
      $jeson['notif']    = "Successfuly Saved !!!";
      header('Content-Type: text/html');
      echo json_encode($jeson);
      exit;
    }

    else if (trim($uri) == "delete") {
        $this->db->query("UPDATE  M_Book 
                          SET     IsActive        = 'N',
                                  LastUpdateDate  = '".$datetm."',
                                  LastUpdateBy    = '".$usernm."' 
                          WHERE   BookID          = '".$uri1."'
                        ");

        $ret_arr['status']  = "ok";
        $ret_arr['caption'] = "Delete Success !!!";
        $this->jcode($ret_arr);
        exit();
    }
    else if(trim($uri) == "export"){
      $this->load->model('Book_model');
      $data['title']        = 'Export Book';
      $data['isi']          = 'book/Book_export';
      $data['filenm']       = 'Master Book';
      $data['bookdata']     = $this->Book_model->ViewGetBook()->result();
      $this->load->view('book/Book_export',$data);
    }
    else if(trim($uri) == "print"){
      $this->load->model('Book_model');
      $data['title']        = 'Print Book';
      $data['isi']          = 'book/Book_print';
      $data['bookdata']     = $this->Book_model->ViewGetBook()->result();
      $this->load->view('book/Book_print',$data);
    }
    else{
      $this->load->model('Book_model');
      $data['title']        = 'Data Book';
      $data['isi']          = 'book/Book_view';
      $data['bookdata']     = $this->Book_model->ViewGetBook()->result();
      $this->load->view('book/Book_view',$data);
    }
	}

  public function jcode($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  

}