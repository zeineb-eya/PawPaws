
<?php

include_once '../model/reservationS.php';
include_once '../controller/reservationSC.php';
include_once '../Model/service.php';
session_start();
if (isset($_SESSION["e"])&& !empty($_SESSION["e"]))
{
$error = "";

// create user
$reservationC = null;

// create an instance of the controller
$reservationC = new reservationC();
if (

    isset($_POST["adresse"])&&
    isset($_POST["tel"]) &&
    isset($_POST["date"])&&
    isset($_POST["email"]) &&
    isset($_POST["nbn"])&&
 
    isset($_POST["rp"])&&
    isset($_POST["idservice"])

) {
    if (
        
        !empty($_POST["adresse"])&&
        !empty($_POST["tel"])&&
        !empty($_POST["date"])&&
        !empty($_POST["email"])&&
        !empty($_POST["nbn"])&&
        
        !empty($_POST["rp"])&&
        !empty($_POST["idservice"])

    ) {
        $Reservation = new reservation(
            
            $_POST['adresse'],
            $_POST['date'],
            $_POST['tel'],

            $_POST['email'],
            $_POST['nbn'],
            
            $_POST['rp'],
            $_POST['idservice'],
$_SESSION["e"]
        );
        $qty= $_GET["qty"];
        $idservice= $_GET["idservice"];
        try
        {$reservationC-> ajouterReservation($Reservation,$qty,$idservice,$_SESSION['e']);}
        catch (Exception $e){
            echo $e->getMessage();

        }


        header('Location:Acceuil.php');
    }
    else
        $error = "Missing information";


    $reservationC = new reservationC();
    $post=new reservationC();
   $post->user= $_SESSION["Nom"];
    $post->date = $_POST["date"];
    $post->tel= $_POST["tel"];
   $post->adresse= $_POST["adresse"];
    $post->nbn= $_POST["nbn"];
   $post->rp= $_POST["rp"];
   $post->email= $_POST["email"];


   $reservationC ->sendmail($post);

}




?>

<!DOCTYPE html>
<script>
    function CheckDate()
{date = window.document.getElementById('dp1').value;
    console.log(date);
 var a=new Date();        // date courante

 if(date < a){
 alert("Please enter a valid date");}
 }
function test() {
//1.saisie de control sur date
/*date = window.document.getElementById('dp1').value;
    console.log(date);
 var a=new Date();        // date courante

 if(date < a){
 alert("false");}
 else{alert("true");}*/

//2.sasie de control sur numero de telephone
phone = window.document.getElementById('tel').value;
    console.log(phone);
    z = phone.length;
    console.log(z);
    if (z < 8) {
        alert('your phone number must include more than 8 numbers');
    }

//3.saise de control sur style de musique
var x=document.getElementById('email').value;
var atposition=x.indexOf("@");
var dotposition=x.lastIndexOf(".");
if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){
alert("Please enter a valid e-mail address ");
return false;}



}

</script>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Paw Paws</title>


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <!-- LINEARICONS -->
    <link rel="stylesheet" href="../assets3/Assets_Res/fonts/linearicons/style.css">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="../assets3/Assets_Res/fonts/material-design-iconic-font/css/material-design-iconic-font.css">

    <!-- DATE-PICKER -->
    <link rel="stylesheet" href="../assets3/Assets_Res/vendor/date-picker/css/datepicker.min.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="../assets3/Assets_Res/style.css">
</head>
<strong style="color: #AA0000">
    <?php echo $error;

    ?>

</strong>

<body>




<form action="" method="POST">
<!DOCTYPE html>
<div class="wrapper" id="shadow">
    <div class="inner">
        <?php
        $search="";
        if (isset($_GET["search"]))
        {
            $search=$_GET["search"];
        }
        afficherservices1($search);

        ?>
        <div id="wizard">



            <!-- SECTION 1 -->

            <h4>Choose Date</h4>
            <section>

                <div class="form-row">

                    <div class="form-holder">
                        <input type="text" class="form-control datepicker-here pl-85" data-language='en' data-date-format="dd - m - yyyy" id="dp1" name="date">
                        <span class="lnr lnr-chevron-down"></span>
                        <span class="placeholder">date :</span>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="select">

                        <select id =nbn" name="nbn" class="form-control">
                            <option value="" style="color:white " value="" selected disabled hidden>Pets</option>
                            <option style="color: midnightblue">1 Pet</option>
                            <option style="color: midnightblue" >2 Pets</option>
                            <option style="color: midnightblue" >3 Pets</option>
                            <option style="color: midnightblue" >4 Pets</option>
                            <option style="color: midnightblue">5 Pets</option>
                        </select>
                    </div>
                </div>
                <button class="forward" onclick="CheckDate()">NEXT
                    <i class="zmdi zmdi-long-arrow-right"></i>
                </button>

            </section>

            <!-- SECTION 2 -->

            <h4>more info</h4>
            <section>

                <div class="form-row">

                    <div class="form-holder">

                    </div>
                    <div class="form-holder">

                    </div>
                </div>
                
                <div class="form-row mb-21">
                    <div class="form-holder w-100">
                        <textarea name="rp" id="rp" class="form-control" style="height: 79px;" placeholder="Special Requirements :"></textarea>
                        <input class="form-control" type="text" value=<?PHP echo $_GET['idservice'] ;?> name="idservice" hidden >



                    </div>
                </div>
                <button class="forward">NEXT
                    <i class="zmdi zmdi-long-arrow-right"></i>
                </button>

            </section>


            <!-- SECTION 3 -->
            <h4>Make a Reservation</h4>
            <section>
                <div class="form-row">


                </div>
                <div class="form-row">

                    <div class="form-holder">

                        <input type="text" class="form-control" placeholder="Phone :" name="tel" id="tel">
                    </div>
                    <div class="form-holder">
                        <input type="text" class="form-control" placeholder="Mail :"name="email" id="email" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-holder w-100">
                        <input type="text" class="form-control" placeholder="Address :" name="adresse" id="adresse">
                    </div>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox"> I have read and accept the <a href="#" >terms and conditions. </a>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <button type="submit" value="Submit"  onclick="test()">Submit</button>
            </section>

        </form>
                </div>
            </section>
        </div>
    </div>
</div>

<script src="../assets3/Assets_Res/js/jquery-3.3.1.min.js"></script>

<!-- JQUERY STEP -->
<script src="../assets3/Assets_Res/js/jquery.steps.js"></script>

<!-- DATE-PICKER -->
<script src="../assets3/Assets_Res/vendor/date-picker/js/datepicker.js"></script>
<script src="../assets3/Assets_Res/vendor/date-picker/js/datepicker.en.js"></script>

<script src="../assets3/Assets_Res/js/main.js"></script>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<!-- Template created and distributed by Colorlib -->
<script src="../assets3/Assets_Res/js/script2.js"></script>
</body>
</html>

<?php
    }
    else

    header('Location:signin.php');
    ?>