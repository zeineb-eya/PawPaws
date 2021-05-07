<?php
include '../controller/reservationC.php';
$reservationsC= new reservationsC();

$liste=$reservationsC->afficherReservation();

$tri='';
if (isset($_GET["tri"]))
    $tri=$_GET["tri"];


$listereservation=$reservationsC->afficherActivites($tri,$_SESSION["e"]);

if (isset($_POST["idreservation"])&& isset($_POST["idroom"]) && isset ($_POST["supprimer"])){
    $reservationsC->supprimerReservation($_POST["idreservation"],$_POST["idroom"]);
    header('Location:showreservations.php');
}




?>
<html>
<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> show reservation name </title>
</head>
<body>
<a class="btn btn-info" href="searchreservation.php"> <i class="glyphicon glyphicon-plus" > </i> &nbsp;Search reservation</a>
<a href="Reservation_Gestion.php?tri=AZ"> Alphabetique A-Z</a>
<a href="Reservation_Gestion.php?tri=ZA"> Alphabetique Z-A</a>
<a href="Reservation_Gestion.php?tri=D"> Date</a>
<a href="Reservation_Gestion.php?tri=P"> Date</a>
<hr>
<div class="container">
    <div >
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>Idreservation</th>
                <th>Adult</th>
                <th>children </th>
                <th>Adress</th>
                <th>Phone</th>
                <th>Check In</th>
                <th>Email</th>
                <th>Hotel Adress</th>
                <th>Room</th>
                <th>Nights</th>
                <th>Extra</th>
                <th>Room Type</th>
                <th>User</th>

                <th>delete</th>
                <th>update</th>
            </tr>
            </thead>
            <?PHP
            foreach($listereservation as $reservationh) {

                ?>
                <tr>

                    <td><?PHP echo $reservationh['idreservation']; ?></td>
                    <td><?PHP echo $reservationh['firstname']; ?></td>
                    <td><?PHP echo $reservationh['lastname']; ?></td>
                    <td><?PHP echo $reservationh['adresse']; ?></td>
                    <td><?PHP echo $reservationh['tel']; ?></td>
                    <td><?PHP echo $reservationh['date']; ?></td>
                    <td><?PHP echo $reservationh['email']; ?></td>
                    <td><?PHP echo $reservationh['hoteladresse']; ?></td>
                    <td><?PHP echo $reservationh['nbn']; ?></td>
                    <td><?PHP echo $reservationh['room']; ?></td>
                    <td><?PHP echo $reservationh['rp']; ?></td>
                    <td><?PHP echo $reservationh['roomtype']; ?></td>
                    <td><?PHP echo $reservationh['Nom']; ?>&nbsp;
                        <?PHP echo $reservationh['Prenom'];?></td>

                    <td>
                        <form method="POST" action="Reservation_Gestion.php">
                            <input type="submit" class=" btn btn-danger" name="supprimer" value="Delete">
                            <input type="hidden"
                                   value="<?PHP echo $reservationh['idreservation']; // ba3thna id  champs hiddden bch na9rawh fi page spperimer ?>" name="idreservation">
                            <input type="hidden" value='<?PHP echo $reservationh['idroom']; ?>' name="idroom">

                        </form>
                    </td>
                    <td>

                        <a type="button" class="btn btn-primary shop-item-button"
                           href="Modifier_Res_Conn.php?idreservation=<?= $reservationh['idreservation'] ?>">Update</a>
                    </td>
                </tr>
                <?PHP


            }
            ?>
        </table>
    </div>
</div>
<style>
    .custab{
        border: 1px solid #ccc;
        padding: 5px;
        margin: 1% 0;
        width:100%
        box-shadow: 3px 3px 2px #ccc;
        transition: 0.5s;
    }
    .custab:hover{
        box-shadow: 3px 3px 0px transparent;
        transition: 0.5s;

    }

</style>
</body>
</html>