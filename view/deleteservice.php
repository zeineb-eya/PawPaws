<?php

	include "../controller/serviceC.php";



	$serviceC1=new serviceC1();

	if (isset($_POST["idservice"])){
        $serviceC1->deleteservice($_POST["idservice"]);
        header('Location:showservices.php');
    }

