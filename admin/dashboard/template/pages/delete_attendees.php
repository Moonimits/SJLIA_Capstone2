<?php
include('../../../../dbcon.php');
$delid = $_GET['delid'];
$bybid = $_GET['bybid'];

$delsql = "DELETE FROM bybattendees WHERE attendee_num = '$delid'";
$delresult = mysqli_query($conn, $delsql);

if($delresult){
    header('Location: add_attendees.php?delmsg=Attendee Successfully deleted!&byb_id='.$bybid.'');
}
?>