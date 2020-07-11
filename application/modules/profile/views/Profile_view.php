<?php

  foreach($dataAdmin as $value){
    $name    = $value->AdminName;
    $usernm  = $value->UserName;
    $email   = $value->email;
    $hbd     = $value->DateOfBirth;
    $spur    = $value->SuperUser;
    $img     = (trim($value->AdminImage) != "") ? $value->AdminImage : "default.jpeg";
  }

  $image = "upload/user/".$img;

    if(file_exists($image)){
      $image = base_url()."upload/user/".$img;
    }
    else{
      $image = base_url()."upload/user/default.jpeg";
    }


?>

<div class="col-lg-12 animated zoomIn">

<!-- Illustrations -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
    </div>
      <div class="card-body">

        <div class"table-responsive">
          <div id="notif-admin"></div>
          <form method="post" action="" name="f_admin" id="f_admin" enctype="multipart/form-data">
          <div style="overflow:auto;">
          <table class="table table-bordered"  width="100%" cellspacing="0">
            <tbody>
            <tr>
              <td style="text-align: center;" rowspan="0" width="30%">
                <img class="img-respinsive rounded-circle" src="<?php echo $image; ?>" width="280px" height="280px">
                <br><br><input class="form-control btn-primary" id="userfile" type="file" name="userfile" onchange="UploadImage();" /><p style="text-align: center;"><font color="red"><i style="font-size: 10px;">*max. upload 1MB forrmat .jpg or .png </i></font></p>
              </td>
              <td>Name</td>
              <td>: <?php echo $name; ?></td>
            </tr>
            <tr>
              <td>UserName</td>
              <td>: <?php echo $usernm; ?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td>: <?php echo $email; ?></td>
            </tr>
            <tr>
              <td>Date Of Birth</td>
              <td>: <?php echo $hbd; ?></td>
            </tr>
            <tr>
              <td>Super User</td>
              <td>: <?php echo $spur; ?></td>
            </tr>
            </tbody>
          </table>
        </div>
        </form>
        </div>

    </div>
  </div>

</div><!--lg-12-->