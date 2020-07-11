<?php

 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=$filenm.xls");
 header("Pragma: no-cache");
 header("Expires: 0");

 if(!empty($keys)){

    $str = "<div class='report list-report'>";
    $str.= "<div class='header-report'>";
    $str.= "<div class='wrap-cap'>";
    if(trim($StartDate) == "" || trim($EndDate) == "")
    {
        $str.= "<div class='cap' style='text-align: center; font-weight: bold;'> Report History Borrower<br/ >Effective Date : ". date('d M Y');
    }
    else
    {
        $str.= "<div class='cap' style='text-align: center; font-weight: bold;'> Report History Borrower<br/ >Effective Date : ".date_format(date_create($StartDate),"d F Y")." - ".date_format(date_create($EndDate),"d F Y"); 
    }
    $str.= "</div>";
    $str.= "</div>";
    $str.= "</div>";

    $str.= "<div id='grid' class='gridvie'>";
    $str.= "<div class='gridview'>";
    $str.= "<div class='cap-table'>&nbsp;</div>";

    $str.= "<table border='1' class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
    $str.= "<thead>";
    $str.= "<tr>";
    $str.= "<th>BorrowerID</th>";
    $str.= "<th>CustomerName</th>";
    $str.= "<th>IdentityID</th>";
    $str.= "<th>MobilePhone</th>";
    $str.= "<th>BookID</th>";
    $str.= "<th>TitleBook</th>";
    $str.= "<th>StartDate</th>";
    $str.= "<th>EndDate</th>";
    $str.= "<th>TotalBook</th>";
    $str.= "</tr>";
    $str.= "</thead>";
    $str.= "<tbody>";



    if(!empty($keys)){
        foreach($keys as $value){ 
                            
        $str.= "<tr>";
        $str.= "<td>".$value->BorrowerID."</td>";
        $str.= "<td>".$value->CustomerName."</td>";
        $str.= "<td>".$value->IdentityID."</td>";
        $str.= "<td>".$value->MobilePhone."</td>";
        $str.= "<td>".$value->BookID."</td>";
        $str.= "<td>".$value->TitleBuku."</td>";
        $str.= "<td>".$value->StartDate."</td>";
        $str.= "<td>".$value->EndDate."</td>";
        $str.= "<td style='text-align:right;'>".$value->TotalBook."</td>";
        $str.= "</tr>";
                            
        
        }
    }
    else{
        $str.= "<tr>";
        $str.= "<td colspan='9'>No Record Data</td>";
        $str.= "</tr>";
    }
                        
                        
    $str.= "</tbody>";
    $str.= "</table>";
    $str.= "</div>";
    $str.= "</div>";
    $str.= "</div>";

    echo $str;


}

?>
