<?php
session_start();
include('../../../../dbcon.php');
include('email.php');
$success = '';

if(isset($_POST['submit']))
{
  $bybtitle = filter_input(INPUT_POST, "bybtitle", FILTER_SANITIZE_SPECIAL_CHARS);
  $bybdate = filter_input(INPUT_POST, "bybdate", FILTER_SANITIZE_SPECIAL_CHARS); 

  $addsql = 'INSERT INTO bybEvents(byb_title,byb_date) VALUES (?,?)';
  $stmt = mysqli_prepare($conn, $addsql);
  mysqli_stmt_bind_param($stmt, 'ss' , $bybtitle,$bybdate);
  $addresult = mysqli_stmt_execute($stmt);

  if($addresult){
    $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Added Successfully!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
  }
}

if(isset($_POST['edit']))
{
  $edit_title = filter_input(INPUT_POST, "edit_title", FILTER_SANITIZE_SPECIAL_CHARS);
  $edit_date = filter_input(INPUT_POST, "edit_date", FILTER_SANITIZE_SPECIAL_CHARS); 
  $edit_id = $_POST['edit_id'];

  $editsql = 'UPDATE bybevents SET byb_title = ?, byb_date = ? WHERE byb_id = ?' ;
  $stmt = mysqli_prepare($conn, $editsql);
  mysqli_stmt_bind_param($stmt, 'ssi' , $edit_title,$edit_date,$edit_id);
  $editsql = mysqli_stmt_execute($stmt);

  if($editsql){
    $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Edit BYB Event Successfully!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
  }
}

if(isset($_POST['mass_send'])){
  $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

  $massemail = "SELECT * FROM bybpreregistration";
  $massresult = mysqli_query($conn,$massemail);
  if(mysqli_num_rows($massresult)>0){
      while($massrow = mysqli_fetch_assoc($massresult)){
          $email = $massrow['email'];

          sendEmail($email,$message);
      }
  }else{
      ?>
      <link rel="stylesheet" href="../../../registration/popup_style.css">
      <div class="popup popup--icon -error js_error-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
          <h3 class="popup__content__title">
          Message not Sent
          </h3>
          <p>There are no recipients to be sent</p>
          <p>
          <a href='byb.php'><button class="button button--error" data-for="js_error-popup">OK</button></a>
          </p>
      </div>
      </div>
      <?php
  }
}
$sql = 'SELECT * FROM bybEvents';
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
                  <p class="card-title">BYB Pre-Register Table</p>
                  <div class="row">
                    <div class="col">
                      <div class="d-flex">
                        <a href="email_attendees.php" class="btn btn-primary me-3"><i class="fa-solid fa-envelope"></i> Mass Email</a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#manual"><i class="fa-solid fa-envelope"></i> Manual Mass Email</button>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <form class="d-flex" method="post">
                        <select type="date" class="form-control" name="searchdate">
                          <option value="" disabled selected>Search Date</option>
                          <?php
                          $sqldate = "SELECT DISTINCT byb_date FROM bybpreregistration";
                          $dateresult = mysqli_query($conn, $sqldate);
                          if($dateresult){
                            while($date = mysqli_fetch_assoc($dateresult)){
                              $options = date('F d Y', strtotime($date['byb_date']));
                              ?>
                              <option value="<?=$date['byb_date']?>"><?=$options?></option>
                              <?php
                            }
                          }
                          ?>
                        </select>
                        <button class="btn btn-outline-success ml-2" name="search" type="submit">Sort</button>
                      </form>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12 border border-dark border-2 rounded-2 mb-4">
                      <div class="table-responsive">
                        <table class="table table-striped table-hover text-center" style="width:100%">
                          <thead>
                            <tr>
                              <th style="font-size: 16px">#</th>
                              <th style="font-size: 16px">Fullname</th>
                              <th style="font-size: 16px">Email</th>
                              <th style="font-size: 16px">Contact</th>
                              <th style="font-size: 16px">Recruited By</th>
                              <th style="font-size: 16px">BYB Event Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if(isset($_POST['search'])){
                              if(!empty($_POST['searchdate'])){
                                $searchdate = $_POST['searchdate'];
                                
                                $sql = "SELECT * FROM bybpreregistration WHERE byb_date = '$searchdate'";
                              }else{
                                $sql = "SELECT * FROM bybpreregistration";
                              }
                            }else{
                              $sql = "SELECT * FROM bybpreregistration";
                            }
                            $result = mysqli_query($conn, $sql);
                            if(!mysqli_num_rows($result)>0){
                                echo '<td colspan="11"><center>No Prospects record found</center></td>';
                            }else{
                                $count = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                  $dateInWords = date('F d Y', strtotime($row['byb_date']));
                                  ?>
                                  <tr>
                                      <td><?= $count?></td>
                                      <td><?= $row['fullname']?></td>
                                      <td><?= $row['email']?></td>      
                                      <td><?= $row['contact']?></td>  
                                      <td><?= $row['recruited_by']?></td>  
                                      <td><?= $dateInWords?></td>                                
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
        
        <!-- modal add byb title -->
        <form method="post">
          <div class="modal fade" id="manual" tabindex="-1" aria-labelledby="massemailLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="massemailLabel">Mass Email</h5>
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-lg-12">
                              <label for="">Recipients:</label>
                              <input type="text" class="form-control" name="" id="" value="All" disabled>
                          </div>
                          <div class="col-lg-12">
                              <label for="exampleFormControlTextarea1" class="form-label">Message: </label>
                              <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="10" required></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="mass_send" class="btn btn-primary">Send</button>
                  </div>
                  </div>
              </div>
          </div>
      </form>
        <!-- modal end -->

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



