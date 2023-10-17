<?php
include('../../../../dbcon.php');
$delid = $_GET['delid'];

//delete all attendees first
$delsql = "DELETE FROM bybattendees WHERE byb_id  = '$delid'";
$delresult = mysqli_query($conn, $delsql);
//delete the event
$delsql = "DELETE FROM bybevents WHERE byb_id = '$delid'";
$delresult = mysqli_query($conn, $delsql);

if($delresult){
    header('Location: byb.php?delmsg=BYB Event Successfully deleted!');
}
?>