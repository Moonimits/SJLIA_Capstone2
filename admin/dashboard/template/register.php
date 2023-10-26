<?php
include("../../../dbcon.php");
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $pass = $_POST['password'];
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin(username,password) VALUES ('$name','$hash')";
    $result = mysqli_query($conn,$sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="text" name="name" placeholder="name">
        <input type="text" name="password" placeholder="password">
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>