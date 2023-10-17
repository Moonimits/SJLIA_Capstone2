<?php
include('../../dbcon.php');
$app_id = 4; //to be changed by actual login credentials

if(isset($_POST['uploadSSS'])){
    $appsql = "SELECT * FROM applicantdb WHERE application_id = '$app_id'";
    $appresult = mysqli_query($conn, $appsql);
    $approw = mysqli_fetch_assoc($appresult);
    //getfullname to create a folder
    $fullname = $approw['Lastname'] . ',' . $approw['Firstname'];
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
        if(file_exists($filelink)){
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
    $fullname = $approw['Lastname'] . ',' . $approw['Firstname'];
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
        if(file_exists($filelink)){
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
    $fullname = $approw['Lastname'] . ',' . $approw['Firstname'];
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
        if(file_exists($filelink)){
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
    $fullname = $approw['Lastname'] . ',' . $approw['Firstname'];
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
        if(file_exists($filelink)){
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
?>