<?php
session_start();

$error='';

if(isset($_POST['verify'])){
    $verifyinput = $_POST['verificationcode'];

  if(isset($_SESSION['vericode'])&& time() <= $_SESSION['expiry']){
    if($verifyinput == $_SESSION['vericode']){
      
      unset($_SESSION['vericode']);
      unset($_SESSION['expiry']);
      $_SESSION['verified'] = 1;

      ?>
          <link rel="stylesheet" href="registration/popup_style.css">
          <div class="popup popup--icon -success js_success-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
              <h3 class="popup__content__title">
                Verification Success 
              </h3>
              <p>You can now register an account!</p>
              <p>
                <a href='registration/index.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
              </p>
            </div>
          </div>
          <?php
    }else{
      $error = '
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
      Wrong Verification Code!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      ';
    }
  }else{
    unset($_SESSION['vericode']);
    unset($_SESSION['expiry']);
    $error = '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    Verification code has expired
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
  }
}
?>

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

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');

body {
  position: relative; /* Required for the ::before pseudo-element */
  background-image: url("images/bldg.jpg");
  background-size: cover;
  min-height: 100vh; 
}

body::before {
  content: "";
  position: absolute;
  height: 100vh; /* Use viewport height for full coverage */
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
        
    </div>
</nav>

</head>

<body>
    <div class="container mt-3 h">
        <div class="row justify-content-center text-center">
            
            <div class="col-md-5 ms-0">
                <div class="text-center mb-1">
                    <div class="container">
                        <img src="images/logo.png" alt="" class="img-fluid rounded">
                    </div>
                </div>
                <div class="card ms-3 " >

                    <div class="card-body">
                        <h1 class="text-dark"><strong>Email Verification</strong></h1>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="verificationCode" class="form-label">Enter Verification Code</label>
                                <?php
                                echo $error;
                                ?>
                                <input type="number" placeholder="Input Verification Code" class="form-control" id="verificationCode" name="verificationcode" required autocomplete="off">
                            </div>
                            <button type="submit" name="verify" class="btn btn-primary">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>
