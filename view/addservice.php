<?php

require "../controller/reservationSC.php";
require "../model/service.php";

$serviceC = new serviceC(); //controller
if (
    isset($_POST["servicetype"]) &&
    isset($_POST["price"]) &&
    isset($_POST["photo"])&&
isset($_POST["qty"])

) {
    if (
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
        $serviceC-> addservice($service);

}
else
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
    <form NAME="f" action="addservice.php" method="POST">
        <div class="banner">
            <h1> Add service Form</h1>
        </div>
        <br/>
        <fieldset>
            <legend>service Details</legend>
            <div class="columns">
                <div class="item">
                    <label for="fname">service Type<span>*</span></label>
                    <input id="fname" type="text" name="servicetype" />
                </div>


                <div class="item">
                    <label for="zip">Price<span>*</span></label>
                    <input id="zip" type="text"   name="price" required/>
                </div>
                <div class="item">
                    <label for="city">Palace Valable<span>*</span></label>
                    <input id="city" type="text"   name="qty" />
                </div>


                <div class="item">
                    <label for="phone">Image<span>*</span></label>
                    <input id="phone" type="file"    name="photo"/>
                </div>
        </fieldset>
        <br/>

        <div class="btn-block">
            <button type="submit">Envoyer</button>
        </div>
    </form>
</div>
</body>
</html>