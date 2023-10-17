<?php
include('../../../../dbcon.php');

$sql = 'SELECT * FROM applicantdb';
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
      <?php include('nav.html') ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
      
        
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Applicant Documents</p>
                  
                <div class="top d-flex justify-content-between align-items-center">
                  <div class="btn-group mb-3" style="width: 4cm;">
                  <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <div class="row">
                      <?php
                      if(!mysqli_num_rows($result)>0){
                        echo '<div class="col-lg-12 text-center bg-light shadow rounded p-3">
                                <h1>There are no records found</h1>
                              </div>';
                      }else{
                        while($row = mysqli_fetch_assoc($result)){
                          $fullname = $row['Lastname'] . ', ' . $row['Firstname'] . ' ' . $row['Middlename'][0] . '.';
                          ?>
                          <div class="col-lg-4 mt-2 bg-white" >
                            <button type="button" style="height: auto; width: 100%" class="btn btn-outline-success btn-lg shadow" data-toggle="modal" data-target="#documents<?=$row['application_id']?>">
                              <strong><?=$fullname?></strong> 
                            </button>

                            <form method="post">
                            <div class="modal fade" id="documents<?=$row['application_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?=$fullname?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row text-center justify-content-center">
                                      <?php
                                      $app_id = $row['application_id'];
                                      $docsql = "SELECT * FROM documents WHERE application_id = '$app_id'";
                                      $docresult = mysqli_query($conn,$docsql);

                                      if(!mysqli_num_rows($docresult)>0){
                                        ?>
                                        <div class="col-lg-12 text-center">
                                          <h1>No Documents Submitted!</h1>
                                        </div>
                                        <?php
                                      }else{
                                        while($docrow = mysqli_fetch_assoc($docresult)){
                                          $userFolder = $row['Lastname'] . ', ' . $row['Firstname'] . '/';
                                          if(!empty($docrow['sss'])||!empty($docrow['tin'])||!empty($docrow['gov_id'])||!empty($docrow['1x1'])){
                                            if(!empty($docrow['sss'])){
                                              ?>
                                              <div class="col-lg-3">
                                                <img style="height: 230px; width: 100%;" src="../../../../applicant/applicant_page/documents/<?=$userFolder?><?=$docrow['sss']?>" alt="" class="img-fluid">
                                                <label for="sss_proof" class="form-label">Proof of SSS:</label>
                                                <div>
                                                  <a href="reject.php?id=1&&app_id=<?=$row['application_id']?>" class="btn btn-danger btn-sm me-1"><i class="fa-solid fa-square-xmark"></i></a>
                                                  <?php
                                                  if($docrow['confirm_sss']==1){
                                                    ?>
                                                    <a class="btn btn-primary btn-sm disabled"><i class="fa-solid fa-square-check"></i></a>
                                                    <?php
                                                  }else{
                                                    ?>
                                                    <a href="confirm.php?id=1&&app_id=<?=$row['application_id']?>" class="btn btn-success btn-sm"><i class="fa-solid fa-square-check"></i></a>
                                                    <?php
                                                  }
                                                  ?>
                                                </div>
                                              </div>
                                              <?php
                                            }
                                            if(!empty($docrow['tin'])){
                                              ?>
                                              <div class="col-lg-3">
                                                <img style="height: 230px; width: 100%;" src="../../../../applicant/applicant_page/documents/<?=$userFolder?><?=$docrow['tin']?>" alt="" class="img-fluid">
                                                <label for="tin_proof" class="form-label">Proof of TIN:</label>
                                                <div>
                                                  <a href="reject.php?id=2&&app_id=<?=$row['application_id']?>" class="btn btn-danger btn-sm me-1"><i class="fa-solid fa-square-xmark"></i></a>
                                                  <?php
                                                  if($docrow['confirm_tin']){
                                                    ?>
                                                    <a class="btn btn-primary btn-sm disabled"><i class="fa-solid fa-square-check"></i></a>
                                                    <?php
                                                  }else{
                                                    ?>
                                                    <a href="confirm.php?id=2&&app_id=<?=$row['application_id']?>" class="btn btn-success btn-sm"><i class="fa-solid fa-square-check"></i></a>
                                                    <?php
                                                  }
                                                  ?>
                                                </div>
                                              </div>
                                              <?php
                                            }
                                            if(!empty($docrow['gov_id'])){
                                              ?>
                                              <div class="col-lg-3">
                                                <img style="height: 230px; width: 100%;" src="../../../../applicant/applicant_page/documents/<?=$userFolder?><?=$docrow['gov_id']?>" alt="" class="img-fluid">
                                                <label for="gov_proof" class="form-label">Government ID:</label>
                                                <div>
                                                  <a href="reject.php?id=3&&app_id=<?=$row['application_id']?>" class="btn btn-danger btn-sm me-1"><i class="fa-solid fa-square-xmark"></i></a>
                                                  <?php
                                                  if($docrow['confirm_gov']){
                                                    ?>
                                                    <a class="btn btn-primary btn-sm disabled"><i class="fa-solid fa-square-check"></i></a>
                                                    <?php
                                                  }else{
                                                    ?>
                                                    <a href="confirm.php?id=3&&app_id=<?=$row['application_id']?>" class="btn btn-success btn-sm"><i class="fa-solid fa-square-check"></i></a>
                                                    <?php
                                                  }
                                                  ?>
                                                </div>
                                              </div>
                                              <?php
                                            }
                                            if(!empty($docrow['1x1'])){
                                              ?>
                                              <div class="col-lg-3">
                                                <img style="height: 230px; width: 100%;" src="../../../../applicant/applicant_page/documents/<?=$userFolder?><?=$docrow['1x1']?>" alt="" class="img-fluid">
                                                <label for="sss_proof" class="form-label">1x1 Picture (Red Background):</label>
                                                <div>
                                                  <a href="reject.php?id=4&&app_id=<?=$row['application_id']?>" class="btn btn-danger btn-sm me-1"><i class="fa-solid fa-square-xmark"></i></a>
                                                  <?php
                                                  if($docrow['confirm_1x1']){
                                                    ?>
                                                    <a class="btn btn-primary btn-sm disabled"><i class="fa-solid fa-square-check"></i></a>
                                                    <?php
                                                  }else{
                                                    ?>
                                                    <a href="confirm.php?id=4&&app_id=<?=$row['application_id']?>" class="btn btn-success btn-sm"><i class="fa-solid fa-square-check"></i></a>
                                                    <?php
                                                  }
                                                  ?>
                                                </div>
                                              </div>
                                              <?php
                                            }
                                          }else{
                                            ?>
                                            <div class="col-lg-12 text-center">
                                              <h1>No Documents Submitted!</h1>
                                            </div>
                                            <?php
                                          }
                                        }
                                      }
                                      ?>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </form>
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

