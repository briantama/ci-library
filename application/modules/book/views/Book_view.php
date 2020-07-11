  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $title; ?></h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content animated zoomIn">
      <div class="row">
        <div class="col-12">
          
          <div class="card">
            <div class="card-header">
              <a href="#" onclick="return getBook(0);" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
              <a href="<?php echo base_url('book/viewBook/print'); ?>" target="_BLANK" class="btn btn-info"><i class="fas fa-print"></i> Print</a>
              <a href="<?php echo base_url('book/viewBook/export'); ?>" target="_BLANK" class="btn btn-success"><i class="fas fa-file-excel"></i> Export</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
              <table id="datatablex" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Action</th>
                  <th>BookID</th>
                  <th>Isbn</th>
                  <th>TitleBuku</th>
                  <th>Author</th>
                  <th>NumberOfPages</th>
                  <th>CategoryCode</th>
                  <th>BookshelfID</th>
                  <th>ImageBook</th>
                  <th>StockBook</th>
                  <th>LightDamageCosts</th>
                  <th>HeavyDamageCosts</th>
                  <th>LostCost</th>
                  <th>DailyLateFee</th>
                  <th>Status</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </thead>
                <tbody>

                <?php               
                  foreach($bookdata as $value){ 

                     if(trim($value->Status) == "5"){
                        $list = "<span class='badge badge-success'>Available</span>";
                       }
                      else if(trim($value->Status) == "7"){
                        $list = "<span class='badge badge-danger'>Not Available</span>";
                      }
                      else{
                        $list = "<span class='badge badge-warning'>Not Active</span>";
                      }

                ?>

                <tr>
                  <td nowrap> 
                      <a href="#" class="btn btn-warning" onclick="return getBook('<?php echo $value->BookID?>');" title="Edit"><i class="fas fa-edit"></i> </a> 
                      <a href="#" class="btn btn-danger" onclick="return DeleteData('<?php echo $value->BookID?>', 'book/viewBook', 'delete', 'a-book', 'li-master');" title="Delete"><i class="fas fa-trash">
                  </td>
                  <td><?php echo $value->BookID;?></td>
                  <td><?php echo $value->Isbn;?></td>
                  <td><?php echo $value->TitleBuku;?></td>
                  <td><?php echo $value->Author;?></td>
                  <td><?php echo $value->NumberOfPages;?></td>
                  <td><?php echo $value->CategoryCode;?></td>
                  <td><?php echo $value->BookshelfID;?></td>
                  <td><?php echo $value->ImageBook;?></td>
                  <td><?php echo $value->StockBook;?></td>
                  <td><?php echo $value->LightDamageCosts;?></td>
                  <td><?php echo $value->HeavyDamageCosts;?></td>
                  <td><?php echo $value->LostCost;?></td>
                  <td><?php echo $value->DailyLateFee; ?></td>
                  <td><?php echo $list;?></td>
                  <td><?php echo $value->IsActive;?></td>
                  <td><?php echo $value->EntryDate;?></td>
                  <td><?php echo $value->EntryBy;?></td>
                  <td><?php echo $value->LastUpdateDate;?></td>
                  <td><?php echo $value->LastUpdateBy;?></td>
                </tr>

                <?php
                  }
                ?>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Action</th>
                  <th>BookID</th>
                  <th>Isbn</th>
                  <th>TitleBuku</th>
                  <th>Author</th>
                  <th>NumberOfPages</th>
                  <th>CategoryCode</th>
                  <th>BookshelfID</th>
                  <th>ImageBook</th>
                  <th>StockBook</th>
                  <th>LightDamageCosts</th>
                  <th>HeavyDamageCosts</th>
                  <th>LostCost</th>
                  <th>DailyLateFee</th>
                  <th>Status</th>
                  <th>IsActive</th>
                  <th>EntryDate</th>
                  <th>EntryBy</th>
                  <th>LastUpdateDate</th>
                  <th>LastUpdateBy</th>
                </tr>
                </tfoot>
              </table>
              </div><!-- table responsive -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<?php

$doc = "";
$query = $this->db->query("SELECT  CONCAT('BK-',LPAD(COALESCE(MAX(RIGHT(BookID, 6)), '000000')+1,6,0)) AS GetID
                           FROM    M_Book
                          ");
 if ($query->num_rows() > 0) {
   $arr = $query->first_row();
   $doc = $arr->GetID;
   //echo $doc;
 }

?>



   <!--popup-->
  <div class="modal animated bounceIn" id="addbook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content" id="blokform">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Form Book</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="" name="f_book" id="f_book" enctype="multipart/form-data">
              <div id="notif-book"></div>
              <input type="hidden" name="id" id="id" value="0">
              <input type="hidden" name="numbering" id="numbering" value="<?php echo $doc; ?>">
              <div class="table-responsive">
              <table class="table table-form" style="overflow:auto;">
                <tr>
                  <td style="width: 15%">Book ID * <br><div id="viewinfo"></div></td>
                  <td style="width: 35%"><input class="form-control" id="bookid" name="bookid" type="text" readonly="readonly" required /></td>
                  <td style="width: 15%">Isbn *</td>
                  <td style="width: 35%"><input class="form-control" id="isbn" name="isbn" type="text" required /></td>
                </tr>
                 <tr>
                  <td style="width: 15%">Title Buku *</td>
                  <td style="width: 35%"><input class="form-control" id="title" name="title" type="text" required /></td>
                  <td style="width: 15%">Author </td>
                  <td style="width: 35%"><input class="form-control" id="author" name="author" type="text" required /></td>
                </tr>
                <tr>
                  <td style="width: 15%">Number Of pages *</td>
                  <td style="width: 35%"><input class="form-control" id="pages" name="pages" type="text" required /></td>
                  <td style="width: 15%">Category Code *</td>
                  <td style="width: 35%"><input class="form-control" id="category" name="category" type="text" required /></td>
                </tr>
                <tr>
                  <td style="width: 15%">BookshelfID *</td>
                  <td style="width: 35%"><input class="form-control" id="shelf" name="shelf" type="text" required /></td>
                  <td style="width: 15%">StockBook *</td>
                  <td style="width: 35%"><input class="form-control" id="stock" name="stock" type="number" required /></td>
                </tr>
                <tr>
                  <td style="width: 15%">LightDamageCosts *</td>
                  <td style="width: 35%"><input class="form-control" id="light" name="light" type="text" required /></td>
                  <td style="width: 15%">HeavyDamageCosts *</td>
                  <td style="width: 35%"><input class="form-control" id="heavy" name="heavy" type="text" required /></td>
                </tr>
                <tr>
                  <td style="width: 15%">LostCost *</td>
                  <td style="width: 35%"><input class="form-control" id="lost" name="lost" type="text" required /></td>
                  <td style="width: 15%">Daily Late Fee *</td>
                  <td style="width: 35%"><input class="form-control" id="late" name="late" type="text" required /></td>
                  </tr>
                <tr>
                  <td style="width: 15%">Book Image</td>
                  <td style="width: 35%"><input class="form-control " id="userfile" type="file" name="userfile" /><br><div id="viewgambar"></div></td>
                  <td colspan="2" style="width: 50%">
                    <font color="red"><i style="font-size: 10px;">*upload forrmat .jpg or .png </i> <br>
                    <font color="red"><i style="font-size: 10px;">*max. upload 1MB </i>
                  </td>
                </tr>

              </table>
            </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="return BookSave();">Save changes</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<script type="text/javascript">
 $(document).ready(function(){
  $('#datatablex').DataTable();


   var base_url = window.location.origin;
    $( "#shelf" ).autocomplete({
      serviceUrl: base_url+"/ci-library/book/viewBook/searchshelf",   // Kode php untuk prosesing data.
      dataType: "JSON",           // Tipe data JSON.
      onSelect: function (suggestion) {
      $("#shelf").val("" + suggestion.key);
      $("#light").focus(); 
      }
    });

    $( "#category" ).autocomplete({
      serviceUrl: base_url+"/ci-library/book/viewBook/searchcategory",   // Kode php untuk prosesing data.
      dataType: "JSON",           // Tipe data JSON.
      onSelect: function (suggestion) {
      $("#category").val("" + suggestion.key);
      $("#shelf").focus(); 
      }
    });


 });
</script>




