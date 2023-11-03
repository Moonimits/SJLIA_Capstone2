<?php
session_start();
if(!isset($_SESSION['applicant_id'])){
  header('Location: ../../all/index.php');
}
include('../../dbcon.php');
$app_id = $_SESSION['applicant_id']; //to be changed by actual login credentials
$error = '';
$uploaderror = '';
$uploadsuccess = '';
if(isset($_POST['submitprofile'])){
  $sql = "SELECT * FROM applicantdb WHERE application_id = 1";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $oldimage = $row['profile_pic'];

  $fileName = $_FILES["profilepic"]["name"];
  $fileSize = $_FILES["profilepic"]["size"];
  $tmpName = $_FILES["profilepic"]["tmp_name"];

  if(!empty($fileName)){
    $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $imageExtension = strtolower($imageExtension);
    $validExtension = ['jpg','jpeg','png'];

    if(!in_array($imageExtension, $validExtension)){
      $uploaderror = '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Invalid image extension!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    elseif($fileSize > 5000000){
      $uploaderror ='
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Image size is too large!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
      
      unlink('profile_img/'.$oldimage);

      $newImageName = uniqid() . '.' . $imageExtension;
      $uploadDir = 'profile_img/' . $newImageName;

      move_uploaded_file($tmpName, $uploadDir);

      $addsql = "UPDATE applicantdb SET profile_pic = ? WHERE application_id = ?";
      $stmt = mysqli_prepare($conn, $addsql);
      mysqli_stmt_bind_param($stmt, "si", $newImageName, $app_id);

      $result = mysqli_stmt_execute($stmt);
      if($result){
        $uploadsuccess = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Successfully added an image!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
if(isset($_POST['submitpru'])){
  $edit_id = filter_input(INPUT_POST, "edit_id", FILTER_SANITIZE_SPECIAL_CHARS);
  $plukemail = filter_input(INPUT_POST, "plukemail", FILTER_SANITIZE_SPECIAL_CHARS);
  $pluk_application_id = filter_input(INPUT_POST, "pluk_application_id", FILTER_SANITIZE_SPECIAL_CHARS);
  $plukpassword = filter_input(INPUT_POST, "plukpassword", FILTER_SANITIZE_SPECIAL_CHARS);
  $upd = 1;

  $getsql = "SELECT pluk FROM applicantdb WHERE pluk = '$plukemail'";
  $getresult = mysqli_query($conn, $getsql);

  if(mysqli_num_rows($getresult)>0){//so if meron result, may error na email has been taken
    $error = 
    '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Pluk Email has already been registered!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
  }else{
    $sql = 'UPDATE applicantdb SET has_pruaccount = ?, pluk = ?,plukapplication_id = ?, plukpass = ? WHERE application_id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'isisi' , $upd, $plukemail, $pluk_application_id, $plukpassword, $edit_id);
    $result = mysqli_stmt_execute($stmt);
  
    if($result){
      ?>
      <link rel="stylesheet" href="../../registration/popup_style.css">
      <div class="popup popup--icon -success js_success-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
          <h3 class="popup__content__title">
            Pru Account Successfully Recorded!
          </h3>
          <p>
            <a href='index.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
          </p>
        </div>
      </div>
      <?php
    }
  }

}
if(isset($_POST['editpru'])){
  $edit_id = filter_input(INPUT_POST, "edit_id", FILTER_SANITIZE_SPECIAL_CHARS);
  $plukpassword = filter_input(INPUT_POST, "editplukpassword", FILTER_SANITIZE_SPECIAL_CHARS);

  $sql = 'UPDATE applicantdb SET plukpass = ? WHERE application_id = ?';
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'si' , $plukpassword, $edit_id);
  $result = mysqli_stmt_execute($stmt);

  if($result){
    ?>
    <link rel="stylesheet" href="../../registration/popup_style.css">
    <div class="popup popup--icon -success js_success-popup popup--visible">
      <div class="popup__background"></div>
      <div class="popup__content">
        <h3 class="popup__content__title">
          Pru Account Successfully Updated!
        </h3>
        <p>
          <a href='index.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
        </p>
      </div>
    </div>
    <?php
  }

}
if(isset($_POST['uploadSSS'])){
  $appsql = "SELECT * FROM applicantdb WHERE application_id = '$app_id'";
  $appresult = mysqli_query($conn, $appsql);
  $approw = mysqli_fetch_assoc($appresult);
  //getfullname to create a folder
  $fullname = $approw['Lastname'] . ', ' . $approw['Firstname'];
  $userFolder = 'documents/' . $fullname . '/';
  //create a folder if folder doesnt exist
  if (!file_exists($userFolder)) {
    mkdir($userFolder, 0777, true);
  }

  $sql = "SELECT sss FROM documents WHERE application_id = '$app_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $oldimage = $row['sss'];

  $fileName = $_FILES["sss_proof"]["name"];
  $fileSize = $_FILES["sss_proof"]["size"];
  $tmpName = $_FILES["sss_proof"]["tmp_name"];

  if(!empty($fileName)){
    $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $imageExtension = strtolower($imageExtension);
    $validExtension = ['jpg','jpeg','png'];

    if(!in_array($imageExtension, $validExtension)){
      $uploaderror = '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Invalid image extension!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    elseif($fileSize > 5000000){
      $uploaderror ='
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Image size is too large!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
      $filelink = $userFolder . $oldimage;
      if(!empty($oldimage) && file_exists($filelink)){
        unlink($filelink);
      }

      $newImageName = uniqid() . '.' . $imageExtension;
      $uploadDir = $userFolder . $newImageName;

      move_uploaded_file($tmpName, $uploadDir);

      $addsql = "UPDATE documents SET sss = ? WHERE application_id = ?";
      $stmt = mysqli_prepare($conn, $addsql);
      mysqli_stmt_bind_param($stmt, "si", $newImageName, $app_id);

      $result = mysqli_stmt_execute($stmt);
      if($result){
        $uploadsuccess = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Uploaded SSS proof!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
if(isset($_POST['uploadTIN'])){
  $appsql = "SELECT * FROM applicantdb WHERE application_id = '$app_id'";
  $appresult = mysqli_query($conn, $appsql);
  $approw = mysqli_fetch_assoc($appresult);

  //getfullname to create a folder
  $fullname = $approw['Lastname'] . ', ' . $approw['Firstname'];
  $userFolder = 'documents/' . $fullname . '/';

  //create a folder if folder doesnt exist
  if (!file_exists($userFolder)) {
    mkdir($userFolder, 0777, true);
  }

  //get the old image 
  $sql = "SELECT tin FROM documents WHERE application_id = '$app_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $oldimage = $row['tin'];

  $fileName = $_FILES["tin_proof"]["name"];
  $fileSize = $_FILES["tin_proof"]["size"];
  $tmpName = $_FILES["tin_proof"]["tmp_name"];

  if(!empty($fileName)){
    $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $imageExtension = strtolower($imageExtension);
    $validExtension = ['jpg','jpeg','png'];

    if(!in_array($imageExtension, $validExtension)){
      $uploaderror = '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Invalid image extension!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    elseif($fileSize > 5000000){
      $uploaderror ='
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Image size is too large!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
      $filelink = $userFolder . $oldimage;
      if(!empty($oldimage) && file_exists($filelink)){
        unlink($filelink);
      }

      $newImageName = uniqid() . '.' . $imageExtension;
      $uploadDir = $userFolder . $newImageName;

      move_uploaded_file($tmpName, $uploadDir);

      $addsql = "UPDATE documents SET tin = ? WHERE application_id = ?";
      $stmt = mysqli_prepare($conn, $addsql);
      mysqli_stmt_bind_param($stmt, "si", $newImageName, $app_id);

      $result = mysqli_stmt_execute($stmt);
      if($result){
        $uploadsuccess = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Uploaded TIN proof!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
if(isset($_POST['uploadGovId'])){
  $appsql = "SELECT * FROM applicantdb WHERE application_id = '$app_id'";
  $appresult = mysqli_query($conn, $appsql);
  $approw = mysqli_fetch_assoc($appresult);

  //getfullname to create a folder
  $fullname = $approw['Lastname'] . ', ' . $approw['Firstname'];
  $userFolder = 'documents/' . $fullname . '/';

  //create a folder if folder doesnt exist
  if (!file_exists($userFolder)) {
    mkdir($userFolder, 0777, true);
  }

  //get the old image 
  $sql = "SELECT gov_id FROM documents WHERE application_id = '$app_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $oldimage = $row['gov_id'];

  $fileName = $_FILES["gov_id"]["name"];
  $fileSize = $_FILES["gov_id"]["size"];
  $tmpName = $_FILES["gov_id"]["tmp_name"];

  if(!empty($fileName)){
    $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $imageExtension = strtolower($imageExtension);
    $validExtension = ['jpg','jpeg','png'];

    if(!in_array($imageExtension, $validExtension)){
      $uploaderror = '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Invalid image extension!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    elseif($fileSize > 5000000){
      $uploaderror ='
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Image size is too large!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
      $filelink = $userFolder . $oldimage;
      if(!empty($oldimage) && file_exists($filelink)){
        unlink($filelink);
      }

      $newImageName = uniqid() . '.' . $imageExtension;
      $uploadDir = $userFolder . $newImageName;

      move_uploaded_file($tmpName, $uploadDir);

      $addsql = "UPDATE documents SET gov_id = ? WHERE application_id = ?";
      $stmt = mysqli_prepare($conn, $addsql);
      mysqli_stmt_bind_param($stmt, "si", $newImageName, $app_id);

      $result = mysqli_stmt_execute($stmt);
      if($result){
        $uploadsuccess = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Uploaded Government ID!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
if(isset($_POST['upload1x1'])){
  $appsql = "SELECT * FROM applicantdb WHERE application_id = '$app_id'";
  $appresult = mysqli_query($conn, $appsql);
  $approw = mysqli_fetch_assoc($appresult);

  //getfullname to create a folder
  $fullname = $approw['Lastname'] . ', ' . $approw['Firstname'];
  $userFolder = 'documents/' . $fullname . '/';

  //create a folder if folder doesnt exist
  if (!file_exists($userFolder)) {
    mkdir($userFolder, 0777, true);
  }

  //get the old image 
  $sql = "SELECT 1x1 FROM documents WHERE application_id = '$app_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $oldimage = $row['1x1'];

  $fileName = $_FILES["1x1_picture"]["name"];
  $fileSize = $_FILES["1x1_picture"]["size"];
  $tmpName = $_FILES["1x1_picture"]["tmp_name"];

  if(!empty($fileName)){
    $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $imageExtension = strtolower($imageExtension);
    $validExtension = ['jpg','jpeg','png'];

    if(!in_array($imageExtension, $validExtension)){
      $uploaderror = '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Invalid image extension!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    elseif($fileSize > 5000000){
      $uploaderror ='
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Image size is too large!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
      $filelink = $userFolder . $oldimage;
      if(!empty($oldimage) && file_exists($filelink)){
        unlink($filelink);
      }

      $newImageName = uniqid() . '.' . $imageExtension;
      $uploadDir = $userFolder . $newImageName;

      move_uploaded_file($tmpName, $uploadDir);

      $addsql = "UPDATE documents SET 1x1 = ? WHERE application_id = ?";
      $stmt = mysqli_prepare($conn, $addsql);
      mysqli_stmt_bind_param($stmt, "si", $newImageName, $app_id);

      $result = mysqli_stmt_execute($stmt);
      if($result){
        $uploadsuccess = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Uploaded 1x1 Picture!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
if(isset($_POST['uploadCert'])){
  $appsql = "SELECT * FROM applicantdb WHERE application_id = '$app_id'";
  $appresult = mysqli_query($conn, $appsql);
  $approw = mysqli_fetch_assoc($appresult);

  //getfullname to create a folder
  $fullname = $approw['Lastname'] . ', ' . $approw['Firstname'];
  $userFolder = 'documents/' . $fullname . '/';

  //create a folder if folder doesnt exist
  if (!file_exists($userFolder)) {
    mkdir($userFolder, 0777, true);
  }

  //get the old image 
  $sql = "SELECT rop_cert FROM documents WHERE application_id = '$app_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $oldimage = $row['rop_cert'];

  $fileName = $_FILES["rop_certificate"]["name"];
  $fileSize = $_FILES["rop_certificate"]["size"];
  $tmpName = $_FILES["rop_certificate"]["tmp_name"];

  if(!empty($fileName)){
    $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $imageExtension = strtolower($imageExtension);
    $validExtension = ['jpg','jpeg','png'];

    if(!in_array($imageExtension, $validExtension)){
      $uploaderror = '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Invalid image extension!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    elseif($fileSize > 5000000){
      $uploaderror ='
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Image size is too large!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
      $filelink = $userFolder . $oldimage;
      if(!empty($oldimage) && file_exists($filelink)){
        unlink($filelink);
      }

      $newImageName = uniqid() . '.' . $imageExtension;
      $uploadDir = $userFolder . $newImageName;

      move_uploaded_file($tmpName, $uploadDir);

      $addsql = "UPDATE documents SET rop_cert = ? WHERE application_id = ?";
      $stmt = mysqli_prepare($conn, $addsql);
      mysqli_stmt_bind_param($stmt, "si", $newImageName, $app_id);

      $result = mysqli_stmt_execute($stmt);
      if($result){
        $uploadsuccess = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Uploaded ROP Certificate Picture!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
if(isset($_POST['add_client'])){
  $cname = filter_input(INPUT_POST, "cname", FILTER_SANITIZE_SPECIAL_CHARS);
  $cemail = filter_input(INPUT_POST, "cemail", FILTER_SANITIZE_SPECIAL_CHARS);
  $cnumber = filter_input(INPUT_POST, "cnumber", FILTER_SANITIZE_SPECIAL_CHARS);

  $sql = "INSERT INTO clients(application_id,fullname,email,contact_no) VALUES ('$app_id','$cname','$cemail','$cnumber')";
  $result = mysqli_query($conn, $sql);
  if($result){
    $uploadsuccess = '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Client successfully added!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
if(isset($_POST['changepass'])){
  $edit_id = filter_input(INPUT_POST, "edit_id", FILTER_SANITIZE_SPECIAL_CHARS);
  $newpass = filter_input(INPUT_POST, "newpass", FILTER_SANITIZE_SPECIAL_CHARS);

  $sql = "UPDATE applicantdb SET password = '$newpass' WHERE application_id = '$edit_id'";
  $result = mysqli_query($conn, $sql);
    if($result){
      ?>
      <link rel="stylesheet" href="../../registration/popup_style.css">
      <div class="popup popup--icon -success js_success-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
          <h3 class="popup__content__title">
            Password Changed!
          </h3>
          <p>
            <a href='index.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
          </p>
        </div>
      </div>
      <?php
    }
  
}
if(isset($_POST['action']) && $_POST['action'] === 'updateNotification'){
  $sql = "UPDATE notification SET is_read = 1 WHERE application_id = '$app_id'";
  $result = mysqli_query($conn, $sql);
}

$sql = "SELECT * FROM applicantdb WHERE application_id = '$app_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

//printing the informations
$fullname = $row['Lastname'] . ', ' . $row['Firstname'] . ' ' . $row['Middlename'][0] . '.';
$address = $row['streetname'] . ', ' . $row['barangay'] . ', ' . $row['city'] . ', ' . $row['province'];
$completion = $row['is_completed'] + $row['confirmed_rop'] + $row['confirmed_documents'] + $row['confirmed_elicense'];

if($completion == 0){
  $statusClass = 'badge rounded-pill bg-danger';
  $status = 'New Applicant';
}elseif($completion >= 1 && $completion <= 3){
  $statusClass = 'badge rounded-pill bg-warning';
  if($row['confirmed_elicense'] == 1){
      $status = 'Temporary Agent (CLR)';                                            
  }elseif($row['confirmed_documents'] == 1){
      $status = 'Temporary Agent (ICE)';                                            
  }elseif($row['confirmed_rop'] == 1){
      $status = 'Temporary Agent (ROP)';                                            
  }
}elseif($completion == 4){
  $statusClass = 'badge rounded-pill bg-success';
  $status = 'Licensed Agent';
}

$dateInWords = date('F d Y', strtotime($row['birthdate']));

$c = date("Y-m-d");
$birthdate = new DateTime($row['birthdate']);
$currentdate = new DateTime($c);

$ageInterval = $birthdate->diff($currentdate);
$age = $ageInterval->y;

$foldername = $row['Lastname'] . ', ' . $row['Firstname'];
$userFolder = 'documents/' . $foldername . '/';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Southern Jade</title>
  <link rel="icon" href="../../images/logajade.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha384-ePjGJxNV59PKnOMIwJ0Dp0a7KeW2R4zj9Ukb8UaRKY1exaP0gNz6roF26djpvt0A" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
</head>

<style>

  .profile-container {
    background-image: url("assets/images/lol.jpg"); 
    background-size: cover; 
    background-position-y: 25%; 
    height: 20%;
  }

  .inside-container {
    background-color: azure;
    background-size: cover; 
    background-position: center;
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
    height: 100%;
  }

  strong {
    font-family: 'Manrope', sans-serif;
    font-size: large;
  }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .step-wizard-list {
        color: #333;
        list-style-type: none;
        border-radius: 10px;
        display: flex;
        padding: 20px 10px;
        position: relative;
        z-index: 10;
    }

    .step-wizard-item {
        padding: 0 20px;
        flex-basis: 0;
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
        display: flex;
        flex-direction: column;
        text-align: center;
        min-width: 170px;
        position: relative;
    }

    .step-wizard-item+.step-wizard-item:after {
        content: "";
        position: absolute;
        left: 0;
        top: 19px;
        background: #21d4fd;
        width: 100%;
        height: 2px;
        transform: translateX(-50%);
        z-index: -10;
    }

    .progress-count {
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-weight: 600;
        margin: 0 auto;
        position: relative;
        z-index: 10;
        color: transparent;
    }

    .progress-count:after {
        content: "";
        height: 40px;
        width: 40px;
        background: #21d4fd;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        z-index: -10;
    }

    .progress-count:before {
        content: "";
        height: 10px;
        width: 20px;
        border-left: 3px solid #fff;
        border-bottom: 3px solid #fff;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -60%) rotate(-45deg);
        transform-origin: center center;
    }

    .progress-label {
        font-size: 14px;
        font-weight: 600;
        margin-top: 10px;
    }

    .current-item .progress-count:before,
    .current-item~.step-wizard-item .progress-count:before {
        display: none;
    }

    .current-item~.step-wizard-item .progress-count:after {
        height: 10px;
        width: 10px;
    }

    .current-item~.step-wizard-item .progress-label {
        opacity: 0.5;
    }

    .current-item .progress-count:after {
        background: #fff;
        border: 2px solid #21d4fd;
    }

    .current-item .progress-count {
        color: #21d4fd;
    }
</style>

<body>
  <div class="container form-container">
    <div class="col-lg-12 mx-auto login-container">
      <div class="row form-header">
        <div class="col-md-3 logocol">
          <img src="assets/images/logo.png" alt="">
        </div>
      </div>
      <div class="col-lg-15 mx-auto profile-container">
        <div class="col-lg-15 mx-auto inside-container">
          <div class="row">
            <div id="end" class="col-md-5 border-custom">
              <div class="row">
                <div class="col-md-3 ms-4 mt-3 text-center">
                  <img src="profile_img/<?php echo $row['profile_pic'] ?>" alt="" class="img-fluid">
                  <button type="button" class="btn btn-outline-success btn-sm my-1" data-bs-toggle="modal" data-bs-target="#profile">
                    Edit Profile
                  </button>
                </div>
                <div class="col-md-7">
                  <br> 
                  <p><strong><?=$fullname?></strong></p>
                  <p><?=$address?></p>
                  <div class="d-flex">
                    <p class="me-2">Applicant Status: </p>
                    <p class="<?=$statusClass?>"><?=$status?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">                  
              <br> 
              <p><strong>Email: &nbsp; </strong><?=$row['Email']?></p>
              <p><strong>PLUK Email: &nbsp; </strong><?=$row['pluk']?></p>
              <p><strong>Contact Number: &nbsp; </strong><?=$row['contact_number']?></p>
            </div>
            <div class="col-md-3">                  
              <br> 
              <div class="text-end me-3">
                <div class="dropdown">
                  <button class="btn btn-light " type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gear fa-lg " style="color: #000000;"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#pruaccount">Prulife Account</button></li>
                    <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changepassword">Change Password</button></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-body">
        <?php
        echo $uploaderror;
        echo $uploadsuccess;
        if(isset($_GET['msg'])){
          echo $_GET['msg'];
        }
        ?>
      <section class="step-wizard">
        <ul class="step-wizard-list mb-0">
          <li class="step-wizard-item">
              <span class="progress-count">1</span>
              <span class="progress-label">New Applicant</span>
          </li>
          <li class="step-wizard-item <?= ($completion == 0) ? 'current-item' : '' ?>">
              <span class="progress-count">2</span>
              <span class="progress-label">ROP</span>
          </li>
          <li class="step-wizard-item <?= ($completion == 1) ? 'current-item' : '' ?>">
              <span class="progress-count">3</span>
              <span class="progress-label">ICE</span>
          </li>
          <li class="step-wizard-item <?= ($completion == 2) ? 'current-item' : '' ?>">
              <span class="progress-count">3</span>
              <span class="progress-label">CLR</span>
          </li>
          <li class="step-wizard-item <?= ($completion == 3) ? 'current-item' : '' ?>">
              <span class="progress-count">4</span>
              <span class="progress-label">Completed</span>
          </li>
        </ul>
      </section>
        <div class="form-title row">
          <h4></h4>
        </div>
        <div class="card">
            <ul class="nav nav-tabs">
                <li><a data-bs-toggle="tab" class="nav-link active" aria-current="page" href="#about" style="font-weight:Lighter; font-size:125%;">About</a> </li>
                <li><a data-bs-toggle="tab" class="nav-link" href="#docu" style="font-weight:lighter; font-size:125%;">Documents</a></li>
                <?php
                if($row['applicant_status']=='Licensed Agent'){
                  ?>
                  <li><a data-bs-toggle="tab" class="nav-link" href="#clients" style="font-weight:lighter; font-size:125%;">Clients</a></li>
                  <?php
                }
                ?>
                <?php
                $notifsql = "SELECT * FROM notification WHERE application_id = '$app_id' AND is_read = 0";
                $notifresult = mysqli_query($conn, $notifsql);
                $numrow = mysqli_num_rows($notifresult);
                ?>
                <li><a data-bs-toggle="tab" class="nav-link position-relative" href="#notif" onclick="updateNotification()" style="font-weight:lighter; font-size:125%;">Notifications <span id="notifbadge"><?php echo $numrow != 0 ? '<span style="font-size: 10px;" class="position-absolute  badge rounded-pill bg-danger mb-3">' .$numrow. '</span>' : '';?></span></a></li>
            </ul>
            <div class="tab-content">
              <div id="about" class="tab-pane fade show active">
                  <div class="row">
                      <nav id="sidebar" class="col-md-3 col-lg-3 d-md-block border-end">
                      <div class="position-sticky">
                          <ul class="nav flex-column">
                          <li class="nav-item active">
                              <a class="nav-link active" href="#" onclick="showContent('home-content');">
                              Personal Information
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#" onclick="showContent('about-content');">
                              Contact Information
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#" onclick="showContent('page1-content');">
                              Recruiter's Information
                              </a>
                          </li>
                          </ul>
                      </div>
                      </nav>
                      <div class="col-md-9">
                        <div id="home-content" class="page-content">
                          <div class="row">
                            <div class="col-lg-2">
                              <br>
                              <p><b> Address: </b></p>
                              <p><b> Gender: </b></p>
                              <p><b> Civil Status: </b></p>
                              <p><b> Birthplace: </b></p>
                              <p><b> Birthdate: </b></p>
                              <p><b> Age: </b></p>
                              <p><b> SSS Number: </b></p>
                              <p><b> TIN Number: </b></p>
                            </div>
                            <div class="col-lg-10">
                            <br>
                              <p><?=$address?></p>
                              <p><?=ucfirst($row['gender'])?></p>
                              <p><?=ucfirst($row['civil_status'])?></p>
                              <p><?=$row['birthplace']?></p>
                              <p><?=$dateInWords?></p>
                              <p><?=$age . ' Years old'?></p>
                              <p><?=$row['sss']?></p>
                              <p><?=$row['tin']?></p>
                            </div>
                          </div>
                        </div>
                        <div id="about-content" class="page-content">
                          <div class="row">
                            <div class="col-lg-2">
                              <p><b> Email: </b></p>
                              <p><b> PLUK Email: </b></p>
                              <p><b> Contact Number: </b></p>
                            </div>
                            <div class="col-lg-10">
                              <p><?=$row['Email']?></p>
                              <p><?=$row['pluk']?></p>
                              <p><?=$row['contact_number']?></p>
                            </div>
                          </div>
                        </div>
                        <div id="page1-content" class="page-content">
                          <div class="row">
                            <div class="col-lg-2">
                              <p><b> Recruiter's Name: </b></p>
                              <p><b> Recruiter's Code: </b></p>
                            </div>
                            <div class="col-lg-10">
                              <p><?=$row['recruiter_name']?></p>
                              <p><?=$row['recruiter_code']?></p>
                            </div>
                          </div>
                        </div>

                      
                        
                      </div>
                  </div>
              </div>
              <div id="docu" class="tab-pane fade">
                <?php
                $docsql = "SELECT * FROM documents WHERE application_id = '$app_id'";
                $docresult = mysqli_query($conn , $docsql);
                $docrow = mysqli_fetch_assoc($docresult);
                ?>
                  <form method="post" enctype="multipart/form-data">
                    <div class="row justify-content-center p-4">
                      <h4 class="mb-3">Upload Documents</h4>
                      <!-- Proof of SSS -->
                      <div class="col-lg-4 ">
                        <div class="text-center bg-light rounded shadow p-3">
                            <img style="height:300px; width: 100%;" src="<?php echo !empty($docrow['sss']) ? $userFolder . $docrow['sss'] : 'documents/default.jpg'; ?>" alt="" class="img-fluid">
                            <label for="sss_proof" class="form-label">Proof of SSS:</label>
                            <input type="file" class="form-control" name="sss_proof" id="sss_proof" value="<?php echo $docrow['sss']?>" accept="image/*">
                            <button type="submit" class="btn btn-primary mt-2" name="uploadSSS">Upload</button>
                        </div>
                      </div>

                      <!-- Proof of TIN -->
                      <div class="col-lg-4 ">
                        <div class="text-center bg-light rounded shadow p-3">
                            <img style="height:300px; width: 100%;" src="<?php echo !empty($docrow['tin']) ? $userFolder . $docrow['tin'] : 'documents/default.jpg'; ?>" alt="" class="img-fluid">
                            <label for="tin_proof" class="form-label">Proof of TIN:</label>
                            <input type="file" class="form-control" name="tin_proof" id="tin_proof" value="<?php echo $docrow['tin']?>" accept="image/*">
                            <button type="submit" class="btn btn-primary mt-2" name="uploadTIN">Upload</button>
                        </div>
                      </div>

                      <!-- Government ID -->
                      <div class="col-lg-4 ">
                        <div class="text-center bg-light rounded shadow p-3">
                            <img style="height:300px; width: 100%;" src="<?php echo !empty($docrow['gov_id']) ? $userFolder . $docrow['gov_id'] : 'documents/default.jpg'; ?>" alt="" class="img-fluid">
                            <label for="gov_id" class="form-label">Government ID:</label>
                            <input type="file" class="form-control" name="gov_id" id="gov_id" value="<?php echo $docrow['gov_id']?>" accept="image/*">
                            <button type="submit" class="btn btn-primary mt-2" name="uploadGovId">Upload</button>
                        </div>
                      </div>

                      <!-- 1x1 Picture with Red Background -->
                      <div class="col-lg-4 mt-3">
                        <div class="text-center bg-light rounded shadow p-3">
                            <img style="height:300px; width: 100%;" src="<?php echo !empty($docrow['1x1']) ? $userFolder . $docrow['1x1'] : 'documents/default.jpg'; ?>" alt="" class="img-fluid">
                            <label for="1x1_picture" class="form-label">1x1 Picture (Red Background):</label>
                            <input type="file" class="form-control" name="1x1_picture" id="1x1_picture" value="<?php echo $docrow['1x1']?>" accept="image/*">
                            <button type="submit" class="btn btn-primary mt-2" name="upload1x1">Upload</button>
                        </div>
                      </div>

                      <!-- Rop Certificate -->
                      <div class="col-lg-4 mt-3">
                        <div class="text-center bg-light rounded shadow p-3">
                            <img style="height:300px; width: 100%;" src="<?php echo !empty($docrow['rop_cert']) ? $userFolder . $docrow['rop_cert'] : 'documents/default.jpg'; ?>" alt="" class="img-fluid">
                            <label for="rop_certificate" class="form-label">ROP Certificate:</label>
                            <input type="file" class="form-control" name="rop_certificate" id="rop_certificate" value="<?php echo $docrow['rop_cert']?>" accept="image/*">
                            <button type="submit" class="btn btn-primary mt-2" name="uploadCert">Upload</button>
                        </div>
                      </div>
                    </div>
                  </form>
              </div>
              <div id="notif" class="tab-pane fade">
                <div class="card border border-success border-3 rounded-4 mb-4">
                  <div class="d-flex card-header bg-transparent border-success justify-content-between align-items-center">
                      <div style="font-size: 25px;"><strong>Notifications</strong></div>
                  </div>
                  <div class="card-body pt-0" style="height: 10%;">
                    <div class="row text-center">  
                      <?php
                      $notifsql = "SELECT * FROM notification WHERE application_id = '$app_id' ORDER BY notif_id DESC";
                      $notifresult = mysqli_query($conn, $notifsql);
                      if(!mysqli_num_rows($notifresult)>0){
                        ?>
                        <h4>No Notifications</h4>
                        <?php
                      }else{
                        while($notifrow = mysqli_fetch_assoc($notifresult)){
                          ?>
                          <div class="col-lg-12 border-bottom border-secondary pt-3">
                            <div class="d-flex text-start">
                              <h5 class="me-2"><strong>Message:</strong></h5>
                              <p><?=$notifrow['message']?></p>
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
              <div id="clients" class="tab-pane fade">
                <div class="card border border-success border-3 rounded-4 mb-4">
                  <div class="d-flex card-header bg-transparent border-success justify-content-between align-items-center">
                      <div style="font-size: 25px;"><strong>Clients</strong></div>                       
                      <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#addclient">Add Client</button>
                  </div>
                  <div class="card-body pt-0" style="height: 10%;">
                    <div class="row text-center">  
                      <div class="table-responsive">
                          <table class="table table-bordered table-hover text-center" style="width:100%">
                            <thead>
                              <tr>
                                <th>Number</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $csql = "SELECT * FROM clients WHERE application_id = '$app_id'";
                              $cresult = mysqli_query($conn,$csql);

                              if(!mysqli_num_rows($cresult)>0){
                                  echo '<td colspan="11"><center>No Client record found</center></td>';
                              }else{
                                  $count = 1;
                                  while($crow = mysqli_fetch_assoc($cresult)){
                                    ?>
                                    <tr>
                                        <td><?= $count?></td>
                                        <td><?= $crow['fullname']?></td>
                                        <td><?= $crow['email']?></td>     
                                        <td><?= $crow['contact_no']?></td>       
                                        <td><a href="deleteclient.php?delid=<?=$crow['client_id']?>" class="btn btn-danger btn-sm"><i class="text-light fa-solid fa-trash-can"></i></a></td>                        
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
    </div>

    <!-- modal -->
    <form method="post" enctype="multipart/form-data">
      <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="profile" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="profile">Upload Profile</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div>
                <label for="formFile" class="form-label">Default file input example</label>
                <input class="form-control" type="file" name="profilepic" id="formFile">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="submitprofile" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- modal -->
  </div>
      
      <!-- update pru account -->
      <form method="post">
        <div class="modal fade" tabindex="-1" id="pruaccount">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Pru Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <input type="text" name="edit_id" value="<?= $row['application_id']?>" style="display: none;">
                    <div class="form-group">
                      <label >Pluk email:</label>
                      <input class="form-control" type="email" name="editplukemail" placeholder="Input pluk email" value="<?=$row['pluk']?>" disabled>
                    </div>
                    <div class="form-group">
                      <label >Application ID:</label>
                      <input class="form-control" type="number" name="pluk_application_id" placeholder="Input application id" value="<?=$row['plukapplication_id']?>" disabled>
                    </div>
                    <div class="form-group">
                      <label >Pru Account Password:</label>
                      <input class="form-control" type="password" name="editplukpassword" placeholder="Input updated pru account password" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="editpru" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </form>

      <!-- change password -->
      <form method="post">
        <div class="modal fade" tabindex="-1" id="changepassword">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <input type="text" name="edit_id" value="<?= $row['application_id']?>" style="display: none;">
                    <div class="form-group">
                      <label >New Password:</label>
                      <input class="form-control" type="password" name="newpass" placeholder="Enter new Password">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="changepass" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </form>

      <!-- add client -->
      <form method="post">
        <div class="modal fade" tabindex="-1" id="addclient">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label >Client Name:</label>
                      <input class="form-control" type="text" name="cname" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                      <label >Client Email:</label>
                      <input class="form-control" type="email" name="cemail" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                      <label >Client Contact Number:</label>
                      <input class="form-control" type="number" name="cnumber" placeholder="Enter Contact Number" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="add_client" class="btn btn-success">Add</button>
              </div>
            </div>
          </div>
        </div>
      </form>

  <!-- modal if dont have an pruaccount -->
  <?php
    if($row['has_pruaccount']==0){
      ?>
      <form method="post">
        <div class="modal fade" tabindex="-1" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Pru Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <p><strong>Do you have a Pru Account? </strong></p>
                    <?= $error?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <input type="text" name="edit_id" value="<?= $row['application_id']?>" style="display: none;">
                    <div class="form-group">
                      <label >Pluk email:</label>
                      <input class="form-control" type="email" name="plukemail" placeholder="Input pluk email" required>
                    </div>
                    <div class="form-group">
                      <label >Application ID:</label>
                      <input class="form-control" type="number" name="pluk_application_id" placeholder="Input application id" required>
                    </div>
                    <div class="form-group">
                      <label >Pru Account Password:</label>
                      <input class="form-control" type="password" name="plukpassword" placeholder="Input pru account password" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submitpru" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </form>
      <?php
    }
  ?>


  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Function to hide all page content divs
    function hideAllContent() {
      var allContentDivs = document.querySelectorAll('.page-content');
      for (var i = 0; i < allContentDivs.length; i++) {
        allContentDivs[i].style.display = 'none';
      }
    }

    // Hide all content initially when the page loads
    window.onload = function () {
      hideAllContent();
    };

    function showContent(contentId) {
      // Hide all page content divs
      hideAllContent();

      // Show the selected content div
      var selectedContent = document.getElementById(contentId);
      if (selectedContent) {
        selectedContent.style.display = 'block';
      }
    }
  </script>
  
  <script>
  function updateNotification() {
      // Your PHP code within JavaScript
      $.ajax({
          type: 'POST',
          url: 'index.php', // You can use the same file
          data: {
              action: 'updateNotification' // Define an action for your inline PHP code
          },
          success: function(response) {
              $('#notifbadge').html('');
          }
      });
  }
  </script>

<script>
// Use jQuery to trigger the modal when the page is ready
    $(document).ready(function(){
        $('#myModal').modal('show');
    });
</script>

</body>
</html>
