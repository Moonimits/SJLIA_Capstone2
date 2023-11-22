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
                    <form method="post">
                        <button type="button" class="btn btn-success btn-4cm dropdown-toggle me-2"
                            data-toggle="dropdown" aria-expanded="false">
                            Sort List
                        </button>
                        <ul class="dropdown-menu">
                            <li><button type="submit" name="all" class="dropdown-item" href="#">All</button></li>
                            <li><button type="submit" name="newapp" class="dropdown-item" href="#">New Applicant</button></li>
                            <li><button type="submit" name="tempagent" class="dropdown-item" href="#">Temporary Agent</button></li>
                            <li><button type="submit" name="rop" class="dropdown-item" href="#">Temporary Agent (ROP)</button></li>
                            <li><button type="submit" name="ice" class="dropdown-item" href="#">Temporary Agent (ICE)</button></li>
                            <li><button type="submit" name="clr" class="dropdown-item" href="#">Temporary Agent (CLR)</button></li>
                            <li><button type="submit" name="licagent" class="dropdown-item" href="#">Licensed Agent</button></li>
                        </ul>
                    </form>
                  </div>
                    
                </div>
                <div class="card border border-success border-3 rounded-4 mb-4">
                  <div class="d-flex card-header bg-transparent border-success justify-content-between align-items-center">
                      <div style="font-size: 25px;">Applicant List</div>
                      <form class="d-flex" method="post" role="search">
                          <input class="form-control" type="search" name="itemsearch" placeholder="Search"
                              aria-label="Search" style="width:10cm;">
                          <button class="btn btn-outline-success ml-2" type="submit" name="search">Search</button>
                      </form>
                  </div>
                  <div class="card-body py-0" style="height: 10%;">

                  <?php
                      if(isset($_POST['search'])){
                        $searchitem = $_POST['itemsearch'];
                        if(!empty($searchitem)){
                            $sql = "SELECT * FROM applicantdb WHERE lastname LIKE '$searchitem' OR firstname LIKE '%$searchitem%' ORDER BY lastname ASC, firstname ASC";
                        }else{
                            $sql = "SELECT * FROM applicantdb ORDER BY lastname ASC, firstname ASC";
                        }
                      }elseif(isset($_POST['newapp'])){
                          $sql = "SELECT * FROM applicantdb WHERE applicant_status = 'New Applicant' ORDER BY lastname ASC, firstname ASC";
                      }elseif(isset($_POST['tempagent'])){
                          $sql = "SELECT * FROM applicantdb WHERE applicant_status = 'ROP' OR applicant_status = 'ICE' OR applicant_status = 'CLR' ORDER BY lastname ASC, firstname ASC";
                      }elseif(isset($_POST['rop'])){
                          $sql = "SELECT * FROM applicantdb WHERE applicant_status = 'ROP' ORDER BY lastname ASC, firstname ASC";
                      }elseif(isset($_POST['ice'])){
                          $sql = "SELECT * FROM applicantdb WHERE applicant_status = 'ICE' ORDER BY lastname ASC, firstname ASC";
                      }elseif(isset($_POST['clr'])){
                          $sql = "SELECT * FROM applicantdb WHERE applicant_status = 'CLR' ORDER BY lastname ASC, firstname ASC";
                      }elseif(isset($_POST['licagent'])){
                          $sql = "SELECT * FROM applicantdb WHERE applicant_status = 'Licensed Agent' ORDER BY lastname ASC, firstname ASC";
                      }else{
                          $sql = "SELECT * FROM applicantdb ORDER BY lastname ASC, firstname ASC";
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

                                  if($row['on_off1']==0){
                                    $on_or_off1 = '<span class="badge badge-pill badge-danger">N/A</span>';
                                  }elseif($row['on_off1']==1){
                                    $on_or_off1 = '<span class="badge badge-pill badge-info">Offsite</span>';
                                  }else{
                                    $on_or_off1 = '<span class="badge badge-pill badge-success">Online</span>';
                                  } 

                                  if($row['on_off2']==0){
                                    $on_or_off2 = '<span class="badge badge-pill badge-danger">N/A</span>';
                                  }elseif($row['on_off2']==1){
                                    $on_or_off2 = '<span class="badge badge-pill badge-info">Offsite</span>';
                                  }else{
                                    $on_or_off2 = '<span class="badge badge-pill badge-success">Online</span>';
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
                              <div class="row justify-content-evenly border-bottom border-secondary py-2">
                                  <div class="col-lg-auto">
                                    <p style="font-size: 13px;" class="mb-0"><b>Applicant Name: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Application ID: </b></p>
                                  </div>
                                  <div class="col-lg-2">
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $fullname ?></p>
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $row['plukapplication_id']>0 ? $row['plukapplication_id'] : 'N/A' ?></p>
                                  </div>
                                  <div class="col-lg-auto">
                                    <p style="font-size: 13px;" class="mb-0"><b>Join Pru Account: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Documents: </b></p>
                                  </div>
                                  <div class="col-lg-2">
                                    <p style="font-size: 14px;" class="mb-0 <?=$joinclass?>"><?php echo $joinpru ?></p>
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $document?></p>
                                  </div>
                                  <div class="col-lg-auto">
                                    <p style="font-size: 13px;" class="mb-0"><b>Unit Team: </b></p>
                                    <p style="font-size: 13px;" class="mb-0"><b>Recruiter: </b></p>
                                  </div>
                                  <div class="col-lg-2 ">
                                    <p style="font-size: 14px;" class="mb-0"><?php echo !empty($row['unit_team']) ? $row['unit_team'] : 'N/A' ?></p>
                                    <p style="font-size: 14px;" class="mb-0"><?php echo $row['recruiter_name'] ?></p>
                                  </div>
                                  <div class="col-lg-2 text-right">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#exam<?=$row['application_id']?>">Exam</button>
                                  </div>
                              </div>
                              <!-- Modal -->

                              <form method="post">
                                <div class="modal fade" id="modal<?php echo $row['application_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Other Information</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                  <div class="col-lg-12">
                                                    <input type="text" name="edit_id" class="d-none" value="<?=$row['application_id']?>">
                                                    <div class="form-group">
                                                      <label for="uniteam">Unit Team:</label>
                                                      <select name="uniteam" class="form-control text-dark" id="uniteam">
                                                        <option class="text-success" value="<?=$row['unit_team']?>" selected><?php if(empty($row['unit_team'])){echo "Select an Option"; }else{ echo $row['unit_team'];} ?></option>
                                                        <?php
                                                        $teamsql = "SELECT * FROM unit_team";
                                                        $teamresult = mysqli_query($conn ,$teamsql);

                                                        while($teamrow = mysqli_fetch_assoc($teamresult)){
                                                          ?>
                                                          <option value="<?=$teamrow['uniteam']?>"><?=$teamrow['uniteam']?></option>
                                                          <?php
                                                        }
                                                        ?>
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-primary" data-toggle="modal" data-target="#uniteams">Unit Team</button>
                                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </form>
                              <form method="post">
                                <div class="modal fade" id="exam<?php echo $row['application_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Exam History</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                  <div class="col-12">
                                                    <div class="table-responsive text-center">
                                                      <table class="table table-bordered table hover" style="width: 100%">
                                                        <thead>
                                                            <tr class="bg-success">
                                                              <th>#</th>
                                                              <th>Exam Name</th>
                                                              <th>Exam Place</th>
                                                              <th>Exam Date</th>
                                                              <th>Payment Date</th>
                                                              <th>Official Receipt</th>
                                                              <th>Exam Type</th>
                                                              <th>Result</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                          <?php
                                                          $esql = "SELECT * FROM exam_history WHERE application_id = '".$row['application_id']."'";
                                                          $eresult = mysqli_query($conn, $esql);
                                                          if(!mysqli_num_rows($eresult)>0){
                                                            echo '<td colspan="11"><center>No Exam Records</center></td>';
                                                          }else{
                                                            $count = 1;
                                                            while($erow = mysqli_fetch_assoc($eresult)){
                                                              if($erow['exam_result']==0){
                                                                $examresult = 'N/A';
                                                              }elseif($erow['exam_result']==1){
                                                                $examresult = '
                                                                <p class="text-success m-0" style="font-size: 10px; font-weight:bold;">Traditional (PASSED)</p>
                                                                <p class="text-success m-0" style="font-size: 10px; font-weight:bold;">Variable (PASSED)</p>
                                                                ';
                                                              }elseif($erow['exam_result']==2){
                                                                $examresult = '
                                                                <p class="text-danger m-0" style="font-size: 10px; font-weight:bold;">Traditional (FAILED)</p>
                                                                <p class="text-danger m-0" style="font-size: 10px; font-weight:bold;">Variable (FAILED)</p>
                                                                ';
                                                              }elseif($erow['exam_result']==3){
                                                                $examresult = '
                                                                <p class="text-success m-0" style="font-size: 10px; font-weight:bold;">Traditional (PASSED)</p>
                                                                <p class="text-danger m-0" style="font-size: 10px; font-weight:bold;">Variable (FAILED)</p>
                                                                ';
                                                              }elseif($erow['exam_result']==4){
                                                                $examresult = '
                                                                <p class="text-danger m-0" style="font-size: 10px; font-weight:bold;">Traditional (FAILED)</p>
                                                                <p class="text-success m-0" style="font-size: 10px; font-weight:bold;">Variable (PASSED)</p>
                                                                ';
                                                              }elseif($erow['exam_result']==5){
                                                                $examresult = ' <p class="text-danger m-0" style="font-size: 10px; font-weight:bold;">FAILED</p>';
                                                              }elseif($erow['exam_result']==6){
                                                                $examresult = ' <p class="text-success m-0" style="font-size: 10px; font-weight:bold;">PASSED</p>';
                                                              }
                                                              ?>
                                                              <tr>
                                                                <td><?=$count?></td>
                                                                <td><?=$erow['exam_name']?></td>
                                                                <td><?php echo !empty($erow['exam_place']) ? $erow['exam_place'] : 'N/A'?></td>
                                                                <td><?=$erow['exam_date']?></td>
                                                                <td><?=$erow['payment_date']?></td>
                                                                <td><?=$erow['official_receipt']?></td>
                                                                <td><?=$erow['exam_type']?></td>
                                                                <td><?=$examresult?></td>
                                                              </tr>
                                                              <?php
                                                              $count++;
                                                            }
                                                          }
                                                          ?>
                                                        </tbody>
                                                      </table>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        <form method="post">
          <div class="modal fade" id="uniteams" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Unit Teams</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-10">
                        <input type="text" name="newunit" class="form-control" id="date_payment" placeholder="Enter New Unit Team">
                    </div>
                    <div class="col-lg-2">
                      <button type="submit" class="btn btn-success" name="addunit">Add</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <table class="table text-center mt-3">
                        <thead class="thead-dark">
                          <tr>
                            <th>Unit Team</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $teamsql = "SELECT * FROM unit_team";
                            $teamresult = mysqli_query($conn ,$teamsql);
                            
                            while($teamrow = mysqli_fetch_array($teamresult)){
                              ?>
                              <tr>
                                <td><?=$teamrow['uniteam']?></td>
                                <td><a href="delete_uniteam.php?delid=<?=$teamrow['team_id']?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a></td>
                              </tr>
                              <?php
                            }
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </form>
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
