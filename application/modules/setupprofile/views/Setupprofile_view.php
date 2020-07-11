<?php
 

if($stpdata){
  foreach($stpdata as $value){
    $title   = $value->SetupTitle;
    $name    = $value->SetupName;
    $desc    = $value->SetupDescription;
    $idx     = $value->SetupprofileID;
    $img     = (trim($value->SetupImage) != "") ? $value->SetupImage : "default.jpeg";
  }

  $image = "./upload/profile/".$img;

    if(file_exists($image)){
      $image = base_url()."upload/profile/".$img;
    }
    else{
      $image = base_url()."upload/profile/default.jpeg";
    }
}
else
{
    $title   = "";
    $name    = "";
    $desc    = "";
    $idx     = 0;
    $image = base_url()."upload/profile/default.jpeg";
}

?>

<div class="col-lg-12 animated zoomIn">

<!-- Illustrations -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo $titlex; ?></h6>
    </div>
      <div class="card-body">

        <div class="table-responsive" id="blockstp">
          <div id="notif-stpprofile"></div>
          <form method="post" action="" name="f_setup" id="f_setup" enctype="multipart/form-data">
          <div style="overflow:auto;">
          <table class="table table-bordered"  width="100%" cellspacing="0">
            <tbody>
            <tr>
              <td style="text-align: center;" rowspan="0" width="30%">
                <img class="img-respinsive rounded-circle" src="<?php echo $image; ?>" width="280px" height="280px">
                <br><br><input class="form-control btn-primary" id="userfile" type="file" name="userfile" /><p style="text-align: center;"><font color="red"><i style="font-size: 10px;">*max. upload 1MB forrmat .jpg or .png </i></font></p>
              </td>
              <td>SetupTitle</td>
              <input class="form-control" style="display: none;" id="stpidx" type="text" name="stpidx" value="<?php echo $idx ;?>" />
              <td><input class="form-control" id="stptitle" type="text" name="stptitle" value="<?php echo $title ;?>" /></td>
            </tr>
            <tr>
              <td>SetupName</td>
              <td><input class="form-control" id="stpname" type="text" name="stpname" value="<?php echo $name ;?>" /></td>
            </tr>
            <tr>
              <td>Setup Description</td>
              <td><input class="form-control" id="stpdesc" type="text" name="stpdesc" value="<?php echo $desc ;?>" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><button type="button" class="btn btn-primary" onclick="return StpProfileSave();"><i class="fa fa-save"></i> Save changes</button></td>
            </tr>
            </tbody>
          </table>
        </div>
        </form>
        </div>

    </div>
  </div>

</div><!--lg-12-->