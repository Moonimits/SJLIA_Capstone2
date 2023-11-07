<?php
session_start();
include("dbcon.php");

$error = '';
if(isset($_POST['submit'])){
    $fullname = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_SPECIAL_CHARS);
    $recruite = filter_input(INPUT_POST, "recruite", FILTER_SANITIZE_SPECIAL_CHARS);
    $bybdate = filter_input(INPUT_POST, "bybdate", FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sql = "INSERT INTO bybpreregistration(fullname,email,contact,recruited_by,byb_date) VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt, 'sssss', $fullname,$email,$contact,$recruite,$bybdate);
    $result = mysqli_stmt_execute($stmt);

    if($result){
        ?>
        <link rel="stylesheet" href="registration/popup_style.css">
        <div class="popup popup--icon -success js_error-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
            <h3 class="popup__content__title">
               Pre Registration Submitted
            </h3>
            <p>You can now close this window</p>
            <p>
                <a href="applicant/applicant_page/index.php"><button class="button button--success" data-for="js_success-popup">close</button></a>
            </p>
            </div>
        </div>
        <?php
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
                                <h1 class="text-dark"><strong>BYB Event</strong></h1>
                                <h4 class="text-dark mb-0"><strong>Pre-Registration</strong></h4>
                                <p class="text-dark mb-3">- Please check all your inputted information before submitting -</p>
                                <!-- loginForm -->

                                <form method="post">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10 text-center">
                                            <?php
                                            echo $error;
                                            ?>
                                            <div class="form-outline mb-4">
                                                <input type="name" name="name" id="fullname" class="form-control"
                                                value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required />
                                                <label class="form-label" for="fullname">Fullname</label>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="email" name="email" id="useremail" class="form-control"
                                                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required />
                                                <label class="form-label" for="useremail">Email</label>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="number" name="contact" id="contact_no"
                                                value="<?php echo isset($_POST['contact']) ? htmlspecialchars($_POST['contact']) : ''; ?>"    class="form-control" required />
                                                <label class="form-label" for="contact_no">Contact</label>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="text" name="recruite" id="recruite"
                                                value="<?php echo isset($_POST['recruite']) ? htmlspecialchars($_POST['recruite']) : ''; ?>"    class="form-control" required />
                                                <label class="form-label" for="recruite">Recruited By</label>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="date" name="bybdate" id="bybdate"
                                                value="<?php echo isset($_POST['bybdate']) ? htmlspecialchars($_POST['bybdate']) : ''; ?>"    class="form-control" required />
                                                <label class="form-label" for="bybdate">BYB Event Date</label>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary mb-4 w-50">Submit</button>
                                            </div>

                                            <!-- Register buttons -->
                                            <div class="text-center">
                                                <?php
                                                if(isset($_POST['email'])){
                                                    ?>
                                                    <a href="forgotmsg.php?email=<?=$_POST['email']?>">Forgot Password?</a>
                                                    <?php
                                                }
                                                ?>
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
