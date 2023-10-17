<?php
session_start();
include("../dbcon.php");

$error='';
$crslerror = '';


  if(isset($_POST['submit']))
  {
      $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
      $middlename = filter_input(INPUT_POST, "middlename", FILTER_SANITIZE_SPECIAL_CHARS); 
      $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
      $male = filter_input(INPUT_POST, "male", FILTER_SANITIZE_SPECIAL_CHARS);
      $female = filter_input(INPUT_POST, "female", FILTER_SANITIZE_SPECIAL_CHARS);
      $birthday = filter_input(INPUT_POST, "birthday", FILTER_SANITIZE_SPECIAL_CHARS);
      $birthplace = filter_input(INPUT_POST, "birthplace", FILTER_SANITIZE_SPECIAL_CHARS);
      $sss = filter_input(INPUT_POST, "sss", FILTER_SANITIZE_SPECIAL_CHARS);
      $tin = filter_input(INPUT_POST, "tin", FILTER_SANITIZE_SPECIAL_CHARS);
      
      $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
      $cpassword = filter_input(INPUT_POST, "cpassword", FILTER_SANITIZE_SPECIAL_CHARS);
      $contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_SPECIAL_CHARS);
      $zip = filter_input(INPUT_POST, "zip", FILTER_SANITIZE_SPECIAL_CHARS);
      $region = filter_input(INPUT_POST, "region", FILTER_SANITIZE_SPECIAL_CHARS);
      $province = filter_input(INPUT_POST, "province", FILTER_SANITIZE_SPECIAL_CHARS);
      $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_SPECIAL_CHARS);
      $barangay = filter_input(INPUT_POST, "barangay", FILTER_SANITIZE_SPECIAL_CHARS);
      $lot = filter_input(INPUT_POST, "lot", FILTER_SANITIZE_SPECIAL_CHARS);
      $agentname = filter_input(INPUT_POST, "agentname", FILTER_SANITIZE_SPECIAL_CHARS);
      $agentcode = filter_input(INPUT_POST, "agentcode", FILTER_SANITIZE_SPECIAL_CHARS);
      $efirst = filter_input(INPUT_POST, "efirst", FILTER_SANITIZE_SPECIAL_CHARS);
      $emiddle = filter_input(INPUT_POST, "emiddle", FILTER_SANITIZE_SPECIAL_CHARS);
      $elast = filter_input(INPUT_POST, "elast", FILTER_SANITIZE_SPECIAL_CHARS);
      $rel = filter_input(INPUT_POST, "rel", FILTER_SANITIZE_SPECIAL_CHARS);
      $econtact = filter_input(INPUT_POST, "econtact", FILTER_SANITIZE_SPECIAL_CHARS);
      $eaddress = filter_input(INPUT_POST, "eaddress", FILTER_SANITIZE_SPECIAL_CHARS);
  
      $upload = filter_input(INPUT_POST, "upload", FILTER_SANITIZE_SPECIAL_CHARS);
      
      $fileName = $_FILES["dp"]["name"];
      $fileSize = $_FILES["dp"]["size"];
      $tmpName = $_FILES["dp"]["tmp_name"];
      
      if(!empty($fileName)){
          $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
          $imageExtension = strtolower($imageExtension);
          $validExtension = ['jpg','jpeg','png'];
      
          if(!in_array($imageExtension, $validExtension))
          {
            $crlserror = '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Invalid image extension!
              <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
          }
          elseif($fileSize > 5000000)
          {
            $crslerror ='
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Image size is too large!
              <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
          }
          else
          {
                  
            $newImageName = uniqid() . '.' . $imageExtension;
            
      
          }
      }else{
        $crslerror ='
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            You need to Input a Photo!
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
      }

      //gender
      $gender = '';
      if(isset($_POST['gender']) == "male"){
          $male = $_POST['gender'];
          $gender = $male;
      }elseif(isset($_POST['gender']) == "female"){
          $female = $_POST['gender'];
          $gender = $female;
      }
      //yan parang ganan mangyayari
  
      //civil status
      $civilstatus = '';
      $spouse = 'N/A';
      $maiden = 'N/A';
      if(isset($_POST['civil']) == "single"){
          $single = $_POST['civil'];
          $civilstatus = $single;
      }elseif(isset($_POST['civil']) == "married"){
          $married = $_POST['civil'];
          $civilstatus = $married;
          $spouse = filter_input(INPUT_POST, "spouse", FILTER_SANITIZE_SPECIAL_CHARS);
          $maiden = filter_input(INPUT_POST, "maiden", FILTER_SANITIZE_SPECIAL_CHARS);
      }elseif(isset($_POST['civil']) == "widow"){
          $widow = $_POST['civil'];
          $civilstatus = $widow;
      }
  
      //gove
      $gov_emp = '';
      $companyname = 'N/A';
      $position = 'N/A';
      if(isset($_POST['gov']) == "yes"){
          $gov_emp = $_POST['gov'];
          $companyname = filter_input(INPUT_POST, "companyname", FILTER_SANITIZE_SPECIAL_CHARS);
          $position = filter_input(INPUT_POST, "position", FILTER_SANITIZE_SPECIAL_CHARS);
      }elseif(isset($_POST['gov']) == "no"){
          $gov_emp = $_POST['gov'];
      }
  
  
      $sql = "SELECT * FROM applicantdb WHERE email = '$email'";
      $result = mysqli_query($conn, $sql); 
  
      if(mysqli_num_rows($result)>0){//so if meron result, may error na email has been taken
          $error = 
          '
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
          Email has already been taken!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          ';
      }elseif($password != $cpassword){//so if meron result, may error na email has been taken
        $error = 
        '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Confirm password mismatch!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
      }
      else
      {
          $uploadDir = '../applicant/applicant_page/profile_img/' . $newImageName;      
          move_uploaded_file($tmpName, $uploadDir);

          $sql = "INSERT INTO `applicantdb`(`Email`, `Lastname`, `Firstname`, `Middlename`, 
          `birthdate`, `birthplace`, `gender`, `civil_status`, `contact_number`, `streetname`, `barangay`, `city`, `province`,
           `zip`, `sss`, `tin`, `password`, `recruiter_name`,`e_last`, `e_first`, `e_middle`, `applicant_rel`,
            `agent_contact`, `agent_address`, `company_name`, `position`, `if_maiden`, `gov_employ`,
             `if_spouse`,`profile_pic`)
          VALUES ('$email','$lastname', '$firstname','$middlename','$birthday','$birthplace','$gender',
          '$civilstatus','$contact','$lot','$barangay','$city','$province','$zip','$sss','$tin','$password','$agentname',
          '$elast','$efirst','$emiddle','$rel','$econtact','$eaddress','$companyname','$position','$maiden',
          '$gov_emp','$spouse','$newImageName')";
          $result = mysqli_query($conn, $sql);
  
          $docusql = "INSERT INTO documents (sss,tin,gov_id,1x1) VALUES ('','','','')";
          $docusql = mysqli_query($conn, $docusql);
          
          if($result){
            ?>
            <link rel="stylesheet" href="popup_style.css">
            <div class="popup popup--icon -success js_success-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Registration Success 
                </h3>
                
                <p>
                  <a href='index.php'><button class="button button--success" data-for="js_success-popup">OK</button></a>
                </p>
              </div>
            </div>
            <?php
          }else{
            ?>
            <link rel="stylesheet" href="popup_style.css">
            <div class="popup popup--icon -error js_error-popup popup--visible">
              <div class="popup__background"></div>
              <div class="popup__content">
                <h3 class="popup__content__title">
                  Registration Failed 
                </h3>
                <p>Something went wrong</p>
                
                <p>
                  <a href='index.php'><button class="button button--success" data-for="js_error-popup">OK</button></a>
                </p>
              </div>
            </div>
            <?php
          }
      }
  }
  
?>

<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Southern Jade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>
    <div class="container form-container">
      <div class=" col-lg-12 mx-auto login-container">
          <div class="row form-header">
              <div class="col-md-2 logocol">
                <img src="assets/images/logajade.png" alt="">
              </div>
              <div class="col-md-10 headcol">
                <h4>Pru Life U.K Southern Jade Life Insurance </h4>
                <p>Lorem ipsum lorem ipsum Lorem ipsum lorem ipsum Lorem ipsum lorem ipsum</p>
                <p class="cinfo">
                    <span><i class="fas fa-phone"></i> +91 987 676 5459</span>
                    <span><i class="fas fa-envelope"></i> adarsvidyakendra@gmail.com</span>
                    <span><i class="fas fa-map-marker-alt"></i> Smart City, Toranto, Canada</span>
                </p>
               
              </div>
          </div>
          <div class="form-body">
            <form method="post" enctype="multipart/form-data">

            <div class="form-title row">
              <h4>Set Profile Picture</h4>
              <?= $crslerror;?>
            </div>

          <div class="form-row row">
              <div class="col-lg-2">
                  <img id="blah" class="rounded" src="#" alt="your image" class="img-responsive rounded" 
                  style="height: 200px; width: 190px; object-fit: cover;">
                  <label class="btn btn-primary ms-2 mt-2" style="width: 4.6cm;" > Set Profile<input type="file" id="imgInp" name='dp' hidden></label>
              </div>
                 <div class="col-lg-4 col-md-8">
                    <div class="caution">
                      <strong>Caution:</strong> Please follow these instructions carefully.
                      <!-- Add your caution message here -->
                    </div>
                </div>
          </div>
            
                              
            <div class="form-title row">
              <h4>Applicant Information</h4>
              <?php echo $error;?>
            </div>

            <div class="form-row row">
              <div class="col-lg-2 col-md-4">
                <label for="">First Name</label>
                <sup class="req">*</sup>
                <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="firstname" placeholder="Enter First Name" class="form-control form-control-sm">
              </div>
              <div class="col-lg-2 col-md-4">
                <label for="">Middle Name </label>
                <sup class="req">*</sup>
                <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="middlename" placeholder="Enter Middle Name" class="form-control form-control-sm">
              </div>
            </div>

          <div class="form-row row">
              <div class="col-lg-2 col-md-4">
                <label for="">Last Name</label>
                <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="lastname" placeholder="Enter Last Name" class="form-control form-control-sm">
              </div>
              <div class="col-lg-2 col-md-4">
                <label for="">Gender</label>
                 <sup class="req">*</sup>
                  <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8 pt-1">
                <input type="radio" name="gender" value="male"> Male &nbsp;&nbsp; 
                <input type="radio" name="gender" value="female"> Female &nbsp;&nbsp; 
              </div>
          </div>

                 
            
          

            <div class="form-row row">
               <div class="col-lg-2 col-md-4">
                <label for="">Date of Birth</label>
                 <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="date" name="birthday" placeholder="Enter Date of Birth" class="form-control form-control-sm">
              </div>


                <div class="col-lg-2 col-md-4">
                 <label for="">Birth Place</label>
                  <sup class="req">*</sup>
                  <span class="indc">:</span>
               </div>
               <div class="col-lg-4 col-md-8">
                 <input type="text" name="birthplace" placeholder="Enter Date of Birth" class="form-control form-control-sm">
               </div>
            </div>
            <div class="form-row row">
              <div class="col-lg-2 col-md-4">
                <label for="">SSS Number</label>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="sss" placeholder="Enter SSS Number" class="form-control form-control-sm">
              </div>

              <div class="col-lg-2 col-md-4">
                <label for="">TIN Number</label>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="tin" placeholder="Enter TIN Number" class="form-control form-control-sm">
              </div>
            </div>

           

            <div class="form-row row">
              <div class="col-lg-2 col-md-4" id="civilstatus">
                <label for="">Civil Status</label>
                 <sup class="req">*</sup>
                  <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8 pt-1">
                <input type="radio" name="civil" value="single" id="singleRadio" > Single &nbsp;&nbsp;
                <input type="radio" name="civil" value="married" id="marriedRadio" > Married &nbsp;&nbsp;
                <input type="radio" name="civil" value="widow" id="widowRadio" > Widow 
              </div>
            </div>

                
            <div class="form-row row" id="married"> 
             
                <div class="col-lg-2 col-md-4">
                  <label for="">Spouse Fullname</label>
                  <sup class="req">*</sup>
                  <span class="indc">:</span>
                </div>
                <div class="col-lg-4 col-md-8">
                  <input type="text" name="spouse" placeholder="Enter Spouse Complete Name" class="form-control form-control-sm">
                </div>

                <div class="col-lg-2 col-md-4">
                  <label for="">Maiden Name</label>
                  <sup class="req">*</sup>
                  <span class="indc">:</span>
                </div>
                <div class="col-lg-4 col-md-8">
                  <input type="text" name="maiden" placeholder="Enter Maiden Name" class="form-control form-control-sm">
                </div>
            </div>

            <div class="form-title row">
              <h4>Contact Information</h4>
            </div>

            <div class="form-row row">
                <div class="col-lg-2 col-md-4">
                <label for="">Contact Number</label>
                 <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="contact" placeholder="Enter Mobile Numbber" class="form-control form-control-sm">
              </div>

              <div class="col-lg-2 col-md-4">
                <label for="">ZIP Code</label>
                <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="zip" placeholder="Enter Zip Code" class="form-control form-control-sm">
              </div>
            </div>
            
        <div class="form-row row">
          <div class="col-md-4 mb-3">
              <label class="form-label">Region <sup class="req">*</sup> </label>
              <select class="form-control form-control-sm" id="region"></select>
              <input type="hidden" class="form-control form-control-sm" name="region" id="region-text" required>
          </div>
          <div class="col-md-4 mb-3">
              <label class="form-label">Province <sup class="req">*</sup> </label>
              <select class="form-control form-control-sm" id="province"></select>
              <input type="hidden" class="form-control form-control-sm" name="province" id="province-text" required>
          </div>
          <div class="col-md-4 mb-3">
              <label class="form-label">City / Municipality <sup class="req">*</sup> </label>
              <select class="form-control form-control-sm" id="city"></select>
              <input type="hidden" class="form-control form-control-sm" name="city" id="city-text" required>
          </div>
        </div>
        <div class="form-row row">
          <div class="col-md-1 mb-3">
              <label class="form-label">Barangay:<sup class="req">*</sup></label>
          </div>
          <div class="col-md-4">
            <select class="form-control form-control-sm" id="barangay"></select>
            <input type="hidden" class="form-control form-control-sm" name="barangay" id="barangay-text" required>
          </div>
  
          <div class="col-lg-3 col-md-0">
            <label for="">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lot Number/Street Name:</label>
            <sup class="req">*</sup>
          </div>
          <div class="col-lg-4 col-md-8 pt-1">
            <input type="text" class="form-control form-control-sm" name="lot" id="lot" required>
          </div>
        </div>
               
        <div class="form-title row">
              <h4>Recruiter Information</h4>
            </div>

            <div class="form-row row">
              <div class="col-lg-2 col-md-4">
                <label for="">Agent Fullname</label>
                <sup class="req">*</sup>
                <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="agentname" placeholder="Enter Agent Fullname" class="form-control form-control-sm">
              </div>
            
              
              <div class="col-lg-2 col-md-4">
                <label for="">Agent's Code</label>
                <sup class="req">*</sup>
                <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="agentcode" placeholder="Enter Agent's Code" class="form-control form-control-sm">
              </div>

             <div class="form-title row">
              <h4>Incase of Emergency</h4>
            </div>


            <div class="form-row row">
              <div class="col-lg-2 col-md-4">
                <label for="">First Name</label>
                <sup class="req">*</sup>
                <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="efirst" placeholder="Enter First Name" class="form-control form-control-sm">
              </div>
              <div class="col-lg-2 col-md-4">
                <label for="">Middle Name </label>
                <sup class="req">*</sup>
                <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="emiddle" placeholder="Enter Middle Name" class="form-control form-control-sm">
              </div>
            </div>

          <div class="form-row row">
              <div class="col-lg-2 col-md-4">
                <label for="">Last Name</label>
                <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="elast" placeholder="Enter Last Name" class="form-control form-control-sm">
              </div>
              <div class="col-lg-2 col-md-4">
                <label for="">Relationship</label>
                <sup class="req">*</sup>
                <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="rel" placeholder="Enter Relationship to Applicant" class="form-control form-control-sm">
              </div>
            </div>
              
             <div class="form-row row">
                <div class="col-lg-2 col-md-4">
                <label for="">Contact Number</label>
                 <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="econtact" placeholder="Enter Contact Numbber" class="form-control form-control-sm">
              </div>
               <div class="col-lg-2 col-md-4">
                <label for=""> Address</label>
                 <sup class="req">*</sup>
                  <span class="indc">:</span>
              </div>
               <div class="col-lg-4 col-md-8">
                <input type="text" name="eaddress" placeholder="Enter Address" class="form-control form-control-sm">
              </div>
            </div>

                   
            <div class="form-title row">
              <h4>Employment History</h4>
            </div>
            <div class="form-row row">
              <div class="col-lg-3 col-md-0">
                <label for="">Are you a Government Employee?<sup class="req">*</sup></label>
              </div>
              <div class="col-lg-2 col-md-8">
                <input type="radio" name="gov" value="yes" id="govyesRadio"> Yes &nbsp;&nbsp;
                <input type="radio" name="gov" value="no" id="govnoRadio"> No
              </div>
              <div class="col-lg-2" id="govUploadLabel">
                <label for="formFile" class="form-label">Upload Certificate</label>
                <span class="indc">:</span>
              </div>
              <div class="col-lg-4" id="govUpload">
                <input class="form-control" name="upload" type="file" id="formFile">
              </div>
            </div>

            <div class="form-row row" id="govForm">
                <div class="col-lg-2 col-md-4">
                <label for="">Company Name </label>
                 <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="companyname" placeholder="Enter Company Name " class="form-control form-control-sm" >
              </div>

              <div class="col-lg-2 col-md-4">
                <label for="">Employee's Position </label>
                 <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="text" name="position" placeholder="Enter your Position " class="form-control form-control-sm" >
              </div>
            </div>

            <div class="form-title row">
              <h4>Set Your Account</h4>
            </div>
            <div class="form-row row">
              <div class="col-lg-2 col-md-4">
                <label for="">Email Address</label>
                <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="email" name="email" placeholder="example@gmail.com" class="form-control form-control-sm">
              </div>
              <div class="col-lg-2 col-md-4">
                <label for="">Password </label>
                <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>
              <div class="col-lg-4 col-md-8">
                <input type="password" name="password" placeholder="Enter your password" class="form-control form-control-sm">
              </div>
            </div>

            <div class="form-row row">
              <div class="col-lg-2 col-md-4">
                <label for="">Confirm Password </label>
                <sup class="req">*</sup>
                 <span class="indc">:</span>
              </div>

              <div class="col-lg-4 col-md-8">
                <input type="password" name="cpassword" placeholder="Enter your password" class="form-control form-control-sm">
              </div>
            </div>

             <div class="form-row row justify-content-center">
               <div class="col-lg-2 col-md-8 text-center">
               <button type="submit" name="submit" class="btn btn-lg btn-primary">Submit Form</button>
              </div>
            </div>
          

          </div>
          </form>
      </div>
    </div> 

 <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="ph-address-selector.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      $(document).ready(function () {
          const marriedRadio = $('#marriedRadio');
          const widowRadio = $('#widowRadio');
          const marriedDiv = $('#married');
          const radioButtons = $('input[name="civil"]');

          const radioButtons2 = $('input[name="gov"]');
          const yesRadio = $('#govyesRadio');
          const uploadLabelDiv = $('#govUploadLabel');
          const uploadDiv = $('#govUpload');
          const govDiv = $('#govForm');

          marriedDiv.hide();
          uploadDiv.hide();
          uploadLabelDiv.hide();
          govDiv.hide();

          radioButtons.change(function () {
              if (marriedRadio.is(':checked')) {
                  marriedDiv.show();
              } else {
                  marriedDiv.hide();
              }
          });

          radioButtons2.change(function (){
              if(yesRadio.is(':checked')){
                uploadDiv.show();
                uploadLabelDiv.show();
                govDiv.show();
              }else{
                uploadDiv.hide();
                uploadLabelDiv.hide();
                govDiv.hide();
              }
          });
      });
  </script> 
  <script>
    $('#blah').attr('src', '../applicant/applicant_page/assets/images/profile.webp');
    function readURL(input) {

        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#imgInp").change(function() {
        readURL(this);
      });
      
      
  </script>
  </body>
  </html