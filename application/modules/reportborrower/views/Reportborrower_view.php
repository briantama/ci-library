  <!-- Begin Page Content -->
<div class="container-fluid animated fadeInRight">

<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
            </div>

            <div class="card-body">  
              <form method="post" action="" name="r_borrower" id="r_borrower" enctype="multipart/form-data">
              <div id="notif-rpt"></div>
              <div class="table-responsive">
              <table class="table table-sm table-form" style="overflow:auto;">
                 <tr>
                  <td style="width: 15%">Borrower ID * <br><div id="viewinfo"></div></td>
                  <td style="width: 35%"><input class="form-control" id="borrower" name="borrower" type="text" required /></td>
                  <td style="width: 15%">Cust. Name *</td>
                  <td style="width: 35%"><input class="form-control" id="borrowername" name="borrowername" type="text" required readonly="readonly" /></td>
                </tr>
                 <tr>
                  <td style="width: 15%">Start Date *</td>
                  <td style="width: 35%"><input class="form-control" id="startdate" name="startdate" type="text" required /></td>
                  <td style="width: 15%">End Date </td>
                  <td style="width: 35%"><input class="form-control" id="enddate" name="enddate" type="text" required /></td>
                </tr>
                <tr>
                  <td style="width: 15%">BookID *</td>
                  <td style="width: 35%"><input class="form-control" id="bookid" name="bookid" type="text" required /></td>
                  <td style="width: 15%">Title Boook *</td>
                  <td style="width: 35%"><input class="form-control" id="bookname" name="bookname" type="text" required readonly="readonly" /></td>
                </tr>
                <tr>
                  <td style="width: 15%">Isbn *</td>
                  <td style="width: 35%"><input class="form-control" id="isbn" name="isbn" type="text" required /></td>
                  <td style="width: 15%">Author *</td>
                  <td style="width: 35%"><input class="form-control" id="author" name="author" type="text" required/></td>
                </tr>
               <tr>
                  <td colspan="4" align="left">
                     <button type="button" class="btn btn-warning" onclick="callpage('reportborrower/viewReportborrower', '', '')"><i class="fas fa-fw fa-eraser"></i>  Reset</button>
                     <button type="button" class="btn btn-primary" onclick="return ReportSearch('r_borrower', 'reportborrower/viewReportborrower/view');"><i class="fas fa-fw fa-search"></i> Search</button>
                  </td>
                </tr>
              </table>
              </div><!-- table responsive -->
            </form>
            </div>

            <div class="card-body">
              <div class="table-responsive">

                <div id="content-rpt">
                  <?php $this->load->view('reportborrower/Reportborrower_search', array('keys'=>$str)); ?>
                </div>

              </div><!-- table responsive -->
            </div>

          </div>

</div><!-- /.container-fluid -->




<style>
      .gridvie {
        font-family: Times New Roman, Times, serif;
        height: 92%;
        overflow: auto; 
      }
      .gridview table { border: 1px solid #00557F; }
      .gridview table .total td {
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ff66b8), color-stop(1,#ff66b8));
        background:-moz-linear-gradient( center top, #ff66b8 5%, #ff66b8 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff66b8', endColorstr='#ff66b8');
        border: 1px solid #00557F;
        color: #000;
        
      }
      .gridview table .total td:first-child { text-align: center; border-right: 1px solid #FFF; }
      .gridview table .total td:last-child { text-align: right; }
      .cap-table, .gridview table { width: 98%; margin: 0 auto; }
      .cap-table { color: #000; padding: 5px 0 5px 0; }
  </style>


<script type="text/javascript">
$(" #custname ").focus();

$(document).ready(function(){

  var base_url = window.location.origin;
    $( "#bookid" ).autocomplete({
      serviceUrl: base_url+"/ci-library/reportborrower/viewReportborrower/searchbook",   // Kode php untuk prosesing data.
      dataType: "JSON",           // Tipe data JSON.
      onSelect: function (suggestion) {
      $("#bookid").val("" + suggestion.key);
      $("#bookname").val("" + suggestion.keynm);
      }
    });

    $( "#borrower" ).autocomplete({
      serviceUrl: base_url+"/ci-library/reportborrower/viewReportborrower/searchborrower",   // Kode php untuk prosesing data.
      dataType: "JSON",           // Tipe data JSON.
      onSelect: function (suggestion) {
      $("#borrower").val("" + suggestion.key);
      $("#borrowername").val(""+ suggestion.keynm);
      }
    });



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


</script>




