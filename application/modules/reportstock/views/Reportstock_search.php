<?php

 if(!empty($keys)){

    $str = "<div class='report list-report'>";
    $str.= "<div class='header-report'>";
    $str.= "<div class='wrap-cap'>";
    $str.= "<a href='".base_url()."reportstock/viewReportstock/print/".urlencode(serialize($keys))."' target='/_blank' class='btn btn-info' style='margin-left:10px;'><i class=\"fas fa-fw fa-print\"></i> print</a>";
    $str.= "<a href='".base_url()."reportstock/viewReportstock/export/".urlencode(serialize($keys))."' target='_blank' class='btn btn-success' style='margin-left:10px;'><i class=\"fas fa-fw fa-file-excel\"></i> Export</a>";
    $str.= "<div class='cap' style='text-align: center; font-weight: bold;'> Report Stock Book<br/ >Effective Date : ". date('d M Y');
    $str.= "</div>";
    $str.= "</div>";
    $str.= "</div>";

    $str.= "<div id='grid' class='gridvie'>";
    $str.= "<div class='gridview'>";
    $str.= "<div class='cap-table'>&nbsp;</div>";

    $str.= "<table border='1' class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
    $str.= "<thead>";
    $str.= "<tr>";
    $str.= "<th>BookID</th>";
    $str.= "<th>Title Book</th>";
    $str.= "<th>Stock Book</th>";
    $str.= "<th>Borrowed Books</th>";
    $str.= "<th>LostBook</th>";
    $str.= "<th>Stock Book Available</th>";
    $str.= "</tr>";
    $str.= "</thead>";
    $str.= "<tbody>";

    if(!empty($keys)){
        foreach($keys as $value){ 
                            
        $str.= "<tr>";
        $str.= "<td>".$value->BookID."</td>";
        $str.= "<td>".$value->TitleBuku."</td>";
        $str.= "<td style='text-align:center;'>".number_format($value->StockAvailable + $value->Borrowing + $value->lostBook)."</td>";
        $str.= "<td style='text-align:center;'>".number_format($value->Borrowing)."</td>";
        $str.= "<td style='text-align:center;'>".number_format($value->lostBook)."</td>";
        $str.= "<td style='text-align:center;'>".number_format($value->StockAvailable)."</td>";
        $str.= "</tr>";
                            
        
        }
    }
    else{
        $str.= "<tr>";
        $str.= "<td colspan='6'>No Record Data</td>";
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