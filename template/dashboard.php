<?php
include('../../../dbcon.php');
$sql = "SELECT * FROM applicantdb";
$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Southern Jade Life Insurance</title>
  <link rel="icon" href="images/logajade.png" type="image/x-icon">
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../Pictures/loghousetitle.jpg" />
  <script src="https://kit.fontawesome.com/866d550866.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>


.btn-success {
  width: 4cm;
}

* {
            margin: 0;
            padding: 0;
          
            box-sizing: border-box;
}
         .step-wizard-list{
            color: #333;
            list-style-type: none;
            border-radius: 10px;
            display: flex;
            padding: 20px 10px;
            position: relative;
            z-index: 10;
         }

         .step-wizard-item{
            padding: 0 20px;
            flex-basis: 0;
            -webkit-box-flex: 1;
            -ms-flex-positive:1;
            flex-grow: 1;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
            min-width: 170px;
            position: relative;
         }
         .step-wizard-item + .step-wizard-item:after{
            content: "";
            position: absolute;
            left: 0;
            top: 19px;
            background: #21d4fd;
            width: 100%;
            height: 2px;
            transform: translateX(-50%);
            z-index: -10;
         }
         .progress-count{
            height: 40px;
            width:40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
            margin: 0 auto;
            position: relative;
            z-index:10;
            color: transparent;
         }
         .progress-count:after{
            content: "";
            height: 40px;
            width: 40px;
            background: #21d4fd;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: -10;
         }
         .progress-count:before{
            content: "";
            height: 10px;
            width: 20px;
            border-left: 3px solid #fff;
            border-bottom: 3px solid #fff;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -60%) rotate(-45deg);
            transform-origin: center center;
         }
         .progress-label{
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
         }
         .current-item .progress-count:before,
         .current-item ~ .step-wizard-item .progress-count:before{
            display: none;
         }
         .current-item ~ .step-wizard-item .progress-count:after{
            height:10px;
            width:10px;
         }
         .current-item ~ .step-wizard-item .progress-label{
            opacity: 0.5;
         }
         .current-item .progress-count:after{
            background: #fff;
            border: 2px solid #21d4fd;
         }
         .current-item .progress-count{
            color: #21d4fd;
         }
</style>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo-topnav.png" class="mr-3" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logajade.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>

        

        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/22.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="../logout.php">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
 
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">&nbsp;Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/agents.php">
            <i class="fa-solid fa-user-tie menu-icon"></i>
            <span class="menu-title">&nbsp;&nbsp;Agent List</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/agents.php">
            <i class="fa-solid fa-user-tie menu-icon"></i>
            <span class="menu-title">&nbsp;&nbsp;BYB Attendees</span>
            </a>
          </li>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
      
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Advanced Table</p>
                  <div class="row">
                    <div class="container-sm">
                        <div class="card border border-success border-3 rounded-4 mb-4">
                            <div class="row justify-content-center">
                                <div class="col-lg-2 p-3 text-center">
                                    <h5>Total Clients</h5>
                                    <h1>10</h1>
                                </div>
                                <div class="col-lg-2 p-3 text-center">
                                    <h5>Total Renewals</h5>
                                    <h1>10</h1>
                                </div>
                                <div class="col-lg-4 p-3 text-center">
                                    <h5>Commssions Earned</h5>
                                    <h1>₱60,000</h1>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group mb-2">
  <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Sort List
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Separated link</a></li>
  </ul>
</div>

                        <div class="card border border-success border-3 rounded-4 mb-4">
                        <div class="d-flex card-header bg-transparent border-success justify-content-between align-items-center">
    <div style="font-size: 25px;">Applicant List</div>
    <form class="d-flex" role="search">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" style="width:10cm;">
        <button class="btn btn-outline-success ml-2" type="submit">Search</button>
    </form>
</div>
                            <div class="card-body" style="height: 10%;">

                                <?php
                                if(mysqli_num_rows($result)>0){
                                    while($row=mysqli_fetch_array($result)){
                                        $fullname = $row['Lastname'] . ', ' . $row['Firstname'] . ' ' . $row['Middlename'][0] . '.';
                                        $address = $row['streetname'] . ', ' . $row['barangay'] . ', ' . $row['city'] . ', ' . $row['province'];
                                        ?>
                                      
                                    
                                        
                                    
                                        
                                      <div class="row justify-content-center border-bottom border-secondary">
                                    
                                      <div class="row justify-content-left col-lg-2 mb-4 mr-5">
                                          <img src="images/22.jpg" class="text-secondary mb-0">
                                        
                                          </div>
                                            <div class="col-lg-2 mt-5 mr-2">
                                                <p style="font-size: 15px;" class="text-secondary mb-0">Name:</p>
                                                <p style="font-size: 15px;" class="text-dark"><?php echo $fullname ?></p>
                                            </div>
                                            <div class="col-lg-3 mt-5">
                                                <p style="font-size: 15px;" class="text-secondary mb-0">Address:</p>
                                                <p style="font-size: 15px;" class="text-dark"><?php echo $address ?></p>
                                            </div>
                                            <div class="col-lg-2 mt-5">
                                                <p style="font-size: 15px;" class="text-secondary mb-0">Contact No:</p>
                                                <p style="font-size: 15px;" class="text-dark"><?php echo $row['contact_number'] ?></p>
                                            </div>
                                            <div class="col-lg-2 mt-5">
                                                <p style="font-size: 15px;" class="text-secondary mb-0">Status:</p>
                                                <p style="font-size: 15px;" class="text-warning">New Applicant <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['application_id'] ?>"><i class="fa-solid fa-question"></i></button></p>
                                            </div>
                                        </div> 
                                     <!-- Modal -->                                           
                                        

                                            <div class="modal fade" id="modal<?php echo $row['application_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="container p-3 mt-2">
                                                <div class="row p-3">
                                                    <div class="col-lg-5 text-center">
                                                      <section class="step-wizard">
                                                              <ul class="step-wizard-list">
                                                                  <li class="step-wizard-item ">
                                                                      <span class="progress-count">1</span>
                                                                      <span class="progress-label">Billing Info</span>
                                                                  </li>
                                                                  <li class="step-wizard-item ">
                                                                      <span class="progress-count">2</span>
                                                                      <span class="progress-label">Payment Method</span>
                                                                  </li>
                                                                  <li class="step-wizard-item ">
                                                                      <span class="progress-count">3</span>
                                                                      <span class="progress-label">Checkout</span>
                                                                  </li>
                                                                  <li class="step-wizard-item>">
                                                                      <span class="progress-count">4</span>
                                                                      <span class="progress-label">Success</span>
                                                                  </li>
                                                              </ul>
                                                        </section>
                                                        <H1></H1>
                                                    </div>
                                                </div>
                                              </div>
                                                    <p style="font-size: 15px;" class="text-secondary mb-0">Name:</p>
                                                    <p style="font-size: 15px;" class="text-dark"><?php echo $fullname ?> </p>
                                                    <p style="font-size: 15px;" class="text-secondary mb-0">Email:</p>
                                                    <p style="font-size: 15px;" class="text-dark"><?php echo $row['Email'] ?> </p>
                                            
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

