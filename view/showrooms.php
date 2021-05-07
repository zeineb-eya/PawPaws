<?php
include '../controller/roomC.php';

$search="";
$roomC1=new roomC1() ;
if(isset($_POST['valueToSearch']))
{   
    $search=$_POST['valueToSearch'];
        
}
$liste=$roomC1->searchrooms2($search);
if(isset($_POST['tri']))
{
if($_POST['tri']=="defaut")
{
    $tri=0;
    $liste=$roomC1->trierrooms($tri);
}
else if($_POST['tri']=="price asc")
{
    $tri=1;
    $liste=$roomC1->trierrooms($tri);
}
else if($_POST['tri']=="roomtype asc")
{
    $tri=2;
    $liste=$roomC1->trierrooms($tri);
}
else if($_POST['tri']=="price desc")
{
    $tri=3;
    $liste=$roomC1->trierrooms($tri);
}
else if($_POST['tri']=="roomtype desc")
{
    $tri=4;
    $liste=$roomC1->trierrooms($tri);
}
else if($_POST['tri']=="qty asc")
{
    $tri=5;
    $liste=$roomC1->trierrooms($tri);
}
else if($_POST['tri']=="qty desc")
{
    $tri=6;
    $liste=$roomC1->trierrooms($tri);
}

}




?>
<html>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> show reservation name </title>
</head>
<body>
<a class="btn btn-info" href="addroom.php"> <i class="glyphicon glyphicon-plus" > </i> &nbsp;add room</a>
<hr>
<form class="contact__form" method="post" action="">
    <div align="center"  class="control-group form-group">   
<input type="text" name="tri" list="tri" >
    <datalist id="tri">
      <option value="defaut">
        <option value="price asc">
      <option value="roomtype asc">
      
        <option value="price desc">
        <option value="roomtype desc">
      <option value="qty asc">
        <option value="qty desc">
      <div class="col-12 mt-4">

    </div>
    </datalist>
            <input name="confirm" type="submit" class=" btn btn-hero btn-circled" value="Trier">
    </div>
    </form>
    <form align="center" action="" method="post">
    <input type="text" name="valueToSearch", placeholder="Room to search">
    <input type="submit" name="search" value="search"><br><br>
</form>
<div class="container">
    <div class="row col-md-6 col-md-offset-2 custyle">
        <table class="table table-striped custab">
            <thead>
    <tr>
        <th>Id</th>
        <th>Hotel Adresse</th>
        <th>roomtype</th>
        <th>price</th>
        <th>photo</th>
        <th>qty </th>

        <th>supprimer</th>
        <th>modifier</th>
    </tr>
            </thead>
    <?PHP
    foreach($liste as $room){ //echo reservation 9dima//
        ?>
        <tr>
            <td><?PHP echo $room['idroom']; ?></td>
             <td><?PHP echo $room['hoteladresse']; ?></td>
            <td><?PHP echo $room['roomtype']; ?></td>
            <td><?PHP echo $room['price']; ?></td>
            <td><?PHP echo $room['photo']; ?></td>
            <td><?PHP echo $room['qty']; ?></td>


            <td>
                <form method="POST" action="deleteroom.php">
                    <input type="submit"  class=" btn btn-danger" name="supprimer" value="Delete">
                    <input type="hidden" value=<?PHP echo $room['idroom'] ; // ba3thna id  champs hiddden bch na9rawh fi page spperimer ?> name="idroom">
                </form>
            </td>
            <td>

   <a type="button" class="btn btn-primary shop-item-button" href = "updateroom.php?idroom=<?= $room['idroom'] ?>">Modifier</a>
   
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
        margin: 5% 0;
        box-shadow: 3px 3px 2px #ccc;
        transition: 0.5s;
    }
    .custab:hover{
        box-shadow: 3px 3px 0px transparent;
        transition: 0.5s;
    }</style>
</body>
</html>