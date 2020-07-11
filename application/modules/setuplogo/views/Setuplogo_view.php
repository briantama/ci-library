<?php
 

if($stpdata){
  foreach($stpdata as $value){
    $title   = $value->SetupTitle;
    $name    = $value->SetupName;
    $desc    = $value->SetupDescription;
    $idx     = $value->SetupprofileID;
    $img     = (trim($value->SetupImageLogo) != "") ? $value->SetupImageLogo : "default.jpeg";
  }

  $image = "./upload/logo/".$img;

    if(file_exists($image)){
      $image = base_url()."upload/logo/".$img;
    }
    else{
      $image = base_url()."upload/logo/default.jpeg";
    }
}
else
{
    $title   = "";
    $name    = "";
    $desc    = "";
    $idx     = 0;
    $image = base_url()."upload/logo/default.jpeg";
}

?>

<div class="col-lg-12 animated zoomIn">

<!-- Illustrations -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo $titlex; ?></h6>
    </div>
      <div class="card-body">

        <div class="table-responsive" id="blockstpl">
          <div id="notif-stplogo"></div>
          <form method="post" action="" name="f_setupl" id="f_setupl" enctype="multipart/form-data">
          <div style="overflow:auto;">
          <table class="table table-bordered"  width="100%" cellspacing="0">
            <tbody>
              <input class="form-control" style="display: none;" id="stpidx" type="text" name="stpidx" value="<?php echo $idx ;?>" />
            <tr>
              <td style="text-align: center;" rowspan="0" width="100%">
                <img class="img-respinsive rounded-circle" src="<?php echo $image; ?>" width="380px" height="380px">
                <br><br><input class="form-control btn-primary" id="userfile" type="file" onchange="StpLogoSave();" name="userfile" /><p style="text-align: center;"><font color="red"><i style="font-size: 10px;">*max. upload 1MB size 600px x 800px  forrmat .jpg or .png </i></font></p>
              </td>
              
            </tr>
            </tbody>
          </table>
        </div>
        </form>
        </div>

    </div>
  </div>

</div><!--lg-12-->