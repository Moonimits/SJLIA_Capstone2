<?php
session_start();
include('../../../../dbcon.php');
include('email.php');
if(isset($_GET['title'])){
  $_SESSION['title'] = $_GET['title'];
}
if(isset($_GET['byb_id'])){
  $_SESSION['byb_id'] = $_GET['byb_id'];
}
if(isset($_GET['emailed'])){
  $_SESSION['emailed'] = $_GET['emailed'];
}
$byb_id = $_SESSION['byb_id'];
$emailed = $_SESSION['emailed'];

$success = '';


if(isset($_POST['submit']))
{
  $fullname = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS); 

  $addsql = 'INSERT INTO bybattendees(fullname,email,byb_id) VALUES (?,?,?)';
  $stmt = mysqli_prepare($conn, $addsql);
  mysqli_stmt_bind_param($stmt, 'ssi' , $fullname,$email,$byb_id);
  $addresult = mysqli_stmt_execute($stmt);

  if($addresult){
    $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Added Attendees Successfully!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
  }
}

if(isset($_POST['edit']))
{
  $edit_name = filter_input(INPUT_POST, "edit_name", FILTER_SANITIZE_SPECIAL_CHARS);
  $edit_email = filter_input(INPUT_POST, "edit_email", FILTER_SANITIZE_SPECIAL_CHARS); 
  $edit_id = $_POST['edit_id'];

  $editsql = 'UPDATE bybattendees SET fullname = ?, email = ? WHERE attendee_num = ?' ;
  $stmt = mysqli_prepare($conn, $editsql);
  mysqli_stmt_bind_param($stmt, 'ssi' , $edit_name,$edit_email,$edit_id);
  $editsql = mysqli_stmt_execute($stmt);

  if($editsql){
    $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Edit Attendees Successfully!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
  }
}

if(isset($_POST['search'])){
  $searchitem = $_POST['searchitem'];
  if(!empty($searchitem)){
      $sql = "SELECT * FROM bybattendees WHERE byb_id = '$byb_id' AND fullname LIKE '%$searchitem%'";
  }else{
      $sql = "SELECT * FROM bybattendees WHERE byb_id = '$byb_id'";
  }
}else{
  $sql = "SELECT * FROM bybattendees WHERE byb_id = '$byb_id'" ;
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
                    <form class="d-flex justify-content-right" method="post" role="search">
                        <input class="form-control" type="search" placeholder="Search" name="searchitem" aria-label="Search" style="width:10cm;">
                        <button class="btn btn-outline-success ml-2 mr-3" type="submit" name="search">Search</button>
                    </form>
                    <div>
                      <?php
                      if($emailed == 0){
                        ?>
                        <a href="email_attendees.php?byb_id=<?=$byb_id?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-envelope"></i> email</a>
                        <?php
                      }else{
                        ?>
                        <a  class="btn btn-primary btn-sm disabled"><i class="fa-solid fa-envelope"></i> Email</a>
                        <?php
                      }
                      ?>
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add_attendee_modal">Add</button>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12 border border-dark border-2 rounded-2 mb-4">
                      <div class="table-responsive">
                        <table class="table table-striped table-hover text-center" style="width:100%">
                          <thead>
                            <tr>
                              <th style="font-size: 16px">#</th>
                              <th style="font-size: 16px">Name</th>
                              <th style="font-size: 16px">Email</th>
                              <th style="font-size: 16px">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if(!mysqli_num_rows($result)>0){
                                echo '<td colspan="11"><center>No Attendees found</center></td>';
                            }else{
                                $count = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $row['fullname']?></td>
                                        <td><?= $row['email']?></td>
                                        <td>
                                          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_attendee_<?= $row['attendee_num']?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                          <a href="delete_attendees.php?delid=<?= $row['attendee_num']?>&bybid=<?= $byb_id?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <form method="post">
                                      <div class="modal fade" id="edit_attendee_<?= $row['attendee_num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Attendee</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <input type="text" name="edit_id" value="<?= $row['attendee_num']?>" style="display: none;">
                                              <div class="form-group">
                                                <label >Attendee Name:</label>
                                                <input class="form-control" type="text" name="edit_name" placeholder="Input Attendee Name" value="<?= $row['fullname']?>" required>
                                              </div>
                                              <div class="form-group">
                                                <label >Attendee Email:</label>
                                                <input class="form-control" type="email" name="edit_email" placeholder="Input Attendee Email" value="<?= $row['email']?>" required>
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
          <div class="modal fade" id="add_attendee_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">New BYB Attendees</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label >Attendee Name:</label>
                    <input class="form-control" type="text" name="name" placeholder="Input Attendee Name" required>
                  </div>
                  <div class="form-group">
                    <label >Attendee Email:</label>
                    <input class="form-control" type="email" name="email" placeholder="Input Attendee Email" required>
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

