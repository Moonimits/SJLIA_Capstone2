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
    $mail->Username = 'marcxperrez@gmail.com';
    $mail->Password = 'gdphpcefmdnvjhsd';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('marcxperrez@gmail.com');
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


function cancellation($email,$message)
{
        $subject = "Reservation Cancellation";
    
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'marcxperrez@gmail.com';
        $mail->Password = 'gdphpcefmdnvjhsd';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom('marcxperrez@gmail.com');
        $mail->addAddress($email);//
        $mail->Subject = $subject;//
        $mail->msgHTML($message);//
        
        if($mail->send()){
            ?>
            <link rel="stylesheet" href="../../../../popup_style.css">
            <div class="popup popup--icon -success js_success-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                Cancellation Message Sent 
                </h3>
                <p>
                <a href='../reservation.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
                </p>
            </div>
            </div>
            <?php
            
        }else{
            ?>
            <link rel="stylesheet" href="../../../../popup_style.css">
            <div class="popup popup--icon -error js_error-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                Error 
                </h1>
                <p>Something Goes Wrong.....</p>
                <p>
                    <a href="../reservation.php"><button class="button button--error" data-for="js_error-popup">close</button></a>
                </p>
            </div>
            </div>
            <?php
        }
    }
?>

