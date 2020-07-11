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
        $str.= "<div class='cap' style='text-align: center; font-weight: bold;'> Report Return Book<br/ >Effective Date : ". date('d M Y');
    }
    else
    {
        $str.= "<div class='cap' style='text-align: center; font-weight: bold;'> Report Return Book<br/ >Effective Date : ".date_format(date_create($StartDate),"d F Y")." - ".date_format(date_create($EndDate),"d F Y"); 
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
    $str.= "<th>ReturnBookID</th>";
    $str.= "<th>BorrowingID</th>";
    $str.= "<th nowrap>Cust. Name</th>";
    $str.= "<th>BookID</th>";
    $str.= "<th>StartDate</th>";
    $str.= "<th>EndDate</th>";
    $str.= "<th>TotalBook</th>";
    $str.= "<th>DailyLateFee</th>";
    $str.= "<th>ReturnDate</th>";
    $str.= "<th>Tot.ReturnBook</th>";
    $str.= "<th>LateCharge</th>";
    $str.= "<th>DamageOrLost</th>";
    $str.= "<th>DamageCost</th>";
    $str.= "<th>TotalCost</th>";
    $str.= "</tr>";
    $str.= "</thead>";
    $str.= "<tbody>";



    if(!empty($keys)){
        foreach($keys as $value){ 
                            
        $str.= "<tr>";
        $str.= "<td>".$value->ReturnBookID."</td>";
        $str.= "<td>".$value->BorrowingID."</td>";
        $str.= "<td>".$value->CustomerName."</td>";
        $str.= "<td>".$value->BookID."</td>";
        $str.= "<td>".$value->StartDate."</td>";
        $str.= "<td>".$value->EndDate."</td>";
        $str.= "<td style='text-align:right;'>".$value->TotalBook."</td>";
        $str.= "<td style='text-align:right;'>".number_format($value->DailyLateFee)."</td>";
        $str.= "<td>".$value->ReturnDate."</td>";
        $str.= "<td style='text-align:right;'>".$value->TotalReturnBook."</td>";
        $str.= "<td style='text-align:right;'>".number_format($value->LateCharge)."</td>";
        $str.= "<td>".$value->DamageOrLostBook."</td>";
        $str.= "<td style='text-align:right;'>".number_format($value->DamageCost)."</td>";
        $str.= "<td style='text-align:right;'>".number_format($value->TotalCost)."</td>";
        $str.= "</tr>";
                            
        
        }
    }
    else{
        $str.= "<tr>";
        $str.= "<td colspan='13'>No Record Data</td>";
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