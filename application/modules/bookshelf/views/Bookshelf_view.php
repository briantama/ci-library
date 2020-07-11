<!-- Begin Page Content -->
<div class="container-fluid animated zoomIn">

<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
            </div>
            <div class="card-body">
                 <p>
                    <div id="notif_user"></div>
                    <a href="#" onclick="return getBookshelf(0);" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Add</a>
                     <a href="<?php echo base_url('bookshelf/viewBookshelf/print'); ?>" target="_BLANK" class="btn btn-info"><i class="fas fa-fw fa-print"></i> Print</a>
                     <a href="<?php echo base_url('bookshelf/viewBookshelf/export'); ?>" target="_BLANK" class="btn btn-success"><i class="fas fa-fw fa-file-excel"></i> Export</a>
                </p>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>BookshelfID</th>
                      <th>ShelfCode</th>
                      <th>ShelfName</th>
                      <th>Position</th>
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
                      <th>BookshelfID</th>
                      <th>ShelfCode</th>
                      <th>ShelfName</th>
                      <th>Position</th>
                      <th>Descripton</th>
                      <th>IsActive</th>
                      <th>EntryDate</th>
                      <th>EntryBy</th>
                      <th>LastUpdateDate</th>
                      <th>LastUpdateBy</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                    <?php               
                    foreach($datashelf as $value){ 
                    ?>

                  
                    <tr>
                      <td nowrap>
                          <a href="#" class="btn btn-warning" onclick="return getBookshelf('<?php echo $value->BookshelfID?>');" title="Edit"><i class="fas fa-fw fa-edit"></i> </a>
                          <a href="#" class="btn btn-danger" onclick="return BookshelfDelete('<?php echo $value->BookshelfID?>');" title="Delete"><i class="fas fa-fw fa-trash"></i> </a>
                      </td>
                      <td><?php echo $value->BookshelfID ?></td>
                      <td><?php echo $value->ShelfCode ?></td>
                      <td><?php echo $value->ShelfName ?></td>
                      <td><?php echo $value->Position ?></td>
                      <td><?php echo $value->Descripton ?></td>
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


<!-- modal popup galeri-->
<div class="modal animated bounceIn" id="getbookshelf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Bookshelf</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">
           <form method="post" action="" name="f_shelf" id="f_shelf" enctype="multipart/form-data">
              <div id="notif-bookshelf"></div>
              <input type="hidden" name="id" id="id" value="0">
              <div class="table-responsive">
              <table class="table table-form">
                <tr><td style="width: 25%">Shelf Code *</td><td style="width: 75%"><input class="form-control" id="shelfcode" name="shelfcode" maxlength="100" type="text" required /></td></tr>
                <tr><td style="width: 25%">Shelf Name *</td><td style="width: 75%"><input class="form-control" id="shelfname" name="shelfname" type="text" required /></td></tr>
                <tr><td style="width: 25%">Position *</td><td style="width: 75%"><input class="form-control" id="position" name="position" maxlength="100" type="email" required /></td></tr>
                <tr><td style="width: 25%">Description </td><td style="width: 75%"><textarea class="form-control" id="desc" name="desc" required></textarea></td></tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="return BookshelfSave();"><i class="fas fa-fw fa-save"></i> Simpan</button>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fas fa-fw fa-sign-out-alt"></i> Tutup</button>
      </div>
        </form>
    </div>
  </div>
</div>
        

<script type="text/javascript">
 $(document).ready(function(){
  $('#dataTable').DataTable();
 });
</script>