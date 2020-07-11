<?php

 if(!empty($keys)){

    $str = "<div class='report list-report'>";
    $str.= "<div class='header-report'>";
    $str.= "<div class='wrap-cap'>";
    $str.= "<a href='".base_url()."reportborrowing/viewReportborrowing/print/".urlencode(serialize($keys))."?StartDate=".$StartDate."&EndDate=".$EndDate."' target='/_blank' class='btn btn-info' style='margin-left:10px;'><i class=\"fas fa-fw fa-print\"></i> print</a>";
    $str.= "<a href='".base_url()."reportborrowing/viewReportborrowing/export/".urlencode(serialize($keys))."?StartDate=".$StartDate."&EndDate=".$EndDate."' target='_blank' class='btn btn-success' style='margin-left:10px;'><i class=\"fas fa-fw fa-file-excel\"></i> Export</a>";
    if(trim($StartDate) == "" || trim($EndDate) == "")
    {
        $str.= "<div class='cap' style='text-align: center; font-weight: bold;'> Report Borrowing<br/ >Effective Date : ". date('d M Y');
    }
    else
    {
        $str.= "<div class='cap' style='text-align: center; font-weight: bold;'> Report Borrowing<br/ >Effective Date : ".date_format(date_create($StartDate),"d F Y")." - ".date_format(date_create($EndDate),"d F Y"); 
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
    $str.= "<th>BorrowingID</th>";
    $str.= "<th>BorrowerID</th>";
    $str.= "<th>CustomerName</th>";
    $str.= "<th>BookID</th>";
    $str.= "<th>StartDate</th>";
    $str.= "<th>EndDate</th>";
    $str.= "<th>TotalBook</th>";
    $str.= "<th>ReturnDate</th>";
    $str.= "<th>TotalReturnBook</th>";
    $str.= "<th>TotalCost</th>";
    $str.= "<th>DamageOrLostBook</th>";
    $str.= "</tr>";
    $str.= "</thead>";
    $str.= "<tbody>";



    if(!empty($keys)){
        foreach($keys as $value){ 
                            
        $str.= "<tr>";
        $str.= "<td>".$value->BorrowingID."</td>";
        $str.= "<td>".$value->BorrowerID."</td>";
        $str.= "<td>".$value->CustomerName."</td>";
        $str.= "<td>".$value->BookID."</td>";
        $str.= "<td>".$value->StartDate."</td>";
        $str.= "<td>".$value->EndDate."</td>";
        $str.= "<td style='text-align:right;'>".$value->TotalBook."</td>";
        $str.= "<td>".$value->ReturnDate."</td>";
        $str.= "<td style='text-align:right;'>".$value->TotalReturnBook."</td>";
        $str.= "<td style='text-align:right;'>".number_format($value->TotalCost)."</td>";
        $str.= "<td>".$value->DamageOrLostBook."</td>";
        $str.= "</tr>";
                            
        
        }
    }
    else{
        $str.= "<tr>";
        $str.= "<td colspan='10'>No Record Data</td>";
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