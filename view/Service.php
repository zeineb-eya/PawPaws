<!DOCTYPE html>
<html>
<?php session_start();
?>
    <head>
   <meta charset="utf-8">
  <title>Paw Paws</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../assets3/css/main2.css">
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
   <link rel = "icon" href = "../assets3/img/logo.png" type = "image/png">
       <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/roompagestyle.css">
  
   
    </head>
    <body>


<section class = "rooms sec-width"  id = "services">
    <?php

include_once '../model/reservationS.php';
include_once '../model/service.php';
include_once '../controller/reservationSC.php';

?>
            <div class = "title">
                <h3 style="color:#FF5733;">Services</h3>
            </div> 
<div class="service_area">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 col-md-10">
                    <div class="section_title text-center mb-95">
                        <h3 style="color:#FF5733;">Services for every pet</h3>
                        <p>Whether it’s a pamper day, playdate, sleepover, training class or veterinary visit, we provide the best in pet services with highly trained, passionate associates. From our pet hotel & doggie day camp as an alternative to pet sitting, to our dog training and grooming as an alternative to DIY, our services are conveniently located inside most of our PawPaws stores.</p>

                    </div>
                    
                </div>
               
            </div>
            <!-- Page Content -->
<div class="container">

    <?php

    $search="";
    if (isset($_GET["search"]))
    {
        $search=$_GET["search"];
    }
    afficherservices($search);

    ?>

</div>
         </section>

        <script src="../assets3/js/script.js"></script>
    </body>
</html>