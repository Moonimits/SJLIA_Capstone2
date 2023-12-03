<?php
include('../../../../dbcon.php');
$delid = $_GET['delid'];

//delete all attendees first
$delsql = "DELETE FROM feedback WHERE feedback_id  = '$delid'";
$delresult = mysqli_query($conn, $delsql);

if($delresult){
    header('Location: feedback.php?delmsg=Feedback Deleted!');
}
?>