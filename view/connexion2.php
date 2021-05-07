<?php
include "../model/reservation.php";
include "../controller/reservationC.php";
/*$reservationC = new reservationC();
$post=new reservationC();
$post->firstname= $_POST["firstname"];
$post->lastname= $_POST["lastname"];
$post->date = $_POST["date"];
$post->tel= $_POST["tel"];
$post->adresse= $_POST["adresse"];
$post->nbn= $_POST["nbn"];
$post->rp= $_POST["rp"];
$post->email= $_POST["email"];

$reservationC ->sendmail($post);*/

$reservationsC=new reservationsC();
$post=new reservationsC ();
session_start();

$reservationh=$reservationsC->getact($_POST["reservation"]);
foreach ($reservationh as $reservationh)
{if ($reservationsC ->afficherrooms1($_POST["roomtype"],$_POST["reservation"])==1)
{$reservationsC ->connexion($_SESSION['e'],$_SESSION['Nom']." ".$_SESSION['Prenom'],$_POST["roomtype"],$_POST["reservation"],$reservationh["idreservation"]);
header( "refresh:5;url=Acceuil.php");}
else {echo "Places non restantes, merci pour votre comprehension";
header( "refresh:5;url=index1.php");
return;
}
$reservationsC->sendmail($post);
}