<?php
include('../../../../dbcon.php');
$id = $_GET['id'];
$appid = $_GET['app_id'];
$empty = '';

if($id == 1){
    $sql = "UPDATE documents SET sss = '$empty', confirm_sss = 0 WHERE application_id = '$appid'";
    $result = mysqli_query($conn, $sql);
    $message = "We regret to inform you that the uploaded SSS document did not meet our approval criteria.  
                Kindly resubmit the document for further review. If you have any questions or need assistance, 
                please do not hesitate to contact our support team. Thank you for your understanding.";

    $sql = "INSERT INTO notification(application_id, message) VALUES ('$appid','$message')";
    $result = mysqli_query($conn, $sql);

    if($result){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Document Unapproved
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
    $sql = "UPDATE documents SET tin = '$empty', confirm_tin = 0 WHERE application_id = '$appid'";
    $result = mysqli_query($conn, $sql);
    $message = "We regret to inform you that the uploaded SSS document did not meet our approval criteria.  
                Kindly resubmit the document for further review. If you have any questions or need assistance, 
                please do not hesitate to contact our support team. Thank you for your understanding.";

    $sql = "INSERT INTO notification(application_id, message) VALUES ('$appid','$message')";
    $result = mysqli_query($conn, $sql);

    if($result){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Document Unapproved
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
    $sql = "UPDATE documents SET gov_id = '$empty', confirm_gov = 0 WHERE application_id = '$appid'";
    $result = mysqli_query($conn, $sql);
    $message = "We regret to inform you that the uploaded SSS document did not meet our approval criteria.  
                Kindly resubmit the document for further review. If you have any questions or need assistance, 
                please do not hesitate to contact our support team. Thank you for your understanding.";

    $sql = "INSERT INTO notification(application_id, message) VALUES ('$appid','$message')";
    $result = mysqli_query($conn, $sql);

    if($result){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Document Unapproved
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
    $sql = "UPDATE documents SET 1x1 = '$empty', confirm_1x1 = 0 WHERE application_id = '$appid'";
    $result = mysqli_query($conn, $sql);
    $message = "We regret to inform you that the uploaded SSS document did not meet our approval criteria.  
                Kindly resubmit the document for further review. If you have any questions or need assistance, 
                please do not hesitate to contact our support team. Thank you for your understanding.";

    $sql = "INSERT INTO notification(application_id, message) VALUES ('$appid','$message')";
    $result = mysqli_query($conn, $sql);

    if($result){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
          <div class="popup__background"></div>
          <div class="popup__content">
            <h3 class="popup__content__title">
              Document Unapproved
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