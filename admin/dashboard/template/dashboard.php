<?php
include('../../../dbcon.php');
include('pages/email.php');


if(isset($_POST['emailnotif'])){
    $email = $_POST['email'];
    $msg = 'This is just a sample email, testing...';
    
    sendEmail($email,$msg);
}
if(isset($_POST['massEmail'])){
    $massemail = 'SELECT Email FROM applicantdb';
    $massresult = mysqli_query($conn,$massemail);
    if(mysqli_num_rows($massresult)>0){
        while($massrow = mysqli_fetch_assoc($massresult)){
            $email = $massrow['Email'];
            $msg = 'This an mass email notification';
            
            sendEmail($email,$msg);
        }
    }
}

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
    <script src="https://kit.fontawesome.com/866d550866.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
</head>

<style>
    .btn-4cm {
        width: 4cm;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .step-wizard-list {
        color: #333;
        list-style-type: none;
        border-radius: 10px;
        display: flex;
        padding: 20px 10px;
        position: relative;
        z-index: 10;
    }

    .step-wizard-item {
        padding: 0 20px;
        flex-basis: 0;
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
        display: flex;
        flex-direction: column;
        text-align: center;
        min-width: 170px;
        position: relative;
    }

    .step-wizard-item+.step-wizard-item:after {
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

    .progress-count {
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-weight: 600;
        margin: 0 auto;
        position: relative;
        z-index: 10;
        color: transparent;
    }

    .progress-count:after {
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

    .progress-count:before {
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

    .progress-label {
        font-size: 14px;
        font-weight: 600;
        margin-top: 10px;
    }

    .current-item .progress-count:before,
    .current-item~.step-wizard-item .progress-count:before {
        display: none;
    }

    .current-item~.step-wizard-item .progress-count:after {
        height: 10px;
        width: 10px;
    }

    .current-item~.step-wizard-item .progress-label {
        opacity: 0.5;
    }

    .current-item .progress-count:after {
        background: #fff;
        border: 2px solid #21d4fd;
    }

    .current-item .progress-count {
        color: #21d4fd;
    }
</style>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo-topnav.png" class="mr-3"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logajade.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" style="border-width: 0ch;" type="button"
                    data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="images/22.jpg" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="../logout.php">
                                <i class="ti-power-off text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-flex nav-profile dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                            <i class="icon-ellipsis"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="">
                                Change Password
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
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
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="fa-solid fa-user-tie fa-lg menu-icon"></i>
                            <span class="menu-title">Applicant Data</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="pages/applicant_list.php">Applicant List</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/applicant.php">Roadmap</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/applicant_docs.php">Documents</a></li>
                            </ul>
                        </div>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/byb.php">
                            <i class="fa-solid fa-users-rectangle fa-lg menu-icon"></i>
                            <span class="menu-title">BYB Attendees</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/prospects.php">
                            <span class="fa-stack fa-sm mr-1 menu-icon">
                                <i class="fa-solid fa-magnifying-glass fa-stack-2x"></i>
                                <i class="fa-solid fa-user fa-stack-1x"></i>
                            </span> <span class="menu-title">&nbsp;Prospects</span>
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
                            <li class="nav-item"> <a class="nav-link" href="pages/southern_accounts.php">Southern Jade</a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/prulife_accounts.php">PruLife UK</a></li>
                        </ul>
                        </div>
                    </li>
                </ul>
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
                                                <form method="post">
                                                    <button type="button" class="btn btn-success btn-4cm dropdown-toggle me-2"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Sort List
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><button type="submit" name="all" class="dropdown-item" href="#">All</button></li>
                                                        <li><button type="submit" name="newapp" class="dropdown-item" href="#">New Applicant</button></li>
                                                        <li><button type="submit" name="tempagent" class="dropdown-item" href="#">Temporary Agent</button></li>
                                                        <li><button type="submit" name="licagent" class="dropdown-item" href="#">Licensed Agent</button></li>
                                                    </ul>
                                                    <button class="btn btn-primary" type="submit" name="massEmail"><i class="fa-solid fa-envelope"></i> Notif All</button>
                                                </form>
                                            </div>
                                            <div class="card border border-success border-3 rounded-4 mb-4">
                                                <div class="d-flex card-header bg-transparent border-success justify-content-between align-items-center">
                                                    <div style="font-size: 25px;">Applicant List</div>
                                                    <form class="d-flex" method="post" role="search">
                                                        <input class="form-control" type="search" name="itemsearch" placeholder="Search for Lastname"
                                                            aria-label="Search" style="width:10cm;">
                                                        <button class="btn btn-outline-success ml-2" type="submit" name="search">Search</button>
                                                    </form>
                                                </div>
                                                <div class="card-body" style="height: 10%;">

                                                <?php
                                                    if(isset($_POST['search'])){
                                                        $lastname = $_POST['itemsearch'];
                                                        if(!empty($lastname)){
                                                            $sql = "SELECT * FROM applicantdb WHERE lastname = '$lastname'";
                                                        }else{
                                                            $sql = "SELECT * FROM applicantdb";
                                                        }
                                                    }elseif(isset($_POST['newapp'])){
                                                        $sql = "SELECT * FROM applicantdb WHERE applicant_status = 'New Applicant'";
                                                    }elseif(isset($_POST['tempagent'])){
                                                        $sql = "SELECT * FROM applicantdb WHERE applicant_status = 'Temporary Agent'";
                                                    }elseif(isset($_POST['licagent'])){
                                                        $sql = "SELECT * FROM applicantdb WHERE applicant_status = 'Licensed Agent'";
                                                    }else{
                                                        $sql = "SELECT * FROM applicantdb";
                                                    }
                                                    
                                                    $result = mysqli_query($conn, $sql);

                                                        if (!mysqli_num_rows($result) > 0) {
                                                            ?>
                                                            <div class="row justify-content-center border-bottom border-secondary">
                                                                <div class="col-lg-6">
                                                                    <h3 class="text-center">No Records Found!</h3>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }else{
                                                            while ($row = mysqli_fetch_array($result)) {

                                                                $fullname = $row['Lastname'] . ', ' . $row['Firstname'] . ' ' . $row['Middlename'][0] . '.';
                                                                $address = $row['streetname'] . ', ' . $row['barangay'] . ', ' . $row['city'] . ', ' . $row['province'];

                                                                $step5 = '';
                                                                $completion = $row['is_completed'] + $row['confirmed_rop'] + $row['confirmed_documents'] + $row['confirmed_elicense'];

                                                                switch($completion){
                                                                case 1:
                                                                    $step2 = 'current-item';
                                                                    break;
                                                                case 2:
                                                                    $step3 = 'current-item';
                                                                    break;
                                                                case 3:
                                                                    $step4 = 'current-item';
                                                                    break;
                                                                case 4:
                                                                    $step5 = 'Completed';
                                                                    break;
                                                                default:
                                                                    $step1 = 'current-item';
                                                                    break;
                                                                } 

                                                                if($completion == 0){
                                                                    $statusClass = 'text-danger';
                                                                    $status = 'New Applicant';
                                                                }elseif($completion >= 1 && $completion <=3){
                                                                    $statusClass = 'text-warning';
                                                                    $status = 'Temporary Agent';
                                                                }elseif($completion == 4){
                                                                    $statusClass = 'text-success';
                                                                    $status = 'Licencsed Agent';
                                                                }
                                                        ?>
                                                            <div class="row justify-content-center border-bottom border-secondary">
                                                                <div class="row justify-content-left col-lg-2 mb-3 mr-0">
                                                                    <img src="../../../applicant/applicant_page/profile_img/<?= $row['profile_pic']?>" class="text-secondary mb-0 d-block img-thumbnail mt-2" style="height: 125px; width:130px;">

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
                                                                    <p style="font-size: 15px;" class="<?= $statusClass?>"><?= $status?> <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?php echo $row['application_id'] ?>"><i class="fa-solid fa-question"></i></button></p>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->

                                                            <div class="modal fade" id="modal<?php echo $row['application_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Other Information</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="container p-3 mt-2">
                                                                                <div class="row p-3 justify-content-around">
                                                                                    <div class="col-lg-12 text-center">
                                                                                        <h4 class="bg-success rounded text-white"><?= ($completion == 4) ? 'Completed' : '' ?></h4>
                                                                                        <section class="step-wizard">
                                                                                            <ul class="step-wizard-list mb-0">
                                                                                                <li class="step-wizard-item">
                                                                                                    <span class="progress-count">1</span>
                                                                                                    <span class="progress-label">New Applicant</span>
                                                                                                </li>
                                                                                                <li class="step-wizard-item <?= ($completion == 0) ? 'current-item' : '' ?>">
                                                                                                    <span class="progress-count">2</span>
                                                                                                    <span class="progress-label">Level 2</span>
                                                                                                </li>
                                                                                                <li class="step-wizard-item <?= ($completion == 1) ? 'current-item' : '' ?>">
                                                                                                    <span class="progress-count">3</span>
                                                                                                    <span class="progress-label">Level 3</span>
                                                                                                </li>
                                                                                                <li class="step-wizard-item <?= ($completion == 2) ? 'current-item' : '' ?>">
                                                                                                    <span class="progress-count">3</span>
                                                                                                    <span class="progress-label">Level 3</span>
                                                                                                </li>
                                                                                                <li class="step-wizard-item <?= ($completion == 3) ? 'current-item' : '' ?>">
                                                                                                    <span class="progress-count">4</span>
                                                                                                    <span class="progress-label">Completed</span>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </section>
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <p style="font-size: 15px;" class="text-secondary mb-0">Name:</p>
                                                                            <p style="font-size: 15px;" class="text-dark"><?php echo $fullname ?> </p>
                                                                            <p style="font-size: 15px;" class="text-secondary mb-0">Email:</p>
                                                                            <p style="font-size: 15px;" class="text-dark"><?php echo $row['Email'] ?> </p>
                                                                            <form method="post">
                                                                                <input type="email" class="d-none" name="email" value="<?= $row['Email']?>">
                                                                                <button class="btn btn-primary btn-sm" type="submit" name="emailnotif"><i class="fa-solid fa-envelope"></i></button>
                                                                            </form>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
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
