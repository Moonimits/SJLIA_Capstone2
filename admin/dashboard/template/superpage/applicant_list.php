<?php
include('../../../../dbcon.php');
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
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Applicant List</p>
                <div class="top d-flex justify-content-between align-items-center">
                  <div class="btn-group mb-3" style="width: 4cm;">
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
                  <div class="card-body py-0" style="height: 10%;">

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

                          ?>
                              <div class="row justify-content-center border-bottom border-secondary py-2">
                                  <div class="col-lg-3 border-right">
                                    <p style="font-size: 15px;" class="mb-0"><b>Name: </b><?php echo $fullname ?></p>
                                    <p style="font-size: 15px;" class="mb-0"><b>Application ID: </b><?php echo '2345' ?></p>
                                    <p style="font-size: 15px;" class="mb-0"><b>Join Pru Account: </b><?php echo 'Done' ?></p>
                                    <p style="font-size: 15px;" class="mb-0"><b>Documents: </b><?php echo 'Complete' ?></p>
                                  </div>
                                  <div class="col-lg-3 border-right">
                                    <p style="font-size: 15px;" class="mb-0"><b>Unit Team: </b></p>
                                    <p style="font-size: 15px;" class="mb-0"><b>Recruiter: </b><?php echo $row['recruiter_name'] ?></p>
                                  </div>
                                  <div class="col-lg-6">
                                    <p style="font-size: 15px;" class="mb-0"><b>Date of Exam: </b></p>
                                    <p style="font-size: 15px;" class="mb-0"><b>Type of Exam: </b></p>
                                    <p style="font-size: 15px;" class="mb-0"><b>Date of Payment: </b></p>
                                    <p style="font-size: 15px;" class="mb-0"><b>Official Receipt: </b></p>
                                    <p style="font-size: 15px;" class="mb-0"><b>Exam Result: </b></p>
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
