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
                    <a href="#" onclick="return getReturnBook(0);" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Add</a>
                    <a href="<?php echo base_url('returnbook/viewReturnbook/print'); ?>" target="_BLANK" class="btn btn-info"><i class="fas fa-fw fa-print"></i> Print</a>
                    <a href="<?php echo base_url('returnbook/viewReturnbook/export'); ?>" target="_BLANK" class="btn btn-success"><i class="fas fa-fw fa-file-excel"></i> Export</a>
                </p>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>ReturnBookID</th>
                      <th>BorrowingID</th>
                      <th>Cust. ID</th>
                      <th>Cust. Name</th>
                      <th>BookID</th>
                      <th>TitleBook</th>
                      <th>StartDate</th>
                      <th>EndDate</th>
                      <th>TotalBook</th>
                      <th>ReturnDate</th>
                      <th>TotalReturnBook</th>
                      <th>LateCharge</th>
                      <th>DamageOrLostBook</th>
                      <th>DamageCost</th>
                      <th>TotalCost</th>
                      <th>Status</th>
                      <th>Description</th>
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
                      <th>ReturnBookID</th>
                      <th>BorrowingID</th>
                      <th>Cust. ID</th>
                      <th>Cust. Name</th>
                      <th>BookID</th>
                      <th>TitleBook</th>
                      <th>StartDate</th>
                      <th>EndDate</th>
                      <th>TotalBook</th>
                      <th>ReturnDate</th>
                      <th>TotalReturnBook</th>
                      <th>LateCharge</th>
                      <th>DamageOrLostBook</th>
                      <th>DamageCost</th>
                      <th>TotalCost</th>
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
                    foreach($datartn as $value){ 

                      if(trim($value->Status) == "1"){
                        $list = "<span class='badge badge-danger'>Active</span>";
                        $btn  = "<a href='#' class='btn btn-info' onclick='return setPostData(\"$value->ReturnBookID\", \"Returnbook/viewReturnbook\", \"post\", \"a-returnbook\", \"li-transaction\");' title='Post'><i class='fas fa-fw fa-share'></i> </a>";
                        //$btn  = '<a href="#" class="btn btn-info" onclick="return setPostData($value->BorrowingID, borrowing/viewBorrowing, post, a-borrowing, li-transaction);" title="Post"><i class="fas fa-fw fa-share"></i> </a>';
                        //$btn  = "<a href=\"#\" class=\"btn btn-info\" onclick=\"return setPostData(\"$value->BorrowingID\", \"borrowing/viewBorrowing\", \"post\", \"a-borrowing\", \"li-transaction\");\" title=\"Post\"><i class=\"fas fa-fw fa-share\"></i> </a>";
                      }
                      else if(trim($value->Status) == "5"){
                        $list = "<span class='badge badge-success'>Finish</span>";
                        $btn  = "";
                      }
                      else{
                        $list = "<span class='badge badge-warning'>Not Active</span>";
                        $btn  = "";
                      }

                    ?>

                  
                    <tr>
                      <td nowrap>
                          <a href="#" class="btn btn-warning" onclick="return getReturnBook('<?php echo $value->ReturnBookID?>');" title="Edit"><i class="fas fa-fw fa-edit"></i> </a>
                          <a href="#" class="btn btn-danger" onclick="return DeleteData('<?php echo $value->ReturnBookID?>', 'Returnbook/viewReturnbook', 'delete', 'a-returnbook', 'li-transaction');" title="Delete"><i class="fas fa-fw fa-trash"></i> </a>
                          <?php echo $btn; ?>
                      </td>
                      <td><?php echo $value->ReturnBookID ?></td>
                      <td><?php echo $value->BorrowingID ?></td>
                      <td><?php echo $value->BorrowerID ?></td>
                      <td><?php echo $value->CustomerName ?></td>
                      <td><?php echo $value->BookID ?></td>
                      <td><?php echo $value->TitleBuku ?></td>
                      <td><?php echo $value->StartDate ?></td>
                      <td><?php echo $value->EndDate ?></td>
                      <td><?php echo $value->TotalBook ?></td>
                      <td><?php echo $value->ReturnDate ?></td>
                      <td><?php echo $value->TotalReturnBook ?></td>
                      <td><?php echo $value->LateCharge ?></td>
                      <td><?php echo $value->DamageOrLostBook ?></td>
                      <td><?php echo $value->DamageCost ?></td>
                      <td><?php echo $value->TotalCost ?></td>
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
$query = $this->db->query("SELECT  CONCAT('RTB-".$stx."-',LPAD(COALESCE(MAX(RIGHT(ReturnBookID, 6)), '000000')+1,6,0)) AS GetID
                           FROM    T_ReturnBook
                          ");
 if ($query->num_rows() > 0) {
   $arr = $query->first_row();
   $doc = $arr->GetID;
   //echo $doc;
 }

?>

<!-- modal popup galeri-->
<div class="modal animated bounceIn" id="addreturnbook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
          <h4 id="myModalLabel" style="text-align: left;">Form Return Book</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 430px !important; overflow:auto;">
           <form method="post" action="" name="f_returnbook" id="f_returnbook" enctype="multipart/form-data">
              <div id="notif-returnbook"></div>
              <input type="hidden" name="id" id="id" value="0">
              <input type="hidden" name="idlight" id="idlight" value="0">
              <input type="hidden" name="idheavy" id="idheavy" value="0">
              <input type="hidden" name="idlost" id="idlost" value="0">
              <input type="hidden" name="idlate" id="idlate" value="0">
              <input type="hidden" name="stock" id="stock" value="0">
               <input type="hidden" name="numbering" id="numbering" value="<?php echo $doc; ?>">
              <div class="table-responsive">
              <table class="table table-sm table-form">
                <tr>
                  <td style="width: 15%">No. ReturnBook *</td><td style="width: 35%"><input class="form-control" id="return" name="return" value="<?php echo $doc; ?>" type="text" required readonly="readonly" /></td>
                  <td style="width: 15%">No. Borrowing *</td><td style="width: 35%"><input class="form-control" id="borrowing" name="borrowing" value="<?php echo $doc; ?>" type="text" required /></td></tr>
                <tr>
                  <td style="width: 15%">Borrower ID *</td><td style="width: 35%"><input class="form-control" id="borrower" name="borrower" type="text" required readonly="readonly"/></td>
                  <td style="width: 15%">Name *</td><td style="width: 35%"><input class="form-control" id="borrowername" name="borrowername" type="text" required readonly="readonly"/></td>
                </tr>
                <tr>
                  <td style="width: 15%">Book ID *</td><td style="width: 35%"><input class="form-control" id="bookid" name="bookid" type="text" required readonly="readonly"/></td>
                  <td style="width: 15%">Book Name *</td><td style="width: 35%"><input class="form-control" id="bookname" name="bookname" type="text" required readonly="readonly"/></td>
                </tr>
                <tr>
                  <td style="width: 15%">StartDate *</td><td style="width: 35%"><input class="form-control" id="startdate" name="startdate" type="text" required readonly="readonly"/></td>
                  <td style="width: 15%">EndDate *</td><td style="width: 35%"><input class="form-control" id="enddate" name="enddate" type="text" required readonly="readonly"/></td>
                </tr>
                <tr>
                  <td style="width: 15%">Return Date *</td><td style="width: 35%"><input class="form-control" id="returndate" name="returndate" type="text" required/></td>
                  <td style="width: 15%">Late Charge *</td><td style="width: 35%"><input class="form-control" id="late" name="late" type="text" required readonly="readonly"/><div id="viewdays"></td>
                </tr>
                <tr>
                  <td style="width: 15%">Total Book *</td><td style="width: 15%"><input class="form-control" id="total" name="total" type="number" required readonly="readonly"/><br><div id="totalinfo"></div></td>
                  <td style="width: 25%">Description </td><td style="width: 75%"><textarea class="form-control" id="desc" name="desc" required></textarea></td>
                </tr>
                <tr>
                  <td colspan="4" style="width: 15%">Damage Or Lost Book</td>
                </tr>
                <tr>
                  <td style="width: 15%">DamageBook *</td>
                  <td style="width: 35%">
                          <select name="damage" onChange="getDamageCost();" id="damage" class="form-control">
                            <option value="">Choice</option>
                            <option value="Light">Light Damge Book</option>
                            <option value="Heavy">Heavy Damage Book</option>
                            <option value="Lost">Lost Book</option>
                        </select></td>
                  <td style="width: 15%">Amount Damage *</td><td style="width: 15%"><input class="form-control" id="amount" name="amount" type="text" required readonly="readonly"/></div></td>
                  
                </tr>
                <tr>
                  <td colspan="3" style="width: 15%">Total Return Cost *</td><td style="width: 85%"><input class="form-control" id="cost" name="cost" type="text" required readonly="readonly"/></div></td>
                   </tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="return ReturnBookSave();"><i class="fas fa-fw fa-save"></i> Save</button>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fas fa-fw fa-sign-out-alt"></i> Close</button>
      </div>
        </form>
    </div>
  </div>
</div>
        

<script type="text/javascript">
  function getDamageCost(){
    var idlight  = $("#idlight").val();
    var idheavy  = $("#idheavy").val();
    var idlost   = $("#idlost").val();
    var idstock  = $("#stock").val();
    var damage   = $("#damage").val();
    var latech   = $("#late").val();

    if(damage == "Light"){
      $("#amount").val(idlight);
      $("#total").val(idstock);
      $("#cost").val( (parseInt(idlight) * parseInt(idstock) ) + parseInt(latech) );
    }
    else if(damage == "Heavy"){
      $("#amount").val(idheavy);
      $("#total").val(idstock);
      $("#cost").val( (parseInt(idheavy) * parseInt(idstock) ) + parseInt(latech) );
    }
    else if(damage == "Lost"){
      $("#amount").val(idlost);
      $("#total").val(0);
      $("#cost").val( (parseInt(idlost) * parseInt(idstock) ) + parseInt(latech) );
    }
    else{
      $("#amount").val(0);
      $("#total").val(idstock);
      $("#cost").val(parseInt(latech));
    }
  }


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
    $( "#borrowing" ).autocomplete({
      serviceUrl: base_url+"/ci-library/Returnbook/viewReturnbook/search",   // Kode php untuk prosesing data.
      dataType: "JSON",           // Tipe data JSON.
      onSelect: function (suggestion) {
      $( "#borrowing" ).val("" + suggestion.key);
      $( "#borrowername" ).val("" + suggestion.keynm);
      $( "#borrower" ).val("" + suggestion.borid);

      $( "#bookid" ).val("" + suggestion.bookid);
      $( "#bookname" ).val("" + suggestion.booknm);
      $( "#startdate" ).val("" + suggestion.sdate);
      $( "#enddate" ).val("" + suggestion.edate);
      $( "#returndate" ).val("" + suggestion.edate);
      $( "#total" ).val("" + suggestion.total);
      $( "#idlight" ).val("" + suggestion.light);
      $( "#idheavy" ).val("" + suggestion.heavy);
      $( "#idlost" ).val("" + suggestion.lost);
      $("#idlate").val(""+ suggestion.late);
      $("#stock").val(""+suggestion.stock);
      (suggestion.rtnbk) ? $("#return").val(""+suggestion.rtnbk) : "";
      (suggestion.rtnbk) ? $("#id").val(""+suggestion.rtnbk) : "";
      $("#returndate").focus();
      $("#totalinfo").html('<font color="red"><i style="font-size: 12px;">* '+  suggestion.stock+ 'Borrowing Book</i></font>');
      }
    });


$('#returndate').datepicker({
  format: "yyyy-mm-dd",
  todayHighlight: true,
  orientation: "bottom auto",
  autoclose:true
}).on('changeDate', function (selected) {
   //alert(selected.format(0,"yyyy-mm-dd"));
   //  console.log(selected);
   var datex    = selected.format(0,"yyyy-mm-dd");
   var enddate  = $("#enddate").val();
   var dyrent   = $("#idlate").val();
   var damage   = $("#amount").val();
   var totbook  = $("#stock").val();
   //alert(dyrent);
   //var x = daysDifference(enddate, datex);
   var diff     = Math.floor(( Date.parse(datex) - Date.parse(enddate) ) / 86400000);
   var totalx   = ((parseInt(dyrent) * parseInt(diff)) * parseInt(totbook) ) + parseInt(damage);
   $("#late").val( (parseInt(dyrent) * parseInt(diff)) * parseInt(totbook)  ); 
   $("#viewdays").html('<font color="red"><i style="font-size: 12px;">* DailyLateFee '+dyrent+'<br>* '+diff+' Days Late Return Of The Book</i></font>');
   $("#cost").val(totalx);
   
   //alert(diff);
});


 });
</script>