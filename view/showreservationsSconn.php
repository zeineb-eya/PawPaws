<?php
include '../controller/reservationSC.php';
$reservationC= new reservationC();

$liste=$reservationC->afficherReservation();

$tri='';
if (isset($_GET["tri"]))
    $tri=$_GET["tri"];


$listereservation=$reservationC->afficherActivites($tri,$_SESSION["e"]);

if (isset($_POST["idreservation"])&& isset($_POST["idservice"]) && isset ($_POST["supprimer"])){
    $reservationC->supprimerReservation($_POST["idreservation"],$_POST["idservice"]);
    header('Location:showreservationsS.php');
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
<a class="btn btn-info" href="searchreservationS.php"> <i class="glyphicon glyphicon-plus" > </i> &nbsp;Search reservation</a>
<a href="ReservationS_Gestion.php?tri=AZ"> Alphabetique A-Z</a>
<a href="ReservationS_Gestion.php?tri=ZA"> Alphabetique Z-A</a>
<a href="ReservationS_Gestion.php?tri=D"> Date</a>
<a href="ReservationS_Gestion.php?tri=P"> Date</a>
<hr>
<div class="container">
    <div >
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>Idreservation</th>
                
                <th>Adress</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Email</th>
                <th>Pets</th>
                <th>Extra</th>
                <th>service Type</th>
                <th>User</th>
                <th>delete</th>
                <th>update</th>
                
            </tr>
            </thead>
            <?PHP
            foreach($listereservation as $reservation) {

                ?>
                <tr>

                    <td><?PHP echo $reservation['idreservation']; ?></td>
                    
                    <td><?PHP echo $reservation['adresse']; ?></td>
                    <td><?PHP echo $reservation['tel']; ?></td>
                    <td><?PHP echo $reservation['date']; ?></td>
                    <td><?PHP echo $reservation['email']; ?></td>
                    <td><?PHP echo $reservation['nbn']; ?></td>
                    
                    <td><?PHP echo $reservation['rp']; ?></td>
                    <td><?PHP echo $reservation['servicetype']; ?></td>
                    <td><?PHP echo $reservation['Nom']; ?>&nbsp;
                        <?PHP echo $reservation['Prenom'];?></td>


                    <td>
                        <form method="POST" action="Reservation_Gestion.php">
                            <input type="submit" class=" btn btn-danger" name="supprimer" value="Delete">
                            <input type="hidden"
                                   value="<?PHP echo $reservation['idreservation']; // ba3thna id  champs hiddden bch na9rawh fi page spperimer ?>" name="idreservation">
                            <input type="hidden" value='<?PHP echo $reservation['idservice']; ?>' name="idservice">

                        </form>
                    </td>
                    <td>

                        <a type="button" class="btn btn-primary shop-item-button"
                           href="Modifier_ResS_Conn.php?idreservation=<?= $reservation['idreservation'] ?>">Update</a>
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