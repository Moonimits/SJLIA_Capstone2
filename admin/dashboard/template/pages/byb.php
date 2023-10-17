<?php
include('../../../../dbcon.php');
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
                  <p class="card-title">BYB Table</p>
                  <?php 
                  echo $success;
                  if (isset($_GET['delmsg'])) {
                    $delmsg = $_GET['delmsg'];
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            '.$delmsg.'
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
                  }
                  ?>
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
                  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addBYBmeet">
                    Add
                  </button>
                </div>
                    <div class="row justify-content-around">
                      <?php
                      if(!mysqli_num_rows($result)>0){
                        echo '<div class="col-lg-12 text-center bg-light shadow rounded p-3">
                                <h1>There are no records found</h1>
                              </div>';
                      }else{
                        while($row = mysqli_fetch_assoc($result)){
                          ?>
                          <div class="col-lg-3 mt-2 bg-white" >
                            <a style="height: auto; width: 100%" href="add_attendees.php?byb_id=<?= $row['byb_id'] ?>&title=<?= $row['byb_title'] ?>" class="btn btn-outline-success btn-lg shadow">
                              <strong><?= $row['byb_title'] ?></strong> 
                            </a>
                            <div class="d-flex text-center justify-content-center mt-2">
                              <a href="delete_event.php?delid=<?= $row['byb_id']?>" class="btn btn-danger btn-sm me-1"><i class="fa-solid fa-trash"></i></a>
                              <button type="button" class="btn btn-success btn-sm me-1" data-toggle="modal" data-target="#edit_byb<?= $row['byb_id']?>"><i class="fa-solid fa-pen-to-square"></i></button>
                              <h6><strong>Date:</strong> <?= $row['byb_date']?></h6>
                            </div>

                            <form method="post">
                            <div class="modal fade" id="edit_byb<?= $row['byb_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit BYB Title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <input type="text" name="edit_id" value="<?= $row['byb_id']?>" style="display: none;">
                                    <div class="form-group">
                                      <label >BYB Title:</label>
                                      <input class="form-control" type="text" name="edit_title" placeholder="Input Attendee Name" value="<?= $row['byb_title']?>" required>
                                    </div>
                                    <div class="form-group">
                                      <label >Date of Event:</label>
                                      <input class="form-control" type="date" name="edit_date" placeholder="Input Attendee Email" value="<?= $row['byb_date']?>" required>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="edit" class="btn btn-primary">Edit</button>
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

        <!-- modal add byb title -->
        <form method="post">
          <div class="modal fade" id="addBYBmeet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">New BYB Event List</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label >BYB Title:</label>
                    <input class="form-control" type="text" name="bybtitle" placeholder="Input BYB Title" required>
                  </div>
                  <div class="form-group">
                    <label >Date of the Event:</label>
                    <input class="form-control" type="date" name="bybdate" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <!-- modal end -->

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

