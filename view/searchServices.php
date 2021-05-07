<?php
    include_once '../model/reservationS.php';
include_once '../model/service.php';
include_once '../controller/reservationSC.php';

 

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Paw Paws</title>
	<link rel="stylesheet" href="../assets3/css/style.css">

</head>

<body>
	<?php include_once 'header.php'; ?>

	<section class="container">
		<h2></h2>
		<div class="form-container">
            <form action="" method = 'POST'>
                <div class="row">
                    <div class="col-25">                
                        <label>Search Title: </label>
                    </div>
                    <div class="col-75">
                        <input type = "text" name = 'album'>
                    </div>
                </div>
                <br>
                <div class="row">
                    <input type = "submit" value = "Search" name ="search">
                </div>
            </form>
		</div>
	</section>

	<?php
	$search="";
		$serviceC=new serviceC() ;
if(isset($_POST['valueToSearch']))
{   
	$search=$_POST['valueToSearch'];
		
}
$liste=$serviceC->searchservice($search);
if(isset($_POST['tri']))
{
if($_POST['tri']=="defaut")
{
	$tri=0;
	$liste=$serviceC->trierservice($tri);
}
else if($_POST['tri']=="alphabet")
{
	$tri=2;
	$liste=$serviceC->trierservice($tri);
}
else if($_POST['tri']=="prix")
{
	$tri=1;
	$liste=$serviceC->trierservice($tri);
}
}
	?>
		<section class="container">
			<h2>Nom services</h2>
			<a href = "showservices.php" class="btn btn-primary shop-item-button">All services</a>
			<div class="shop-items">
				
				<div class="shop-item">
					<strong class="shop-item-title"> <?= $result['servicetype'] ?> </strong>
					<img src="../assets/images/<?= $result['price'] ?>" class="shop-item-image">
					<div class="shop-item-details">
						<span class="shop-item-price"><?= $result['price'] ?> dt.</span>
					</div>
				</div>
				
			</div>
		</section>
	<?php
		}
		else {
			echo "<div> No results found!!! </div>";
		}
	}
	?>
	<?php include_once 'footer.php'; ?>

	<script src="../assets3/js/script.js"></script>
</body>

</html>