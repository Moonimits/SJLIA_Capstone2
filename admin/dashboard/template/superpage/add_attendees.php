<?php
session_start();
include('../../../../dbcon.php');
$byb_id = $_GET['byb_id'];
if(isset($_GET['title'])){
  $_SESSION['title'] = $_GET['title'];
}

$sql = "SELECT * FROM bybattendees WHERE byb_id = '$byb_id'" ;
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
  <link rel="shortcut icon" href="../../../Pictures/loghousetitle.jpg" />
  <script src="https://kit.fontawesome.com/866d550866.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
</head>



<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include('nav.html')?>
    <!-- partial -->
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
      
        
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title"><?= $_SESSION['title']?> Attendees</p>
                  <div class="top d-flex justify-content-between align-items-center">
                    <p></p>
                    <form class="d-flex justify-content-right mb-4" role="search">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" style="width:10cm;">
                        <button class="btn btn-outline-success ml-2" type="submit">Search</button>
                    </form>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12  border border-dark border-2 rounded-2 mb-4">
                      <div class="table-responsive">
                        <table class="table table-striped table-hover text-center" style="width:100%">
                          <thead>
                            <tr>
                              <th style="width: 100px;">Number</th>
                              <th>Name</th>
                              <th>Email</th>
                            </tr>
                          </thead>
                          <tbody class="table-group-divider">
                            <?php
                            if(!mysqli_num_rows($result)>0){
                                echo '<td colspan="11"><center>No Attendees record yet</center></td>';
                            }else{
                                $count = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $row['fullname']?></td>
                                        <td><?= $row['email']?></td>
                                    </tr>
                                    <?php
                                    $count += 1;
                                }
                            }
                            ?>
                          </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <!-- content-wrapper ends -->
      
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
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

