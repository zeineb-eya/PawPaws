<?php
include '../controller/serviceC.php';
/*$serviceC1= new serviceC1();

$liste=$serviceC1->affiche();

*/
$search="";
$serviceC1=new serviceC1() ;
if(isset($_POST['valueToSearch']))
{   
    $search=$_POST['valueToSearch'];
        
}
$liste=$serviceC1->searchservice2($search);
if(isset($_POST['tri']))
{
if($_POST['tri']=="defaut")
{
    $tri=0;
    $liste=$serviceC1->trierservice($tri);
}
else if($_POST['tri']=="price asc")
{
    $tri=1;
    $liste=$serviceC1->trierservice($tri);
}
else if($_POST['tri']=="servicetype asc")
{
    $tri=2;
    $liste=$serviceC1->trierservice($tri);
}
else if($_POST['tri']=="price desc")
{
    $tri=3;
    $liste=$serviceC1->trierservice($tri);
}
else if($_POST['tri']=="servicetype desc")
{
    $tri=4;
    $liste=$serviceC1->trierservice($tri);
}
else if($_POST['tri']=="place valable asc")
{
    $tri=5;
    $liste=$serviceC1->trierservice($tri);
}
else if($_POST['tri']=="place valable desc")
{
    $tri=6;
    $liste=$serviceC1->trierservice($tri);
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
    <title> Manage Services </title>
    <title>Paw Paws</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img2/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <div  align="center" class="container-fluid">
        <div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
          <div class="row">
       
<a class="btn btn-info" href="addservice.php"> <i class="glyphicon glyphicon-plus" > </i> &nbsp;add service</a>
<hr>
<form class="contact__form" method="post" action="">
    <div align="center"  class="control-group form-group">   
<input type="text" name="tri" list="tri" >
    <datalist id="tri">
      <option value="defaut">
        <option value="price asc">
      <option value="servicetype asc">
      
        <option value="price desc">
        <option value="servicetype desc">
      <option value="place valable asc">
        <option value="place valable desc">
      <div class="col-12 mt-4">

    </div>
    </datalist>
            <input name="confirm" type="submit" class=" btn btn-hero btn-circled" value="Trier">
    </div>
    </form>
    <form align="center" action="" method="post">
    <input type="text" name="valueToSearch", placeholder="Service to search">
    <input type="submit" name="search" value="search"><br><br>
</form>
<div class="container">
    <div class="row col-md-6 col-md-offset-2 custyle">
        <table class="table table-striped custab">
            <thead>
    <tr>
        <th>Id</th>
        <th>servicetype</th>
        <th>price</th>
        <th>photo</th>
        <th>Places available</th>

        <th>delete</th>
        <th>update</th>
    </tr>
            </thead>
    <?PHP
    foreach($liste as $service){ //echo reservation 9dima//
        ?>
        <tr>
            <td><?PHP echo $service['idservice']; ?></td>
            <td><?PHP echo $service['servicetype']; ?></td>
            <td><?PHP echo $service['price']; ?></td>
            <td><?PHP echo $service['photo']; ?></td>
            <td><?PHP echo $service['qty']; ?></td>


            <td>
                <form method="POST" action="deleteservice.php">
                    <input type="submit"  class=" btn btn-danger" name="supprimer" value="Delete">
                    <input type="hidden" value=<?PHP echo $service['idservice'] ; // ba3thna id  champs hiddden bch na9rawh fi page spperimer ?> name="idservice">
                </form>
            </td>
            <td>

                <a type="button" class="btn btn-primary shop-item-button" href = "updateservice.php?idservice=<?= $service['idservice'] ?>">Modifier</a>
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