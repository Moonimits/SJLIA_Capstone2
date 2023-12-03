<?php
session_start();
include("dbcon.php");
include("admin/dashboard/template/pages/email.php");

$error = '';
if(isset($_POST['submit'])){
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    verify($email);
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
        <div class="row justify-content-center">
            
            <div class="col-md-5 ms-0">
                <div class="text-center mb-1">
                    <div class="container">
                        <img src="images/logo.png" alt="" class="img-fluid rounded">
                    </div>
                </div>
                <div class="card ms-3 " >

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active text-center" id="login" role="tabpanel"
                                aria-labelledby="tab-login">
                                <h1 class="text-dark"><strong>Email Verificaiton</strong></h1>
                                <p class="text-dark mb-3">Please input your email to receive a verification code for entering the registration form</p>
                                <!-- loginForm -->

                                <form method="post">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10 text-center">
                                            <div class="form-outline mb-4">
                                                <input type="email" name="email" id="useremail" class="form-control"
                                                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required />
                                                <label class="form-label" for="useremail">Email</label>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary mb-4 w-50">Enter</button>
                                            </div>
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


    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>
