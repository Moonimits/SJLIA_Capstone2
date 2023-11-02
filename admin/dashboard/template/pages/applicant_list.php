<?php
include('../../../../dbcon.php');
$success = '';
if(isset($_POST['submit'])){
  $edit_id = filter_input(INPUT_POST, "edit_id", FILTER_SANITIZE_SPECIAL_CHARS);
  $uniteam = filter_input(INPUT_POST, "uniteam", FILTER_SANITIZE_SPECIAL_CHARS);
  $date_exam = filter_input(INPUT_POST, "date_exam", FILTER_SANITIZE_SPECIAL_CHARS);
  $type_exam = filter_input(INPUT_POST, "type_exam", FILTER_SANITIZE_SPECIAL_CHARS);
  $on_off = filter_input(INPUT_POST, "on_off", FILTER_SANITIZE_SPECIAL_CHARS);
  $date_payment = filter_input(INPUT_POST, "date_payment", FILTER_SANITIZE_SPECIAL_CHARS);
  $official_recp = filter_input(INPUT_POST, "official_recp", FILTER_SANITIZE_SPECIAL_CHARS);
  $exam_result = filter_input(INPUT_POST, "exam_result", FILTER_SANITIZE_SPECIAL_CHARS);

  $sql = "UPDATE applicantdb SET unit_team = ?, date_exam = ?, type_exam = ?, on_off = ?, date_payment = ?, official_reciept = ?, exam_result = ? WHERE application_id = ? ";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'sssisssi',$uniteam,$date_exam,$type_exam,$on_off,$date_payment,$official_recp,$exam_result,$edit_id);
  $result = mysqli_stmt_execute($stmt);

  if($result){
    $success = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Applicant Information Updated!
      <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>';
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
                    <form method="post">
                        <button type="button" class="btn btn-success btn-4cm dropdown-toggle me-2"
                            data-toggle="dropdown" aria-expanded="false">
                            Sort List
                        </button>
                        <ul class="dropdown-menu">
                            <li><button type="submit" name="all" class="dropdown-item" href="#">All</button></li>
                            <li><button type="submit" name="newapp" class="dropdown-item" href="#">New Applicant</button></li>
                            <li><button type="submit" name="tempagent" class="dropdown-item" href="#">Temporary Agent</button></li>
                            <li><button type="submit" name="licagent" class="dropdown-item" href="#">Licensed Agent</button></li>
                        </ul>
                    </form>
                  </div>
                    <?php
                    echo $success;
                    ?>
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
                        $searchitem = $_POST['itemsearch'];
                        if(!empty($searchitem)){
                            $sql = "SELECT * FROM applicantdb WHERE lastname LIKE '$searchitem' OR firstname LIKE '$searchitem'";
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

                                  if($row['on_off']==0){
                                    $on_or_off = '<span class="badge badge-pill badge-info ml-2">Offsite</span>';
                                  }else{
                                    $on_or_off = '<span class="badge badge-pill badge-success ml-2">Online</span>';
                                  } 
                                  
                                  if($row['has_pruaccount']==0){
                                    $joinpru = 'Undone';
                                    $joinclass = 'text-danger font-weight-bold';
                                  }else{
                                    $joinpru = 'Done';
                                    $joinclass = 'text-success font-weight-bold';
                                  } 

                                  $app_id = $row['application_id'];
                                  $docsql = "SELECT * FROM documents WHERE application_id = '$app_id'";
                                  $docresult = mysqli_query($conn, $docsql);
                                  $docrow = mysqli_fetch_array($docresult);
                                  if($docrow){
                                    if($docrow['confirm_sss'] == 1 && $docrow['confirm_tin'] == 1 && $docrow['confirm_gov'] == 1 && $docrow['confirm_1x1'] == 1){
                                      $document = '<p style="font-size: 14px;" class="mb-0 text-success">Complete</p>';
                                    }else{
                                      $document = '<p style="font-size: 14px;" class="mb-0 text-danger">Incomplete</p>';
                                    }
                                  }

                          ?>
                              <div class="row justify-content-center border-bottom border-secondary py-2">
                                  <div class="col-lg-2 p-0">
                                    <p style="font-size: 13px;" class="mb-0"><b>Name: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Application ID: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Join Pru Account: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Documents: </b></p>
                                  </div>
                                  <div class="col-lg-2 p-0">
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $fullname ?></p>
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $row['plukapplication_id'] ?></p>
                                    <p style="font-size: 14px;" class="mb-0 <?=$joinclass?>"><?php echo $joinpru ?></p>
                                    <?php echo $document?>
                                  </div>
                                  <div class="col-lg-1">
                                    <p style="font-size: 13px;" class="mb-0"><b>Unit Team: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Recruiter: </b></p>
                                  </div>
                                  <div class="col-lg-2 ">
                                    <p style="font-size: 14px;" class="mb-0"><?php echo !empty($row['unit_team']) ? $row['unit_team'] : 'N/A' ?></p>
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $row['recruiter_name'] ?></p>
                                  </div>
                                  <div class="col-lg-2">
                                    <p style="font-size: 13px;" class="mb-0"><b>Date of Exam: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Type of Exam: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Date of Payment: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Official Receipt: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Exam Result: </b></p>
                                  </div>
                                  <div class="col-lg-3">
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $row['date_exam'] ?></p>
                                    <p style="font-size: 14px;" class="mb-0">
                                    
                                    <?php
                                    if(!empty($row['type_exam'])){
                                      echo $row['type_exam'];
                                      echo $on_or_off;
                                    }
                                    ?>
                                    
                                    </p>
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $row['date_payment'] ?></p>
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $row['official_reciept'] ?></p>
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $row['exam_result'] ?></p>
                                  </div>
                                  <div class="row justify-content-end">
                                    <div class="col-lg-1">
                                      <button class="btn btn-success" data-toggle="modal" data-target="#modal<?=$row['application_id']?>">Edit</button>
                                    </div>
                                  </div>
                              </div>
                              <!-- Modal -->

                              <form method="post">
                                <div class="modal fade" id="modal<?php echo $row['application_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Other Information</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                  <div class="col-lg-6">
                                                    <input type="text" name="edit_id" class="d-none" value="<?=$row['application_id']?>">
                                                    <div class="form-group">
                                                      <label for="uniteam">Unit Team:</label>
                                                      <select name="uniteam" class="form-control" id="uniteam">
                                                        <option value="<?=$row['unit_team']?>" selected>Select an Option</option>
                                                        <option value="Direct Team">Direct Team</option>
                                                        <option value="Ubuntu Jade">Ubuntu Jade</option>
                                                        <option value="Harmon Jade">Harmon Jade</option>
                                                        <option value="Sentry Jade">Sentry Jade</option>
                                                      </select>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="date_exam">Date of Exam:</label>
                                                      <input type="date" name="date_exam" class="form-control" id="date_exam" placeholder="Enter date of exam" value="<?=$row['date_exam']?>">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="type_exam">Type of Exam:</label>
                                                      <div class="d-flex">
                                                        <input type="text" name="type_exam" class="form-control" id="type_exam" placeholder="Enter type of exam" value="<?=$row['type_exam']?>">
                                                        <select name="on_off" class="form-control" id="on_off">
                                                          <option value="<?=$row['on_off']?>" selected>Online / Offsite</option>
                                                          <option value="1">Online</option>
                                                          <option value="0">Offsite</option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-6">
                                                    <div class="form-group">
                                                      <label for="date_payment">Date of Payment:</label>
                                                      <input type="date" name="date_payment" class="form-control" id="date_payment" placeholder="Enter date of payment" value="<?=$row['date_payment']?>">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="official_recp">Official Receipt:</label>
                                                      <input type="text" name="official_recp" class="form-control" id="official_recp" placeholder="Enter Official Receipt" value="<?=$row['official_reciept']?>">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exam_result">Exam Result:</label>
                                                      <select name="exam_result" class="form-control" id="exam_result" value="<?=$row['exam_result']?>">
                                                        <option value="<?=$row['exam_result']?>" selected>Select an Option</option>
                                                        <option value="PASSED">PASSED</option>
                                                        <option value="FAILED">FAILED</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </form>
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
