
<?php
include '../controller/reservationSC.php';
$reservationC=new reservationC();

if (isset($_POST["idreservation"])&&($_POST["idservice"])){
    $reservationC->supprimerReservation($_POST["idreservation"],$_POST["idservice"]);
    header('Location:showreservationsS.php');
}

