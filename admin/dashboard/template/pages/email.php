<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

//confim reservation
function sendEmail($email,$message)
{
    $subject = "PruLife Southern Jade Email";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'southernjadelifeinsurance@gmail.com';
    $mail->Password = 'jmtn vtvn agkw cnhd';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('southernjadelifeinsurance@gmail.com');
    $mail->addAddress($email);//
    $mail->Subject = $subject;//
    $mail->msgHTML($message);//
    
    if($mail->send()){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">
            Email Notification Sent 
            </h3>
            <p>
            <a href='dashboard.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
            </p>
        </div>
        </div>
        <?php
        
    }else{
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -error js_error-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">
            Error 
            </h1>
            <p>Something Goes Wrong.....</p>
            <p>
                <a href="dashboard.php"><button class="button button--error" data-for="js_error-popup">close</button></a>
            </p>
        </div>
        </div>
        <?php
    }
}

function sendManualEmail($email,$message)
{
    $subject = "PruLife Southern Jade Email";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'southernjadelifeinsurance@gmail.com';
    $mail->Password = 'jmtn vtvn agkw cnhd';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('southernjadelifeinsurance@gmail.com');
    $mail->addAddress($email);//
    $mail->Subject = $subject;//
    $mail->msgHTML($message);//
    
    if($mail->send()){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">
            Email Notification Sent 
            </h3>
            <p>
            <a href='byb.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
            </p>
        </div>
        </div>
        <?php
        
    }else{
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -error js_error-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">
            Error 
            </h1>
            <p>Something Goes Wrong.....</p>
            <p>
                <a href="byb.php"><button class="button button--error" data-for="js_error-popup">close</button></a>
            </p>
        </div>
        </div>
        <?php
    }
}

function sendRegistration($email,$message)
{
    $subject = "Exclusive Offer for BYB Attendees";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'southernjadelifeinsurance@gmail.com';
    $mail->Password = 'jmtn vtvn agkw cnhd';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('southernjadelifeinsurance@gmail.com');
    $mail->addAddress($email);//
    $mail->Subject = $subject;//
    $mail->msgHTML($message);//
    
    if($mail->send()){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">
            Mass Email Sent! 
            </h3>
            <p>
            <a href='byb.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
            </p>
        </div>
        </div>
        <?php
        
    }else{
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -error js_error-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">
            Error 
            </h1>
            <p>Something Goes Wrong.....</p>
            <p>
                <a href="byb.php"><button class="button button--error" data-for="js_error-popup">close</button></a>
            </p>
        </div>
        </div>
        <?php
    }
}

function forgotPassword($email,$message)
{
    $subject = "Applicant Forgot Password";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'southernjadelifeinsurance@gmail.com';
    $mail->Password = 'jmtn vtvn agkw cnhd';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('southernjadelifeinsurance@gmail.com');
    $mail->addAddress($email);//
    $mail->Subject = $subject;//
    $mail->msgHTML($message);//
    
    if($mail->send()){
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -success js_success-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">
            Instructions Sent!
            </h3>
            <p>We have sent instructions to change your password to <?=$email?>. Please check both your inbox and spam folder.</p>
            <p>
            <a href='../../../../all/homepage.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
            </p>
        </div>
        </div>
        <?php
        
    }else{
        ?>
        <link rel="stylesheet" href="../../../../registration/popup_style.css">
        <div class="popup popup--icon -error js_error-popup popup--visible">
        <div class="popup__background"></div>
        <div class="popup__content">
            <h3 class="popup__content__title">
            Error 
            </h1>
            <p>Something Goes Wrong.....</p>
            <p>
                <a href="../../../../all/homepage.php"><button class="button button--error" data-for="js_error-popup">close</button></a>
            </p>
        </div>
        </div>
        <?php
    }
}
function bybpreregister($email,$message)
{
    $subject = "BYB Event Pre-Registration";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'southernjadelifeinsurance@gmail.com';
    $mail->Password = 'jmtn vtvn agkw cnhd';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('southernjadelifeinsurance@gmail.com');
    $mail->addAddress($email);//
    $mail->Subject = $subject;//
    $mail->msgHTML($message);//
    $mail->send();
}
function verify($email)
{
    if(isset($_POST['submit'])){
        $rand = rand(1, 999999);
        $_SESSION['vericode'] = $rand;
        $_SESSION['expiry'] = time() + 3600;
        $vericode = $_SESSION['vericode'];
    
        $subject = "Email Verification";
        $message = "We'll need you to verify your email before you can proceed to the registration form.<br>
                    Your verification code: <b>".$vericode."</b>. <br>
                    This code lasts for 1 hour before it expires.";
    
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'southernjadelifeinsurance@gmail.com';
        $mail->Password = 'jmtn vtvn agkw cnhd';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom('southernjadelifeinsurance@gmail.com');
        $mail->addAddress($email);//
        $mail->Subject = $subject;//
        $mail->msgHTML($message);//
        
        if($mail->send()){
          ?>
          <link rel="stylesheet" href="../../../../registration/popup_style.css">
          <div class="popup popup--icon -success js_success-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
              <h3 class="popup__content__title">
                Email Veification Code Sent 
              </h3>
              <p>Please Check your Email for the verification code.</p>
              <p>
                <a href='verify.php?email=<?php echo $email?>'><button class="button button--success" data-for="js_success-popup">OK</button></a>
              </p>
            </div>
          </div>
          <?php
          
        }else{
          ?>
          <link rel="stylesheet" href="../../../../registration/popup_style.css">
          <div class="popup popup--icon -error js_error-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
              <h3 class="popup__content__title">
                Error 
              </h1>
              <p>Something Goes Wrong.....</p>
              <p>
                  <a href="index.php"><button class="button button--error" data-for="js_error-popup">close</button></a>
              </p>
            </div>
          </div>
          <?php
        }
    }
}//end of mailGuest Function

?>

