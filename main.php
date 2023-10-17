<?php
$req1 = 1;
$req2 = 1;
$req3 = 1;
$req4 = 1;

$step5 = '';

$completion = $req1 + $req2 + $req3 + $req4;

switch($completion){
   case 1:
      $step2 = 'current-item';
      break;
   case 2:
      $step3 = 'current-item';
      break;
   case 3:
      $step4 = 'current-item';
      break;
   case 4:
      $step5 = 'Completed';
      break;
   default:
      $step1 = 'current-item';
      break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> <!-- Include your CSS file here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Delivery Progress</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
      <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
         }
         body {
            font-family: "Poppins", sans-serif;
         }

         .step-wizard-list{
            background: #fff;
            box-shadow: 0 15px 25px rgba(0,0,0,0.1);
            color: #333;
            list-style-type: none;
            border-radius: 10px;
            display: flex;
            padding: 20px 10px;
            position: relative;
            z-index: 10;
         }

         .step-wizard-item{
            padding: 0 20px;
            flex-basis: 0;
            -webkit-box-flex: 1;
            -ms-flex-positive:1;
            flex-grow: 1;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
            min-width: 170px;
            position: relative;
         }
         .step-wizard-item + .step-wizard-item:after{
            content: "";
            position: absolute;
            left: 0;
            top: 19px;
            background: #21d4fd;
            width: 100%;
            height: 2px;
            transform: translateX(-50%);
            z-index: -10;
         }
         .progress-count{
            height: 40px;
            width:40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
            margin: 0 auto;
            position: relative;
            z-index:10;
            color: transparent;
         }
         .progress-count:after{
            content: "";
            height: 40px;
            width: 40px;
            background: #21d4fd;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: -10;
         }
         .progress-count:before{
            content: "";
            height: 10px;
            width: 20px;
            border-left: 3px solid #fff;
            border-bottom: 3px solid #fff;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -60%) rotate(-45deg);
            transform-origin: center center;
         }
         .progress-label{
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
         }
         .current-item .progress-count:before,
         .current-item ~ .step-wizard-item .progress-count:before{
            display: none;
         }
         .current-item ~ .step-wizard-item .progress-count:after{
            height:10px;
            width:10px;
         }
         .current-item ~ .step-wizard-item .progress-label{
            opacity: 0.5;
         }
         .current-item .progress-count:after{
            background: #fff;
            border: 2px solid #21d4fd;
         }
         .current-item .progress-count{
            color: #21d4fd;
         }
      </style>
</head>
<body>

<div class="container p-3 mt-2">
   <div class="row p-3">
      <div class="col-lg-5 text-center">
         <section class="step-wizard">
                <ul class="step-wizard-list">
                    <li class="step-wizard-item <?= $step1?>">
                        <span class="progress-count">1</span>
                        <span class="progress-label">Billing Info</span>
                    </li>
                    <li class="step-wizard-item <?= $step2?>">
                        <span class="progress-count">2</span>
                        <span class="progress-label">Payment Method</span>
                    </li>
                    <li class="step-wizard-item <?= $step3?>">
                        <span class="progress-count">3</span>
                        <span class="progress-label">Checkout</span>
                    </li>
                    <li class="step-wizard-item <?= $step4?>">
                        <span class="progress-count">4</span>
                        <span class="progress-label">Success</span>
                    </li>
                </ul>
           </section>
           <H1><?= $step5?></H1>
      </div>
   </div>
</div>

</body>
</html>
