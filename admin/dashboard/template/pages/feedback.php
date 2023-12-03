<?php
session_start();
include('../../../../dbcon.php');
include('email.php');
$success = '';

if(isset($_GET['delmsg'])){
    $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    '.$_GET['delmsg'].'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
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

  <style>
    .max-width-cell {
  max-width: 200px; 
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
      <?php include('nav.php') ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
      
        
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Applicant Feedback</p>
                  <div class="row">
                    <div class="col">
                    <?=$success?>
                    </div>
                    <div class="col-lg-7">
                      <form class="d-flex" method="post">
                        <select type="date" class="form-control text-dark mr-1 mt-2" name="month">
                          <option value="" disabled selected>Choose Month</option>
                          <option value="01">January</option>
                          <option value="02">February</option>
                          <option value="03">March</option>
                          <option value="04">April</option>
                          <option value="05">May</option>
                          <option value="06">June</option>
                          <option value="07">July</option>
                          <option value="08">August</option>
                          <option value="09">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>
                        <select type="date" class="form-control text-dark mr-1 mt-2" name="day">
                          <option value="" disabled selected>Choose Days</option>
                          <option value="01">1</option>
                          <option value="02">2</option>
                          <option value="03">3</option>
                          <option value="04">4</option>
                          <option value="05">5</option>
                          <option value="06">6</option>
                          <option value="07">7</option>
                          <option value="08">8</option>
                          <option value="09">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                        <input type="number" class="form-control mr-1 mt-2" name="year" min="2020" placeholder="Input year">
                        <button class="btn btn-outline-success" name="searchdate" type="submit">Date</button>
                        <button class="btn btn-outline-success ml-2" name="searchmonth" type="submit">Month</button>
                        <button class="btn btn-outline-success ml-2" name="searchyear" type="submit">Year</button>  
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
                              <th style="font-size: 16px">Message</th>
                              <th style="font-size: 16px">Date Sent</th>
                              <th style="font-size: 16px">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if(isset($_POST['searchdate'])){
                              if(!empty($_POST['day'])&&!empty($_POST['month'])&&!empty($_POST['year'])){
                                $searchdate = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
                                $_SESSION['date'] = $searchdate;
                                $sql = "SELECT * FROM feedback WHERE date = '$searchdate' ORDER BY feedback_id DESC";
                              }else{
                                $sql = "SELECT * FROM feedback WHERE date = (SELECT MAX(date) FROM feedback) ORDER BY feedback_id DESC";
                                unset($_SESSION['date']);
                              }
                            }elseif(isset($_POST['searchmonth'])){
                              if(!empty($_POST['month'])){
                                $month = $_POST['month'];

                                if(!empty($_POST['year'])){
                                  $year = $_POST['year'];
                                }else{
                                  $year = date("Y");
                                }

                                $sql = "SELECT * FROM feedback WHERE MONTH(date) = '$month' AND YEAR(date) = '$year' ORDER BY feedback_id DESC";
                              }else{
                                $sql = "SELECT * FROM feedback WHERE date = (SELECT MAX(date) FROM feedback) ORDER BY feedback_id DESC";
                                unset($_SESSION['date']);
                              }
                            }elseif(isset($_POST['searchyear'])){
                              if(!empty($_POST['year'])){
                                $year = $_POST['year'];
                                $sql = "SELECT * FROM feedback WHERE YEAR(date) = '$year' ORDER BY feedback_id DESC";
                              }else{
                                $sql = "SELECT * FROM feedback WHERE date = (SELECT MAX(date) FROM feedback) ORDER BY feedback_id DESC";
                                unset($_SESSION['date']);
                              }
                            }else{
                              $sql = "SELECT * FROM feedback WHERE date = (SELECT MAX(date) FROM feedback) ORDER BY feedback_id DESC";
                            }
                            $result = mysqli_query($conn, $sql);
                            if(!mysqli_num_rows($result)>0){
                                echo '<td colspan="11"><center>No feedback record found</center></td>';
                            }else{
                                $count = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                  $dateInWords = date('F d Y', strtotime($row['date']));
                                  ?>
                                  <tr>
                                      <td><?= $count?></td>
                                      <td><?= $row['name']?></td>
                                      <td class="max-width-cell"><?= $row['message']?></td>       
                                      <td><?= $dateInWords?></td>    
                                      <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#msg<?=$row['feedback_id']?>"><i class="fa-solid fa-eye"></i></button>
                                        <a href="deletefeedback.php?delid=<?=$row['feedback_id']?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                                      </td>                            
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
        
        <?php
        $msgsql = "SELECT * FROM feedback WHERE date = (SELECT MAX(date) FROM feedback)";
        $msgresult = mysqli_query($conn, $msgsql);
        while($msgrow = mysqli_fetch_assoc($msgresult)){
            ?>
            <div class="modal" tabindex="-1" role="dialog" id="msg<?=$msgrow['feedback_id']?>">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Feedback Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Message:</label>
                        <textarea class="form-control" rows="10" readonly><?=$msgrow['message']?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
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



