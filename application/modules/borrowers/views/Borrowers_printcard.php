<?php
  
  //header logo

  $img   = "default.jpeg";
  $stpnm = "Aplikasi Library Bryn";
  $stpdc = "Jalan Langgang Buaya Kadal";
  $query = $this->db->query(" SELECT SetupImageLogo, SetupTitle, SetupDescription
                              FROM   M_Setupprofile
                            ");
  if ($query->num_rows() > 0) {
      $arr   = $query->row();
      $img   = (trim($arr->SetupImageLogo) != "") ? $arr->SetupImageLogo : "default.jpeg";
      $stpnm = $arr->SetupTitle;
      $stpdc = $arr->SetupDescription;
  }

  $image = "./upload/logo/".$img;

  if(file_exists($image)){
      $image = base_url()."upload/logo/".$img;
    }
    else{
      $image = base_url()."upload/logo/default.jpeg";
    }

  
  $cusid = "-";
  $cusnm = "-";
  $cusno = "-";
  $cusad = "-"; 
  $cusml = "-";
  $csimg = "default.jpeg";

  if($bordata){              
    foreach($bordata as $value){ 
      $cusid = $value->BorrowerID;
      $cusnm = $value->CustomerName;
      $cusno = $value->MobilePhone;
      $cusad = $value->Address;
      $cusml = $value->Email;
      $csimg = (trim($value->BorrowerImage) != "" ) ? $value->BorrowerImage : "default.jpeg";
    
    }

    $urlimg = "./upload/borrowers/".$csimg;

    if(file_exists($urlimg)){
      $linkimg = base_url()."upload/borrowers/".$csimg;
    }
    else{
      $linkimg = base_url()."upload/borrowers/default.jpeg";
    }


  }

?>


    <div class="print-card">
      <table width="100%" rules="cols">
         <thead>
                    <tr class="header-tbl">
                      <th width="15%"><img src="<?php echo $image;?>" width="40" height="40"></th>
                      <th colspan="2" width="35%"><?php echo $stpnm;?><p style="font-size: 8px"><?php echo $stpdc;?></p></th>
                      <th width="15%"><img src="<?php echo $image;?>" width="40" height="40"></th>
                      <th colspan="2" width="35%"><?php echo $stpnm;?><p style="font-size: 8px"><?php echo $stpdc;?></p></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <tr class="content">
                      <td colspan="6"></td>
                    </tr>  
                    
                    <tr class="content">
                      <td>No ID</td>
                      <td>: <?php echo $cusid; ?></td>
                      <td rowspan="5" ><img src="<?php echo $linkimg;?>" width="80" height="80"></td>
                      <td rowspan="5" colspan="3" style="padding-left: 10px;">
                        * Harap Membawa Kartu Ini saat berkunjung ke Perpustakan <br>
                        * Kartu ini Tidak dapat dipindah tangankan <br>
                        * Kartu ini berlaku seumur hidup<br>
                        * Kartu ini dapat digunakan di seleruh cabang perpustakaan brian<br>
                        * Harap menghubungi perpustakaan brian bila menemukan kartu ini<br>
                      </td> 
                    </tr>
                    <tr class="content-font">
                      <td>Name</td>
                      <td>: <?php echo $cusnm; ?></td>
                    </tr class="content-font">
                     <tr class="content-font">
                      <td>Email</td>
                      <td nowrap>: <?php echo $cusml; ?></td>  
                    </tr>
                    <tr class="content-font">
                      <td>Phone</td>
                      <td>: <?php echo $cusno; ?></td>  
                    </tr>
                     <tr class="content-font">
                      <td>Address</td>
                      <td>: <?php echo $cusad; ?></td>
                    </tr>
                    <tr class="content">
                      <td colspan="6"></td>
                    </tr>  
                    <tr class="content">
                      <td colspan="3">Print By : <?php echo $this->session->userdata('nama'); ?></td>
                      <td colspan="3">Print By : <?php echo $this->session->userdata('nama'); ?></td>
                    </tr>  
                  </tbody>
                </table>
            </div>


     


<style>

  .print-card {
    width: 600px;
    max-width: 600px;
}


  table {
    border-collapse: collapse;
    border: 1px solid black;
  }

  tr.content,
  table {
      border-top: 1px solid black;
      border-collapse: collapse;
      font-size: 10px;
  }

  tr.content-font,
  table {
      font-size: 10px;
  }

  tr.header-tbl,
  table {
      height: 60px;
      font-size: 16px;
  }
      
</style>

<script>window.print();</script>