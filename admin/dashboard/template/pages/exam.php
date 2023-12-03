<?php
include('../../../../dbcon.php');

$currentdate = date('Y-m-d');
$success = '';
$uploaderror = '';
$uploadsuccess = '';

if(isset($_GET['delmsg'])){
    $success = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    '.$_GET['delmsg'].'
    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>';
}

if(isset($_POST['add'])){
    $expdate = filter_input(INPUT_POST, "exp", FILTER_SANITIZE_SPECIAL_CHARS);
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "INSERT INTO exam(exam_name, expire_date) VALUES ('$name','$expdate')";
    $result = mysqli_query($conn, $sql);
    if($result){
        $success = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        Applicant Information Updated!
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

if(isset($_POST['add_photo'])){  
    $post_id = $_POST['post_id'];

    $fileName = $_FILES["photo"]["name"];
    $fileSize = $_FILES["photo"]["size"];
    $tmpName = $_FILES["photo"]["tmp_name"];
    
    if(!empty($fileName)){
        $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);
        $validExtension = ['jpg','jpeg','png'];
    
        if(!in_array($imageExtension, $validExtension)){
        $uploaderror = '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Invalid image extension!
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        elseif($fileSize > 5000000){
        $uploaderror ='
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Image size is too large!
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        else{
    
        $newImageName = uniqid() . '.' . $imageExtension;
        $uploadDir = 'exam_photo/' . $newImageName;
    
        move_uploaded_file($tmpName, $uploadDir);
    
        $addsql = "INSERT INTO exam_gallery(post_id, photo) VALUES (?,?)";
        $stmt = mysqli_prepare($conn, $addsql);
        mysqli_stmt_bind_param($stmt, "is", $post_id, $newImageName);
    
        $result = mysqli_stmt_execute($stmt);
        if($result){
            $uploadsuccess = '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Successfully added an image!
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        else{
            echo "Failed: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        }
    }else{
        $uploaderror ='
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        You need to Input a Photo!
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
    <?php include('nav.php')?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-1">
                                <p class="card-title"> Exam Schedules</p>
                                <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#addsched">Add Schedule</button>
                            </div>
                            <?=$success?>
                            <?=$uploadsuccess?>
                            <?=$uploaderror?>
                            <div class="row mt-2">
                                <div class="col-12 border border-dark border-2 rounded-2 mb-4">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                            <th style="font-size: 16px">Exam#</th>
                                            <th style="font-size: 16px">Exam Name</th>
                                            <th style="font-size: 16px">Expiry Date</th>
                                            <th style="font-size: 16px">Actions</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = 'SELECT * FROM exam';
                                            $result = mysqli_query($conn, $sql);
                                            if(!mysqli_num_rows($result)>0){
                                                echo '<td colspan="11"><center>No Exam Schedules Found</center></td>';
                                            }else{
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $expiry = date('F d Y', strtotime($row['expire_date']));
                                                    ?>
                                                    <tr>
                                                        <td><?=$row['post_id']?></td>
                                                        <td><?=$row['exam_name']?></td>
                                                        <td><?=$expiry?></td>
                                                        <td>
                                                            <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#photos<?=$row['post_id']?>"><i class="fa-solid fa-image"></i></button>
                                                            <a href="delete_photo.php?delid=<?=$row['post_id']?>&deletion=1" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                }
                                            }
                                            ?>
                                            
                                        </tbody>
                                        </table>
                                            <?php
                                            $sql = 'SELECT * FROM exam';
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result)>0){
                                                while($modalrow = mysqli_fetch_assoc($result)){
                                                    ?>
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="modal fade" id="photos<?=$modalrow['post_id']?>" tabindex="-1" aria-labelledby="massemailLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="massemailLabel"><?=$modalrow['exam_name']?></h5>
                                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <table class="table text-center mt-3">
                                                                                <thead class="thead-dark">
                                                                                <tr>
                                                                                    <th>Photo</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    $photosql = "SELECT * FROM exam_gallery WHERE post_id = '".$modalrow['post_id']."'";
                                                                                    $photoresult = mysqli_query($conn ,$photosql);
                                                                                    if(!mysqli_num_rows($photoresult)>0){
                                                                                        echo '<td colspan="11"><center>No Photos Yet</center></td>';
                                                                                    }else{
                                                                                        while($photorow = mysqli_fetch_array($photoresult)){
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td><img src="exam_photo/<?=$photorow['photo']?>" alt=""></td>
                                                                                            <td><a href="delete_photo.php?delid=<?=$photorow['photo_id']?>&deletion=2" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a></td>
                                                                                        </tr>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <input type="text" name="post_id" class="d-none" value="<?=$modalrow['post_id']?>">
                                                                                <label for="photoupload">Add Photo:</label>
                                                                                <input type="file" name="photo" class="form-control-file" id="photoupload">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" name="add_photo" class="btn btn-primary">Add</button>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        <form method="post">
                                            <div class="modal fade" id="addsched" tabindex="-1" aria-labelledby="massemailLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="massemailLabel">Add Schedule</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <label for="">Expiry Date:</label>
                                                                <input type="date" name="exp" class="form-control" min="<?=$currentdate?>" required>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label for="">Exam Name:</label>
                                                                <input type="text" name="name" class="form-control" value="Traditional&Variable" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="add" class="btn btn-primary">Add</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

