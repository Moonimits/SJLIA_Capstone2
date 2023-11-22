<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo mr-5" ><img src="../images/logo-topnav.png" class="mr-3" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" ><img src="../images/logajade.png" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <i class="icon-ellipsis"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="../logout.php">
              <i class="ti-power-off text-primary"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper sidebar-fixed">
    <?php
    $alert = 0;
    $alertsql = "SELECT * FROM documents";
    $alertresult = mysqli_query($conn, $alertsql);
    while($alertrow = mysqli_fetch_array($alertresult)){
        if((!empty($alertrow['sss']) && $alertrow['confirm_sss'] == 0)||(!empty($alertrow['tin']) && $alertrow['confirm_tin'] == 0)||(!empty($alertrow['gov']) && $alertrow['confirm_gov'] == 0)||(!empty($alertrow['1x1']) && $alertrow['confirm_1x1'] == 0)){
            $alert = 1;
        }
    }
    ?>
    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="../dashboard.php">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">&nbsp;Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="fa-solid fa-user-tie fa-lg menu-icon"></i>
            <span class="menu-title mr-1">Applicant Data</span><?php echo $alert == 1? '<span class="badge badge-danger">!</span>' : ''?>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="applicant_list.php">Applicant List</a></li>
              <li class="nav-item"> <a class="nav-link" href="applicant.php">Status Progress Bar</a></li>
              <li class="nav-item"> <a class="nav-link" href="applicant_docs.php">Documents <?php echo $alert == 1? '<span class="badge badge-danger">!</span>' : ''?></a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="byb.php">
        <i class="fa-solid fa-users-rectangle fa-lg menu-icon"></i>
          <span class="menu-title">BYB Pre-Registered</span>
          </a>
        </li>
         <li class="nav-item">
        <a class="nav-link" href="prospects.php">
        <span class="fa-stack fa-sm mr-1 menu-icon">
          <i class="fa-solid fa-magnifying-glass fa-stack-2x"></i>
          <i class="fa-solid fa-user fa-stack-1x"></i>
        </span>  <span class="menu-title">&nbsp;Prospects</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#accounts" aria-expanded="false" aria-controls="accounts">
          <i class="fa-solid fa-key menu-icon"></i>
          <span class="menu-title">Accounts</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="accounts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="southern_accounts.php">Southern Jade</a></li>
            <li class="nav-item"> <a class="nav-link" href="prulife_accounts.php">PruLife UK</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="exam.php">
            <i class="fa-solid fa-file-lines menu-icon"></i>
            <span class="menu-title">Exam Schedules</span>
        </a>
    </li>
        </ul>
    </nav>