<div class='report list-report'>
<div class='header-report'>
<div class='wrap-cap'>
<div class='cap' style='text-align: center; font-weight: bold;'>Report Borrowing Books<br/ >Effective Date : <?php echo date('d M Y'); ?>
</div>
</div>
</div>

<div id='grid' class='gridvie'>
<div class='gridview'>
    <div class='cap-table'>&nbsp;</div>

        <table border='1' class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
                    <tr>
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
                  <tbody>
                    
                    <?php      
                    if($databrw){         
                      foreach($databrw as $value){

                      if(trim($value->Status) == "1"){
                        $list = "<span class='badge badge-danger'>Active</span>";
                      }
                      else if(trim($value->Status) == "5"){
                        $list = "<span class='badge badge-warning'>OnGoing</span>";
                      }
                      else{
                        $list = "<span class='badge badge-success'>Finish</span>";
                      }

                    ?>
                    
                    <tr>
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
                    }
                    else
                    {
                    ?>

                     <tr>
                      <td colspan="13" style="text-align: center;">No Data Borrowing</td>
                    </tr>

                    <?php
                    }
                    ?>
                    
                  </tbody>
        </table>
  </div>
</div>
</div>

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

<script>window.print();</script>