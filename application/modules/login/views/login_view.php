
<?php

  $img   = "default.jpeg";
  $imglg = "default.jpeg";
  $stptl = "Apps Library Bryn";
  $query = $this->db->query(" SELECT SetupImage, SetupImageLogo, SetupName
                              FROM   M_Setupprofile
                            ");
    if ($query->num_rows() > 0) {
      $arr   = $query->row();
      $img   = (trim($arr->SetupImage) != "") ? $arr->SetupImage : "default.jpeg";
      $imglg = (trim($arr->SetupImageLogo) != "") ? $arr->SetupImageLogo : "default.jpeg";
  }

  $stptl   = $arr->SetupName;
  $image   = "./upload/profile/".$img;
  $imagelg = "./upload/profile/".$img;

    if(file_exists($image)){
      $image = base_url()."upload/profile/".$img;
    }
    else{
      $image = base_url()."upload/profile/default.jpeg";
    }


    if(file_exists($imagelg)){
      $imagelg = base_url()."upload/logo/".$imglg;
    }
    else{
      $imagelg = base_url()."upload/logo/default.jpeg";
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

  <title><?= $title; ?></title>
  <link rel="shortcut icon" href="<?php echo $imagelg; ?>">

  <!-- Custom fonts for this template-->
  <link href="<?= base_url(); ?>admin-sb2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url(); ?>admin-sb2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block"><img src="<?php echo $image; ?>" class="img-responsive login-img"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><?php echo $stptl; ?></h1>
                  </div>

                   <!-- notif login-->
                  <div id="notif"></div>
                  <div id="konfirmasi"></div>

                  <form class="user" method="POST" action="" id="f_login">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Username : brian">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password : brian">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-flat" type="submit">Log In</button>
                    <hr>
                   <!--  <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  </form>
                  <div class="text-center">
                    <a class="small" href="#">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="#"><font color="black">Copyright &copy; Bryn Apps 2017 - <?php echo date('Y'); ?></font></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>admin-sb2/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>admin-sb2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>admin-sb2/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>admin-sb2/js/sb-admin-2.min.js"></script>


<script type="text/javascript">
   
   $("#username").focus();

  

  $("#f_login").submit(function(event) {
    event.preventDefault();
    var data  = $('#f_login').serialize();
    var user  = $("#username").val();
    var pswd  = $("#password").val();
    if(user == ""){
            $("#notif").show();
            $("#notif").fadeIn(400).html('<div class="load alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info"></i> Please Insert Username..</div>');
            $("#notif" ).delay(3000).hide(2000);
            $("#username").focus();
    }
    else if(pswd == ""){
            $("#notif").show();
            $("#notif").fadeIn(400).html('<div class="load alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fas fa-info"></i> Please Insert Password..</div>');
            $("#notif" ).delay(3000).hide(2000);
            $("#password").focus();
    }
    else{
      $("#konfirmasi").html("<div class='alert alert-info'><img src='<?= base_url(); ?>/admin-sb2/images/load.gif' width='50' height='50'> Checking...</div>")
      $.ajax({
        type: "POST",
        data: data,
        url: "<?= base_URL(); ?>login/getlogin",
        success: function(r) {
          if (r.log.status == 0) {
            $("#konfirmasi").html("<div class='alert alert-danger'><i class='fas fa-info'></i> "+r.log.keterangan+"</div>");
            $("#konfirmasi" ).delay(3000).hide(2000);
            $("#username").val("");
            $("#password").val("");
            $("#username").focus();
          } else {
            $("#konfirmasi").html("<div class='alert alert-success'><i class='fas fa-check'></i> "+r.log.keterangan+"</div>");
            window.location.assign("<?= base_url(); ?>dasbor"); 
          }
        }
      });
    }
  });
</script>

<style type="text/css">
  
  .login-img{
    width: 450px;
    height: 600px;
    background-position: center;
    background-size: cover;
  }

</style>


</body>

</html>
