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


<section class = "rooms sec-width"  id = "rooms">
    <?php

include_once '../model/reservation.php';
include_once '../model/room.php';
include_once '../controller/reservationC.php';

?>
            <div class = "title">
                <h3 style="color:#FF5733;">Hotels</h3>
            </div> 
<div class="service_area">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 col-md-10">
                    <div class="section_title text-center mb-95">
                        <h3 style="color:#FF5733;">BECAUSE YOUR PET DESERVES THE BEST</h3>
                        <p>When you leave your pet somewhere overnight, you want to be sure they’re well taken care of.pawpaws Resorts Luxury Pet Hotel are award-winning, internationally recognized pet care resorts that will make your pup feel right at home. All our trained and certified staff members are true animal lovers and will care for your pet as if they were our own.</p>

                    </div>
                    
                </div>
               
            </div>
            <!-- Page Content -->
<div class="container">

    <?php

    $search2="";
    if (isset($_GET["search2"]))
    {
        $search2=$_GET["search2"];
    }
    afficherrooms($search2);

    ?>

</div>
 </section>





        <script src="../assets3/js/script.js"></script>
    </body>
</html>