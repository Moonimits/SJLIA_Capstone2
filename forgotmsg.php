<?php
include("dbcon.php");
include("admin/dashboard/template/pages/email.php");
$email = $_GET['email'];
    
$sql = "SELECT application_id FROM applicantdb WHERE Email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$token = $row['application_id'];
$msg = "Hello,<br>
        <br>
        You've requested a password reset. To reset your password, click on the link below:<br>
        <a href='http://localhost:3000/all/forgotpassword.php?token=$token'>Reset Password</a><br>
        If you didn't request this password reset, please ignore this email.
        Thank you.
        ";    

forgotPassword($email,$msg);

?>