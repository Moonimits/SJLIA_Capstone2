<?php
session_start();

if(isset($_SESSION['admin_id']) && isset($_SESSION['admin_type']) && $_SESSION['admin_type'] == 0){
    header('Location: dashboard.php');
}elseif(isset($_SESSION['admin_id']) && isset($_SESSION['admin_type']) && $_SESSION['admin_type'] == 1){
    header('Location: superdashboard.php');
}

include("../../../dbcon.php");
$error = '';

if(isset($_POST["submit"])){
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if($row){
        if(password_verify($password, $row['password']) && $row['admin_type'] == 0){
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_type'] = $row['admin_type'];
            
            ?>
            <link rel="stylesheet" href="../../../registration/popup_style.css">
            <div class="popup popup--icon -success js_error-popup popup--visible">
                <div class="popup__background"></div>
                <div class="popup__content">
                <h3 class="popup__content__title">
                    Login Successful 
                </h3>
                <p>
                    <a href="dashboard.php"><button class="button button--success" data-for="js_success-popup">close</button></a>
                </p>
                </div>
            </div>
            <?php
        }elseif(password_verify($password, $row['password']) && $row['admin_type'] == 1){
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_type'] = $row['admin_type'];
            
            ?>
            <link rel="stylesheet" href="../../../registration/popup_style.css">
            <div class="popup popup--icon -success js_error-popup popup--visible">
                <div class="popup__background"></div>
                <div class="popup__content">
                <h3 class="popup__content__title">
                    Login Successful 
                </h3>
                <p>
                    <a href="superdashboard.php"><button class="button button--success" data-for="js_success-popup">close</button></a>
                </p>
                </div>
            </div>
            <?php
        }else{
            $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Wrong Password!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    }
    else
    {
        $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                This email has not been registered!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="images/logajade.png" type="image/x-icon">
  <title>Southern Jade Life Insurance</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />

    <link href="css/homepage.css" rel="stylesheet" />

    <style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');

body {
  position: relative; /* Required for the ::before pseudo-element */
  background-image: url("../../../all/images/bldg.jpg");
  background-size: cover;
}

body::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5); /* This sets the overlay background color with 50% opacity */
  z-index: -1; /* Place the overlay behind other content */
}
    </style>
<nav class="navbar bg-body-tertiary shadow-none">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <img src="images/logo-topnav.png" alt="Logo" width="290" height="55" class="d-inline-block align-text-top">
    </div>
</nav>

</head>

<body>
    <div class="container mt-5 h">
        <div class="row justify-content-center">
            
            <div class="col-md-5 ms-0">
                <div class="card ms-3 mt-3" style="width: 90%; background: linear-gradient(180deg, rgba(255, 255, 255, .4), #01395f);
box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="login" role="tabpanel"
                                aria-labelledby="tab-login">
                                <!-- loginForm -->
                                <div class="text-center mb-3">
                                    <div class="container">
                                        <img src="../../../all/images/logo.png" alt="" class="img-fluid rounded">
                                    </div>
                                </div>

                                <form method="post">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10 text-center">
                                            <?php
                                            echo $error;
                                            ?>
                                            <div class="form-outline mb-4">
                                                <input type="text" name="username" id="loginName" class="form-control text-white"
                                                value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required />
                                                <label class="form-label text-white" for="loginName">Username</label>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="password" name="password" id="loginPassword"
                                                    class="form-control text-white" required />
                                                <label class="form-label text-white" for="loginPassword">Password</label>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary mb-4 w-50">Log In</button>
                                            </div>

                                            <!-- Register buttons -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>
