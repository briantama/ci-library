<?php

  $img   = "default.jpeg";
  $stpnm = "Aplikasi Library Bryn";
  $query = $this->db->query(" SELECT SetupImageLogo, SetupName
                              FROM   M_Setupprofile
                            ");
  if ($query->num_rows() > 0) {
      $arr   = $query->row();
      $img   = (trim($arr->SetupImageLogo) != "") ? $arr->SetupImageLogo : "default.jpeg";
      $stpnm = $arr->SetupName;
  }

  $image = "./upload/logo/".$img;

  if(file_exists($image)){
      $image = base_url()."upload/logo/".$img;
    }
    else{
      $image = base_url()."upload/logo/default.jpeg";
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $stpnm; ?></title>
  <link rel="shortcut icon" href="<?php echo $image; ?>">

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>admin-sb2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>admin-sb2/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- my style css-->
  <link href="<?php echo base_url(); ?>admin-sb2/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>admin-sb2/css/animate.css" rel="stylesheet">
  
  <!-- Custom styles for this page -->
  <link href="<?php echo base_url(); ?>admin-sb2/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  
  
  <!-- datepicker-->
  <link href="<?php echo base_url(); ?>admin-sb2/js/bootstrap-datepicker.min.css" rel="stylesheet">
  <script src="<?php echo base_url(); ?>admin-sb2/vendor/jquery/jquery-1.11.3.min.js"></script>

</head>

<style type="text/css">
  .shownotifmsg {
    position:fixed;
    bottom:70%;
    right:2px;
    float:right;
    z-index:103;
  }
</style>

<body id="page-top">