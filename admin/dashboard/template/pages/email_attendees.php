<?php
include('../../../../dbcon.php');
include('email.php');

$massemail = "SELECT email, fullname FROM bybpreregistration";
$massresult = mysqli_query($conn,$massemail);
if(mysqli_num_rows($massresult)>0){
    while($massrow = mysqli_fetch_assoc($massresult)){
        $fullname = explode(' ' ,$massrow['fullname']);
        $lastname = array_pop($fullname);
        $email = $massrow['email'];
        $msg = "
        Dear $lastname, <br>
        <br>

        As a participant in the recent BYB event, we are excited to extend an exclusive opportunity to you. Join Southern Jade Life Insurance Agency now for financial security. Click on this link to: <a href='http://localhost:3000/registration/index.php'>register now</a><br><br>
        
        If you are already registered, kindly disregard this message.<br><br>
        
        Best regards,<br>
        Juan Dela Cruz<br>
        Southern Jade Life Insurance Agency<br><br>
        <img style='height: 200px; width: 200px' src='https://www.prulifeuk.com.ph/export/sites/prudential-ph/en/.galleries/images/pru-life-uk-logo.jpg'>
        ";
        
        sendRegistration($email,$msg);
    }
}

