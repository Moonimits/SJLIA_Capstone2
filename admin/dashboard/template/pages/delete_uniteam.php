<?php
include('../../../../dbcon.php');
$delid = $_GET['delid'];

//delete all attendees first
$delsql = "DELETE FROM unit_team WHERE team_id  = '$delid'";
$delresult = mysqli_query($conn, $delsql);

if($delresult){
    header('Location: applicant_list.php?delmsg=Unit Team Deleted!');
}
?>