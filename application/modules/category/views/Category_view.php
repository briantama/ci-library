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
                    <a href="#" onclick="return getCategory(0);" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Add</a>
                     <a href="<?php echo base_url('category/viewCategory/print'); ?>" target="_BLANK" class="btn btn-info"><i class="fas fa-fw fa-print"></i> Print</a>
                     <a href="<?php echo base_url('category/viewCategory/export'); ?>" target="_BLANK" class="btn btn-success"><i class="fas fa-fw fa-file-excel"></i> Export</a>
                </p>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>CategoryCode</th>
                      <th>CategoryName</th>
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
                      <th>CategoryCode</th>
                      <th>CategoryName</th>
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
                    foreach($datacat as $value){ 
                    ?>

                  
                    <tr>
                      <td nowrap>
                          <a href="#" class="btn btn-warning" onclick="return getCategory('<?php echo $value->CategoryCode?>');" title="Edit"><i class="fas fa-fw fa-edit"></i> </a>
                          <a href="#" class="btn btn-danger" onclick="return DeleteData('<?php echo $value->CategoryCode?>', 'category/viewCategory', 'delete', 'a-category', 'li-master');" title="Delete"><i class="fas fa-fw fa-trash"></i> </a>
                      </td>
                      <td><?php echo $value->CategoryCode ?></td>
                      <td><?php echo $value->CategoryName ?></td>
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


<?php

$doc = "";
$query = $this->db->query("SELECT  CONCAT('C-',LPAD(COALESCE(MAX(RIGHT(CategoryCode, 6)), '000000')+1,6,0)) AS GetID
                           FROM    M_Category
                          ");
 if ($query->num_rows() > 0) {
   $arr = $query->first_row();
   $doc = $arr->GetID;
   //echo $doc;
 }

?>

<!-- modal popup galeri-->
<div class="modal animated bounceIn" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 id="myModalLabel" style="text-align: left;">Form Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="height: 400px !important; overflow:auto;">
           <form method="post" action="" name="f_category" id="f_category" enctype="multipart/form-data">
              <div id="notif-category"></div>
              <input type="hidden" name="id" id="id" value="0">
               <input type="hidden" name="numbering" id="numbering" value="<?php echo $doc; ?>">
              <div class="table-responsive">
              <table class="table table-form">
                <tr><td style="width: 25%">Category Code *</td><td style="width: 75%"><input class="form-control" id="catcode" name="catcode" value="<?php echo $doc; ?>" type="text" required readonly="readonly" /></td></tr>
                <tr><td style="width: 25%">Category Name *</td><td style="width: 75%"><input class="form-control" id="catname" name="catname" type="text" required /></td></tr>
                <tr><td style="width: 25%">Description </td><td style="width: 75%"><textarea class="form-control" id="desc" name="desc" required></textarea></td></tr>
                </table>
              </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="return CategorySave();"><i class="fas fa-fw fa-save"></i> Save</button>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fas fa-fw fa-sign-out-alt"></i> Close</button>
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