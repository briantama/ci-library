<!-- Begin Page Content -->
<div class="container-fluid animated fadeInRight">

<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
            </div>
            <div class="card-body">
                 <p>
                    <div id="notif_user"></div>
                    <a href="#" onclick="return getBorrowing(0);" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Add</a>
                     <a href="<?php echo base_url('borrowing/viewBorrowing/print'); ?>" target="_BLANK" class="btn btn-info"><i class="fas fa-fw fa-print"></i> Print</a>
                    <a href="<?php echo base_url('borrowing/viewBorrowing/export'); ?>" target="_BLANK" class="btn btn-success"><i class="fas fa-fw fa-print"></i> Export</a>
                </p>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>BorrowingID</th>
                      <th>BorrowerID</th>
                      <th>BookID</th>
                      <th>StartDate</th>
                      <th>EndDate</th>
                      <th>TotalBook</th>
                      <th>Status</th>
                      <th>Descripton</th>
                      <th>IsActive</th>
                      <th>EntryDate</th>
                      <th>EntryBy</th>
                      <th>LastUpdateDate</th>
                      <th>LastUpdateBy</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Action</th>
                      <th>BorrowingID</th>
                      <th>BorrowerID</th>
                      <th>BookID</th>
                      <th>StartDate</th>
                      <th>EndDate</th>
                      <th>TotalBook</th>
                      <th>Status</th>
                      <th>Description</th>
                      <th>IsActive</th>
                      <th>EntryDate</th>
                      <th>EntryBy</th>
                      <th>LastUpdateDate</th>
                      <th>LastUpdateBy</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                   <?php               
                    foreach($databrw as $value){ 

                      if(trim($value->Status) == "1" ){
                        $list = "<span class='badge badge-danger'>Active</span>";
                        $btn  = "<a href='#' class='btn btn-info' onclick='return setPostData(\"$value->BorrowingID\", \"borrowing/viewBorrowing\", \"post\", \"a-borrowing\", \"li-transaction\");' title='Post'><i class='fas fa-fw fa-share'></i> </a>";
                        //$btn  = '<a href="#" class="btn btn-info" onclick="return setPostData($value->BorrowingID, borrowing/viewBorrowing, post, a-borrowing, li-transaction);" title="Post"><i class="fas fa-fw fa-share"></i> </a>';
                        //$btn  = "<a href=\"#\" class=\"btn btn-info\" onclick=\"return setPostData(\"$value->BorrowingID\", \"borrowing/viewBorrowing\", \"post\", \"a-borrowing\", \"li-transaction\");\" title=\"Post\"><i class=\"fas fa-fw fa-share\"></i> </a>";
                      }
                      else if(trim($value->Status) == "5"){
                        $list = "<span class='badge badge-warning'>OnGoing</span>";
                        $btn  = "";
                      }
                      else{
                        $list = "<span class='badge badge-success'>Finish</span>";
                        $btn  = "";
                      }

                    ?>

                  
                    <tr>
                      <td nowrap>
                          <a href="#" class="btn btn-warning" onclick="return getBorrowing('<?php echo $value->BorrowingID?>');" title="Edit"><i class="fas fa-fw fa-edit"></i> </a>
                          <a href="#" class="btn btn-danger" onclick="return DeleteData('<?php echo $value->BorrowingID?>', 'borrowing/viewBorrowing', 'delete', 'a-borrowing', 'li-transaction');" title="Delete"><i class="fas fa-fw fa-trash"></i> </a>
                          <?php echo $btn; ?>
                      </td>
                      <td><?php echo $value->BorrowingID ?></td>
                      <td><?php echo $value->BorrowerID ?></td>
                      <td><?php echo $value->BookID ?></td>
                      <td><?php echo $value->StartDate ?></td>
                      <td><?php echo $value->EndDate ?></td>
                      <td><?php echo $value->TotalBook ?></td>
                      <td><?php echo $list ?></td>
                      <td><?php echo $value->Description ?></td>
                      <td><?php echo $value->IsActive ?></td>
                      <td><?php echo $value->EntryDate ?></td>
                      <td><?php echo $value->EntryBy ?></td>
                      <td><?php echo $value->LastUpdateDate ?></td>
                      <td><?php echo $value->LastUpdateBy ?></td>
                    </tr>
                    
                    <?php
                    }
                    ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

</div><!-- /.container-fluid -->


<?php

$doc = "";
$stx = date('ymd');
$query = $this->db->query("SELECT  CONCAT('BRG-".$stx."-',LPAD(COALESCE(MAX(RIGHT(BorrowingID, 6)), '000000')+1,6,0)) AS GetID
                           FROM    T_Borrowing
                          ");
 if ($query->num_rows() > 0) {
   $arr = $query->first_row();
   $doc = $arr->GetID;
   //echo $doc;
 }

?>

<!-- modal popup galeri-->
<div class="modal animated bounceIn" id="addborrowing" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          <h4 id="myModalLabel" style="text-align: left;">Form Borrowing Book</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">
           <form method="post" action="" name="f_borrowing" id="f_borrowing" enctype="multipart/form-data">
              <div id="notif-borrowing"></div>
              <input type="hidden" name="id" id="id" value="0">
              <input type="hidden" name="stock" id="stock" value="0">
               <input type="hidden" name="numbering" id="numbering" value="<?php echo $doc; ?>">
              <div class="table-responsive">
              <table class="table table-form">
                <tr>
                  <td align="left" style="width: 15%">No. Borrowing *</td><td colspan="3" style="width: 85%"><input class="form-control" id="borrowing" name="borrowing" value="<?php echo $doc; ?>" type="text" required readonly="readonly" /></td></tr>
                <tr>
                  <td style="width: 15%">Borrower ID *</td><td style="width: 35%"><input class="form-control" id="borrower" name="borrower" type="text" autocomplete="off" required /></td>
                  <td style="width: 15%">Name *</td><td style="width: 35%"><input class="form-control" id="borrowername" name="borrowername" type="text" required readonly="readonly"/></td>
                </tr>
                <tr>
                  <td style="width: 15%">Book ID *</td><td style="width: 35%"><input class="form-control" id="bookid" name="bookid" type="text" required /></td>
                  <td style="width: 15%">Book Name *</td><td style="width: 35%"><input class="form-control" id="bookname" name="bookname" type="text" required readonly="readonly"/></td>
                </tr>
                <tr>
                  <td style="width: 15%">StartDate *</td><td style="width: 35%"><input class="form-control" id="startdate" name="startdate" type="text" required  autocomplete="off" /></td>
                  <td style="width: 15%">EndDate *</td><td style="width: 35%"><input class="form-control" id="enddate" name="enddate" type="text" required autocomplete="off" /></td>
                </tr>
                <tr>
                  <td style="width: 15%">Total Book *</td><td style="width: 15%"><input class="form-control" id="total" onClick="getStockBook()" name="total" type="number" required/><br><div id="totalinfo"></div></td>
                  <td style="width: 25%">Description </td><td style="width: 75%"><textarea class="form-control" id="desc" name="desc" required></textarea></td>
                </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="return BorrowingSave();"><i class="fas fa-fw fa-save"></i> Save</button>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fas fa-fw fa-sign-out-alt"></i> Close</button>
      </div>
        </form>
    </div>
  </div>
</div>
        

<script type="text/javascript">
  function getStockBook(){
    var stock  = $("#stock").val();
    var istock = $("#total").val();
    var book   = $("#bookid").val();

    if(book != ""){
      if(istock <= 0){
        $("#notif-borrowing").show("slow");
        $('#notif-borrowing').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> TotalBook Minimum 1</div>'); 
        $('#notif-borrowing').delay(2000).hide(2000);
        $("#total").val(stock);
        $("#total").focus();
      }
      else if(istock > stock){
        $("#notif-borrowing").show("slow");
        $('#notif-borrowing').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> TotalBook melebihi stock</div>'); 
        $('#notif-borrowing').delay(2000).hide(2000);
        $("#total").val(stock);
        $("#total").focus(); 
      }
    }
    else{
        $("#notif-borrowing").show("slow");
        $('#notif-borrowing').fadeIn(2000).html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <i class="fas fa-info-circle"></i> Please Insert BookID</div>'); 
        $('#notif-borrowing').delay(2000).hide(2000);
        $("#total").val(stock);
        $("#bookid").focus(); 
    }

  }

 $(document).ready(function(){
  $('#dataTable').DataTable();

    var base_url = window.location.origin;
    $( "#borrower" ).autocomplete({
      serviceUrl: base_url+"/ci-library/borrowing/viewBorrowing/search",   // Kode php untuk prosesing data.
      dataType: "JSON",           // Tipe data JSON.
      onSelect: function (suggestion) {
      $( "#borrower" ).val("" + suggestion.key);
      $( "#borrowername" ).val("" + suggestion.keynm);
      $("#bookid").focus();
      }
    });

    var base_url = window.location.origin;
    $( "#bookid" ).autocomplete({
      serviceUrl: base_url+"/ci-library/borrowing/viewBorrowing/searchbook",   // Kode php untuk prosesing data.
      dataType: "JSON",           // Tipe data JSON.
      onSelect: function (suggestion) {
      $( "#bookid" ).val("" + suggestion.key);
      $( "#bookname" ).val("" + suggestion.keynm);
      $( "#stock" ).val("" + suggestion.stock);
      $( "#total" ).val("1");
      $( "#totalinfo" ).html("<font color='red'><i style='font-size: 12px;'>" + suggestion.stock+ " Book Available </i></font>");
      $("#startdate").focus();
      }
    });


  $('#startdate').datepicker({
    format: "yyyy-mm-dd",
    todayHighlight: true,
    orientation: "bottom auto",
    autoclose:true
  });

  $('#enddate').datepicker({
    format: "yyyy-mm-dd",
    todayHighlight: true,
    orientation: "bottom auto",
    autoclose:true
  });

 });
</script>