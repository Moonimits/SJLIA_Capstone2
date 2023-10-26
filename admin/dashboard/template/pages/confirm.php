<?php
include('../../../../dbcon.php');
$id = $_GET['id'];
$appid = $_GET['app_id'];

if($id == 1){
    $sql = "UPDATE documents SET confirm_sss = 1 WHERE application_id = '$appid'";
    $result = mysqli_query($conn, $sql);
    $message = 'Great news! Your uploaded SSS document has been approved successfully. Thank you for your submission!';

    $sql = "INSERT INTO notification(application_id, message) VALUES ('$appid','$message')";
    $result = mysqli_query($conn, $sql);

    if($result){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Document Approved
            </h3>
            <p>Notification sent to the applicant</p>
            <p>
              <a href='applicant_docs.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
            </p>
          </div>
        </div>
        <?php
    }
}elseif($id == 2){
    $sql = "UPDATE documents SET confirm_tin = 1 WHERE application_id = '$appid'";
    $result = mysqli_query($conn, $sql);
    $message = 'Great news! Your uploaded TIN document has been approved successfully. Thank you for your submission!';

    $sql = "INSERT INTO notification(application_id, message) VALUES ('$appid','$message')";
    $result = mysqli_query($conn, $sql);

    if($result){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Document Approved
            </h3>
            <p>Notification sent to the applicant</p>
            <p>
              <a href='applicant_docs.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
            </p>
          </div>
        </div>
        <?php
    }
}elseif($id == 3){
    $sql = "UPDATE documents SET confirm_gov = 1 WHERE application_id = '$appid'";
    $result = mysqli_query($conn, $sql);
    $message = 'Great news! Your uploaded Government ID document have been approved successfully. Thank you for your submission!';

    $sql = "INSERT INTO notification(application_id, message) VALUES ('$appid','$message')";
    $result = mysqli_query($conn, $sql);

    if($result){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Document Approved
            </h3>
            <p>Notification sent to the applicant</p>
            <p>
              <a href='applicant_docs.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
            </p>
          </div>
        </div>
        <?php
    }
}elseif($id == 4){
    $sql = "UPDATE documents SET confirm_1x1 = 1 WHERE application_id = '$appid'";
    $result = mysqli_query($conn, $sql);
    $message = 'Great news! Your uploaded 1x1 Picture has been approved successfully. Thank you for your submission!';

    $sql = "INSERT INTO notification(application_id, message) VALUES ('$appid','$message')";
    $result = mysqli_query($conn, $sql);

    if($result){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Document Approved
            </h3>
            <p>Notification sent to the applicant</p>
            <p>
              <a href='applicant_docs.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
            </p>
          </div>
        </div>
        <?php
    }
}elseif($id == 5){
  $sql = "UPDATE applicantdb SET confirmed_rop = 1 WHERE application_id = '$appid'";
  $result = mysqli_query($conn, $sql);
  $message = 'Great news! Your uploaded ROP certificate has been approved successfully. Thank you for your submission!';

  $sql = "INSERT INTO notification(application_id, message) VALUES ('$appid','$message')";
  $result = mysqli_query($conn, $sql);

  if($result){
      ?>
      <link rel="stylesheet" href="../../../../registration/popup_style.css">
      <div class="popup popup--icon -success js_success-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
          <h3 class="popup__content__title">
            Document Approved
          </h3>
          <p>Notification sent to the applicant</p>
          <p>
            <a href='applicant_docs.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
          </p>
        </div>
      </div>
      <?php
  }
}

?>