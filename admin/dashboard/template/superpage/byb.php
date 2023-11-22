<?php
include('../../../../dbcon.php');

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
                                $sql = "SELECT * FROM bybpreregistration ORDER BY byb_date DESC";
                              }
                            }else{
                              $sql = "SELECT * FROM bybpreregistration ORDER BY byb_date DESC";
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

