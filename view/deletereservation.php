

<?php
include '../controller/reservationC.php';
//include '../model/room.php';
$reservationsC=new reservationsC();

if (isset($_POST["idreservation"])&&($_POST["idroom"])){
    $reservationsC->supprimerReservation($_POST["idreservation"],$_POST["idroom"]);
    header('Location:showreservations.php');
}

