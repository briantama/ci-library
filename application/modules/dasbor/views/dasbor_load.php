   <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">


            <?php

                $doc = "";
                $query = $this->db->query("SELECT  COUNT(BookID) AS GetID
                                           FROM    M_Book
                                           WHERE   IsActive = 'Y'
                                          ");
                 if ($query->num_rows() > 0) {
                   $arr = $query->first_row();
                   $doc = $arr->GetID;
                   //echo $doc;
                 }

            ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Book Data</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $doc; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <?php

                $doc = "";
                $query = $this->db->query("SELECT  COUNT(BorrowerID) AS GetID
                                           FROM    M_Borrowers
                                           WHERE   IsActive = 'Y'
                                          ");
                 if ($query->num_rows() > 0) {
                   $arr = $query->first_row();
                   $doc = $arr->GetID;
                   //echo $doc;
                 }

            ?>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Borrowers Data</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $doc; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <?php

                $doc = "";
                $query = $this->db->query("SELECT  COUNT(BorrowingID) AS GetID
                                           FROM    T_Borrowing
                                           WHERE   IsActive = 'Y'
                                          ");
                 if ($query->num_rows() > 0) {
                   $arr = $query->first_row();
                   $doc = $arr->GetID;
                   //echo $doc;
                 }

            ?>

            <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Borrowing Data</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $doc; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book-reader fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <?php

                $doc = "";
                $query = $this->db->query("SELECT  COUNT(ReturnBookID) AS GetID
                                           FROM    T_ReturnBook
                                           WHERE   IsActive = 'Y'
                                          ");
                 if ($query->num_rows() > 0) {
                   $arr = $query->first_row();
                   $doc = $arr->GetID;
                   //echo $doc;
                 }

            ?>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Return Book Data</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $doc; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-exchange-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

     

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-8 col-lg-7">
            <!-- Bar Chart -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-bar "></i> Chart Borrower Data <?php echo date('Y'); ?></h6>
                </div>
                <div class="card-body">
                  <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                  </div>
                  <!-- <hr>
                  Styling for the bar chart can be found in the <code>/js/demo/chart-bar-demo.js</code> file. -->
                </div>
              </div>

            </div>



            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-pie"></i> Chart Damage Or Lost Book <?php echo date('Y'); ?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div> -->
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Light
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Heavy
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Lost
                    </span>
                  </div>
                </div>
              </div>
            </div>

           
          </div><!--ROW-->



        </div>
        <!-- /.container-fluid -->



        <?php
          // bar chart
          $maxchart = 100;
          $doc = "";
          $query = $this->db->query("

                                    SELECT A.MonthID, A.MonthName, ifnull(B.BorrowerID,0) AS BorrowerID
                                    FROM   M_Months A
                                    LEFT JOIN (
                                                
                                              SELECT MONTH(EntryDate) as JoinDate, Count(BorrowerID) AS BorrowerID
                                              FROM   M_Borrowers
                                              WHERE  IsActive ='Y'
                                                     AND Year(EntryDate) ='".date('Y')."'
                                              group  by MONTH(EntryDate)
                                              order  by MONTH(EntryDate)

                                              ) B ON B.JoinDate=A.MonthID
                                    WHERE  A.IsActive='Y'
                                    ORDER  BY A.MonthID

                                          ");
            if ($query->num_rows() > 0) {
                $arr = $query->result();
                foreach($arr as $value){
                  $month[] = $value->MonthName;
                  $total[] = $value->BorrowerID;
                }
                $minchart = max($total);
                $maxchart = $minchart;
            }
            //echo $maxchart;

            // echo json_encode($month);
            // echo "<br>";
            // echo join($total,',');



            //pie chart
            $piec  = "";
            $query = $this->db->query("
                                    SELECT Z.DamageID, Z.DamageName, IFNULL(Y.TotalBook,0) AS TotalBook
                                    FROM   M_ConfigDamage Z
                                    LEFT   JOIN (

                                      SELECT A.DamageOrLostBook, A.TotalReturnBook as TotalBook
                                      FROM   T_ReturnBook A
                                      INNER  JOIN T_Borrowing B ON A.BorrowingID=B.BorrowingID
                                      WHERE  A.IsActive ='Y'
                                             AND B.IsActive ='Y'
                                             AND A.DamageOrLostBook ='Light'
                                             AND Year(A.EntryDate) ='".date('Y')."'

                                      UNION ALL

                                      SELECT A.DamageOrLostBook, A.TotalReturnBook as TotalBook
                                      FROM   T_ReturnBook A
                                      INNER  JOIN T_Borrowing B ON A.BorrowingID=B.BorrowingID
                                      WHERE  A.IsActive ='Y'
                                             AND B.IsActive ='Y'
                                             AND A.DamageOrLostBook ='Heavy'
                                             AND Year(A.EntryDate) ='".date('Y')."'

                                      UNION ALL

                                      SELECT A.DamageOrLostBook, B.TotalBook as TotalBook
                                      FROM   T_ReturnBook A
                                      INNER  JOIN T_Borrowing B ON A.BorrowingID=B.BorrowingID
                                      WHERE  A.IsActive ='Y'
                                             AND B.IsActive ='Y'
                                             AND A.DamageOrLostBook ='Lost'
                                             AND Year(A.EntryDate) ='".date('Y')."'

                                          ) Y ON Z.DamageID = Y.DamageOrLostBook
                                    WHERE  Z.IsActive ='Y'
                                    ORDER  BY Z.ConfigDamage ASC

                                          ");
            if ($query->num_rows() > 0) {
                $arr = $query->result();
                foreach($arr as $value){
                  $desc[]  = $value->DamageName;
                  $totdm[] = $value->TotalBook;
                }
            }
            else{
               $desc  = array("Light", "Haevy", "Lost");
               $totdm = array(0, 0, 0);
            }


            //echo json_encode($desc);
            //echo json_encode($totdm);

        ?>


<script type="text/javascript">

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($month); ?>,
    datasets: [{
      label: "Borrowers",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: [<?php echo join($total,','); ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 12
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: <?php echo $maxchart; ?>,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            //return 'Rp' + number_format(value);
            return number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          //return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    },
  }
});




// Pie Chart Example
var pie = document.getElementById("myPieChart");
var myPieChart = new Chart(pie, {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode($desc); ?>,
    datasets: [{
      data: [<?php echo join($totdm, ','); ?>],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});


</script>