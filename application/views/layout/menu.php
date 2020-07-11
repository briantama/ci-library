<?php

  $stptl = "";
  $query = $this->db->query(" SELECT SetupTitle
                              FROM   M_Setupprofile
                            ");
    if ($query->num_rows() > 0) {
      $arr   = $query->row();
      $stptl = $arr->SetupTitle;
    }


?>

 <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>dasbor">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-atlas"></i>
        </div>
        <div class="sidebar-brand-text mx-3 animated fadeInLeft"><?php echo $stptl; ?> <!-- <sup>BL</sup> --></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item" id="li-dashboard">
        <a class="nav-link" href="<?php echo base_url(); ?>dasbor">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
  
      <!-- Nav Item - Service Collapse Menu -->
      <li class="nav-item" id="li-master">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseService" aria-expanded="true" aria-controls="collapseService">
          <i class="fas fa-fw fa-server"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseService" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Utilities:</h6>-->
            
            <a class="collapse-item" style="cursor: pointer;" id="a-bookshelf" onclick="callpage('bookshelf/viewBookshelf', 'a-bookshelf', 'li-master')">Data Bookshelf</a>
            <a class="collapse-item" style="cursor: pointer;" id="a-category" onclick="callpage('category/viewCategory', 'a-category', 'li-master')">Data Category</a>
            <a class="collapse-item" style="cursor: pointer;" id="a-book" onclick="callpage('book/viewBook', 'a-book', 'li-master')">Data Book</a>
            <a class="collapse-item" style="cursor: pointer;" id="a-borrowers" onclick="callpage('borrowers/viewBorrowers', 'a-borrowers', 'li-master')">Data Borrowers</a>
          </div>
        </div>
      </li>
      
      <!-- Nav Item - Branch Collapse Menu -->
      <li class="nav-item" id="li-transaction">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBranch" aria-expanded="true" aria-controls="collapseBranch">
          <i class="fas fa-fw fa-tasks"></i>
          <span>Transaction</span>
        </a>
        <div id="collapseBranch" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Utilities:</h6>-->
            <a class="collapse-item" style="cursor: pointer;" id="a-borrowing" onclick="callpage('borrowing/viewBorrowing', 'a-borrowing', 'li-transaction')">Borrowing Books</a>
            <a class="collapse-item" style="cursor: pointer;" id="a-returnbook" onclick="callpage('returnbook/viewReturnbook', 'a-returnbook', 'li-transaction')">Return Book</a>
            
          </div>
        </div>
      </li>
      
      
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item" id="li-report">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-list"></i>
          <span>Report</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Utilities:</h6>-->
            <a class="collapse-item" style="cursor: pointer;" id="a-reportstock" onclick="callpage('reportstock/viewReportstock', 'a-reportstock', 'li-report')">Stock Book</a>
            <a class="collapse-item" style="cursor: pointer;" id="a-reportborrower" onclick="callpage('reportborrower/viewReportborrower', 'a-reportborrower', 'li-report')">History Borrower</a>
            <a class="collapse-item" style="cursor: pointer;" id="a-reportborrowing" onclick="callpage('reportborrowing/viewReportborrowing', 'a-reportborrowing', 'li-report')">Borrowing</a>
            <a class="collapse-item" style="cursor: pointer;" id="a-reportreturn" onclick="callpage('reportreturn/viewReportreturn', 'a-reportreturn', 'li-report')">Late Charge Book</a>
            
          </div>
        </div>
      </li>


      <li class="nav-item" id="li-setup">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSetup" aria-expanded="true" aria-controls="collapseSetup">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Setting</span>
        </a>
        <div id="collapseSetup" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!--<h6 class="collapse-header">Custom Utilities:</h6>-->
            <a class="collapse-item" style="cursor: pointer;" id="a-setupprofile" onclick="callpage('setupprofile/viewSetupProfile', 'a-setupprofile', 'li-setup')">Setup Profile</a>
            <a class="collapse-item" style="cursor: pointer;" id="a-setuplogo" onclick="callpage('setuplogo/viewSetupLogo', 'a-setuplogo', 'li-setup')">Setup Logo</a>
            
          </div>
        </div>
      </li>

      

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search Menu..." id="menuid" name="menuid" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search Menu..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <?php

            $img = "";
            $query = $this->db->query("SELECT  AdminImage 
                                       FROM    M_Admin
                                       WHERE   UserName ='".$this->session->userdata('nama')."'
                                      ");
             if ($query->num_rows() > 0) {
               $arr = $query->first_row();
               $img = (trim($arr->AdminImage) != "") ? $arr->AdminImage : "default.jpeg";
               //echo $doc;
             }

            $image = "upload/user/".$img;

            if(file_exists($image)){
              $image = base_url()."upload/user/".$img;
            }
            else{
              $image = base_url()."upload/user/default.jpeg";
            }


            ?>


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle animated fadeInRight" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('nama') ?></span>
                <img class="img-profile rounded-circle" src="<?php echo $image; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item animated bounceInDown" onclick="callpage('profile/viewProfile', '', 'li-dashboard')" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item animated bounceInRight" onclick="callpage('user/viewUser', 'a-user', 'li-utility')" href="#">
                  <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                  User
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item animated bounceInUp" href="<?php echo base_url('login/logout'); ?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                <!-- <div class="dropdown-divider"></div> -->
                <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a> -->
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->



<script type="text/javascript">
  $(document).ready ( function(){
   //alert('ok');
   //callpage("dasbor/dasbor_page","","li-dashboard");

   var buah = [
            { value: 'Dashbord', data: 'dasbor' ,clsp: '', nvitem: 'li-dashboard'},
            { value: 'Data Bookshelf ', data: 'bookshelf/viewBookshelf' ,clsp: 'a-bookshelf', nvitem: 'li-master'},
            { value: 'Data Category', data: 'category/viewCategory' ,clsp: 'a-category', nvitem: 'li-master'},
            { value: 'Data Book', data: 'book/viewBook' ,clsp: 'a-book', nvitem: 'li-master'},
            { value: 'Data Borrowers', data: 'borrowers/viewBorrowers' ,clsp: 'a-borrowers', nvitem: 'li-master'},
            { value: 'Borrowing Book', data: 'borrowing/viewBorrowing' ,clsp: 'a-borrowing', nvitem: 'li-transaction'},
            { value: 'Return Book', data: 'returnbook/viewReturnbook' ,clsp: 'a-returnbook', nvitem: 'li-transaction'},
            { value: 'Stock Book', data: 'reportstock/viewReportstock' ,clsp: 'a-reportstock', nvitem: 'li-report'},
            { value: 'History Borrower', data: 'reportborrower/viewReportborrower' ,clsp: 'a-reportborrower', nvitem: 'li-report'},
            { value: 'Borrowing', data: 'reportborrowing/viewReportborrowing' ,clsp: 'a-reportborrowing', nvitem: 'li-report'},
            { value: 'Return Charge Book', data: 'reportreturn/viewReportreturn' ,clsp: 'a-reportreturn', nvitem: 'li-report'},
            { value: 'Profile', data: 'profile/viewProfile' ,clsp: '', nvitem: 'li-dashboard'},
            { value: 'Data User', data: 'user/viewUser' ,clsp: '', nvitem: 'li-dashboard'},
        ];

    // Selector input yang akan menampilkan autocomplete.
    $( "#menuid" ).autocomplete({
      lookup: buah,
        onSelect: function (suggestion) {
      $('#menuid').val(suggestion.value);
      callpage(suggestion.data, suggestion.clsp, suggestion.nvitem);
      
    }
    });

  });
</script>
