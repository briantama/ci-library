<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dasbor extends CI_Controller {

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index() {
		$uri   = $this->uri->segment(3);
	    $uri1  = $this->uri->segment(4);
	    $uri2  = $this->uri->segment(5);
	    $uri3  = $this->uri->segment(6);

	    $page  = "";
	    $func  = "";
		if(trim($uri1) == "refresh"){
			$page  = $uri1;
	    	$func  = $uri2;
		}

		$data=array('title'=>'Bryn Library - Halaman Administrator',
					'menu' => 'Dashboard',
					'isi'  =>'dasbor/dasbor_view',
					'pages'=> $page,
					'func' => $func
						);
		$this->load->view('layout/wrapper',$data);	
	}


	public function LoadPage() {
		$uri   = $this->uri->segment(3);
	    $uri1  = $this->uri->segment(4);
	    $uri2  = $this->uri->segment(5);
	    $uri3  = $this->uri->segment(6);

	    
		if(!empty($uri1) == "refresh"){
			$page  = $uri1;
	    	$func  = $uri2;
		}
		else{
			$page  = "";
	    	$func  = "";
		}

		$data=array('title'=>'Bryn Library - Halaman Administrator',
					'menu' => 'Dashboard',
					'isi'  =>'dasbor/dasbor_view',
					'pages'=> $page,
					'func' => $func
						);
		$this->load->view('layout/wrapper',$data);	
	}

	public function dasbor_page() {
	    $data=array('title'=>'Bryn Library - Halaman Administrator',
	    			'menu' => 'Dashboard',
	                'isi'  =>'dasbor/dasbor_load'
	            );
	    //$this->load->view('admin/layout/wrapper',$data);  
	    $this->load->view('dasbor/dasbor_load',$data);
	}

}