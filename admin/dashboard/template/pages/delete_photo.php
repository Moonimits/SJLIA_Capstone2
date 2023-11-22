<?php
include('../../../../dbcon.php');
$delid = $_GET['delid'];
$deletion = $_GET['deletion'];

if($deletion == 2){
    $sql = "SELECT * FROM exam_gallery WHERE photo_id = '$delid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    unlink('exam_photo/'.$row['photo']);

    $sql = "DELETE FROM exam_gallery WHERE photo_id = '$delid'";
    $result = mysqli_query($conn ,$sql);
    if($result){
        header('Location:exam.php?delmsg=Image Successfully Deleted!');
    }
}elseif($deletion == 1){
    $sql = "SELECT * FROM exam_gallery WHERE post_id = '$delid'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        unlink('exam_photo/'.$row['photo']);
    }
    
    $sql = "DELETE FROM exam_gallery WHERE post_id = '$delid'";
    $result = mysqli_query($conn ,$sql);
    $sql = "DELETE FROM exam WHERE post_id = '$delid'";
    $result = mysqli_query($conn ,$sql);
    if($result){
        header('Location:exam.php?delmsg=Exam Schedule Successfully Deleted!');
    }
}
?>