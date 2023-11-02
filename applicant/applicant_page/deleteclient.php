<?php
$delid = $_GET['delid'];
include('../../dbcon.php');

$sql = "DELETE FROM clients WHERE client_id = '$delid'";
$result = mysqli_query($conn, $sql);
if($result){
    header('Location: index.php?msg=<div class="alert alert-success alert-dismissible fade show" role="alert">Client Successfully Deleted!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
}
?>
