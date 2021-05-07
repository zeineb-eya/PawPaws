<?php

include "../controller/serviceC.php";
include "../model/service.php";
if (isset($_GET["idservice"]))
    $idservice=$_GET["idservice"];
$error = "";

$serviceC1 = new serviceC1(); //controller
if (  isset($_POST["idservice"]) &&
    isset($_POST["servicetype"]) &&
    isset($_POST["price"]) &&
    isset($_POST["photo"]) &&
    isset($_POST["qty"])

) {
    if (  !empty($_POST["idservice"]) &&
        !empty($_POST["servicetype"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["photo"])&&
    !empty($_POST["qty"])
    ) {
        $service = new service( //ism model//

            $_POST['servicetype'],
            $_POST['price'],
            $_POST['photo'],
  $_POST['qty']

        );
        $idservice=$_POST["idservice"];
        $serviceC1->updateservice($service,$idservice);

    } else
        $error = "Missing information";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Add service Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleroom.css">
</head>
<body>
<div class="testbox">
    <form action="" method="POST">
        <div class="banner">
            <h1> Add services Form</h1>
        </div>
        <br/>
        <fieldset>
            <legend>service Details</legend>
            <div class="columns">

                <div class="item">
                    <?php
                    if (isset($_GET['idservice'])) {
                    $result = $serviceC1->getservicesById($_GET['idservice']);
                    if ($result !== false) {
                    ?>
                    <label for="fname">Service Type<span>*</span></label>
                    <input id="fname" type="text" name="servicetype" value="<?= $result['servicetype'] ?>"/>
                </div>


                <div class="item">
                    <label for="zip">Price<span>*</span></label>
                    <input id="zip" type="text"   name="price" value="<?= $result['price'] ?>"/>
                </div>
                <div class="item">
                    <label for="city">Quantity<span>*</span></label>
                    <input id="city" type="text"   name="qty" value="<?= $result['qty'] ?>" />
                </div>


                <div class="item">
                    <label for="phone">Image<span>*</span></label>
                    <input id="phone" type="file"    name="photo" value="<?= $result['photo'] ?>"/>

                </div>
                <input id="idservice" name="idservice" value="<?php echo $idservice ?>" hidden>

        </fieldset>
        <br/>

        <div class="btn-block">
            <button type="submit">Modify</button>
        </div>
    </form>
    <?php
    }
    }
    else {
        header('Location:showservices.php');
    }
    ?>
</div>
</body>
