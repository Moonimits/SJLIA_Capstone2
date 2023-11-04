<?php
include('../../../../dbcon.php');
if(isset($_POST['search'])){
    $searchitem = $_POST['itemsearch'];
    if(!empty($searchitem)){
        $sql = "SELECT * FROM applicantdb WHERE lastname LIKE '$searchitem' OR firstname LIKE '%$searchitem%'";
    }else{
        $sql = "SELECT * FROM applicantdb";
    }
}else{
    $sql = "SELECT * FROM applicantdb";
}
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Southern Jade Life Insurance</title>
    <link rel="icon" href="../images/logajade.png" type="image/x-icon">
    <!-- plugins:css -->
    <link rel="stylesheet" href="../vendors/feather/feather.css">
    <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="../js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <script src="https://kit.fontawesome.com/866d550866.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
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
        <?php include('nav.html'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Applicant </p>
                                    <div class="row">
                                        <div class="container-sm">
                                            
                                            <div class="card border border-success border-3 rounded-4 mb-4">
                                                <div class="d-flex card-header bg-transparent border-success justify-content-between align-items-center">
                                                    <div style="font-size: 25px;">Applicant Status</div>
                                                    <form class="d-flex" method="post" role="search">
                                                        <input class="form-control" name="itemsearch" type="search" placeholder="Search"
                                                            aria-label="Search" style="width:10cm;">
                                                        <button class="btn btn-outline-success ml-2" name="search" type="submit">Search</button>
                                                    </form>
                                                </div>
                                                <div class="card-body py-0" style="height: 10%;">

                                                    <?php
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $fullname = $row['Lastname'] . ', ' . $row['Firstname'] . ' ' . $row['Middlename'][0] . '.';
                                                                $address = $row['streetname'] . ', ' . $row['barangay'] . ', ' . $row['city'] . ', ' . $row['province'];

                                                                $step5 = '';
                                                                $completion = $row['is_completed'] + $row['confirmed_rop'] + $row['confirmed_documents'] + $row['confirmed_elicense'];

                                                                if($completion == 0){
                                                                    $statusClass = 'badge badge-pill badge-danger';
                                                                    $status = 'New Applicant';
                                                                }elseif($completion >= 1 && $completion <= 3){
                                                                    $statusClass = 'badge badge-pill badge-warning';
                                                                    if($row['confirmed_elicense'] == 1){
                                                                        $status = 'Temporary Agent (CLR)';                                            
                                                                    }elseif($row['confirmed_documents'] == 1){
                                                                        $status = 'Temporary Agent (ICE)';                                            
                                                                    }elseif($row['confirmed_rop'] == 1){
                                                                        $status = 'Temporary Agent (ROP)';                                            
                                                                    }
                                                                }elseif($completion == 4){
                                                                    $statusClass = 'badge badge-pill badge-success';
                                                                    $status = 'Licensed Agent';
                                                                }
                                                        ?>
                                                            <div class="row justify-content-center border-bottom border-secondary">
                                                                <div class="row justify-content-left col-lg-2 mr-0 pt-2">
                                                                    <p style="font-size: 15px;" class="text-secondary mb-0">Name:</p>
                                                                    <p style="font-size: 15px;" class="text-dark"><strong><?php echo $fullname ?></strong></p>
                                                                    <p style="font-size: 15px;" class="text-secondary mb-0">Status:</p>
                                                                    <div>
                                                                        <p style="font-size: 12px;" class="<?= $statusClass?>"><?= $status?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-10 pt-2">
                                                                    <section class="step-wizard border border-dark rounded my-2">
                                                                        <ul class="step-wizard-list mb-0">
                                                                            <li class="step-wizard-item">
                                                                                <span class="progress-count">1</span>
                                                                                <span class="progress-label" style="font-size: 10px;">(0%)</span>
                                                                                <span class="progress-label">New Applicant</span>
                                                                            </li>
                                                                            <li class="step-wizard-item <?= ($completion == 0) ? 'current-item' : '' ?>">
                                                                                <span class="progress-count">2</span>
                                                                                <span class="progress-label" style="font-size: 10px;">(25%)</span>
                                                                                <span class="progress-label">ROP</span>
                                                                            </li>
                                                                            <li class="step-wizard-item <?= ($completion == 1) ? 'current-item' : '' ?>">
                                                                                <span class="progress-count">3</span>
                                                                                <span class="progress-label" style="font-size: 10px;">(50%)</span>
                                                                                <span class="progress-label">ICE</span>
                                                                            </li>
                                                                            <li class="step-wizard-item <?= ($completion == 2) ? 'current-item' : '' ?>">
                                                                                <span class="progress-count">3</span>
                                                                                <span class="progress-label" style="font-size: 10px;">(75%)</span>
                                                                                <span class="progress-label">CLR</span>
                                                                            </li>
                                                                            <li class="step-wizard-item <?= ($completion == 3) ? 'current-item' : '' ?>">
                                                                                <span class="progress-count">4</span>
                                                                                <span class="progress-label" style="font-size: 10px;">(100%)</span>
                                                                                <span class="progress-label">Completed</span>
                                                                            </li>
                                                                        </ul>
                                                                    </section>
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
        <script src="../vendors/js/vendor.bundle.base.js"></script>
        <script src="../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="../vendors/chart.js/Chart.min.js"></script>
        <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="../js/dataTables.select.min.js"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="../js/off-canvas.js"></script>
        <script src="../js/hoverable-collapse.js"></script>
        <script src="../js/template.js"></script>
        <script src="../js/settings.js"></script>
        <script src="../js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="../js/dashboard.js"></script>
        <script src="../js/Chart.roundedBarCharts.js"></script>
        <!-- End custom js for this page-->
    </body>

    </html>
