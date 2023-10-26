<?php
session_start();
unset($_SESSION['applicant_id']);
header('Location: ../../all/homepage.php');
?>