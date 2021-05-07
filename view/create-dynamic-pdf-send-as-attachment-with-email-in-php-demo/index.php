
<?php

//index.php

$message = '';

$connect = new PDO("mysql:host=localhost;dbname=pawpaws", "root", "");

function fetch_customer_data($connect)
{
	//$query = "SELECT * FROM reservation";
	$query = "SELECT * FROM reservation JOIN utilisateur ON utilisateur.id=reservation.iduser JOIN rooms ON rooms.idroom=reservation.idroom";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<tr>
				<th>id reservation</th>
				<th>Roomtype</th>
				<th>Nbre of pets</th>
				<th>Adresse</th>
				<th>tel</th>
				<th>Email</th>
				<th>HoteAdress</th>
				<th>Nbn</th>
				<th>Date</th>
				<th>Rooms nbre</th>
				<th>Special Requirments</th>
				<th>Nom et Prenom</th>
			</tr>
	';
	foreach($result as $row)
	{
		$output .= '
			<tr>
				<td>'.$row["idreservation"].'</td>
				<td>'.$row["roomtype"].'</td>
				<td>'.$row["firstname"].'</td>
				<td>'.$row["adresse"].'</td>
				<td>'.$row["tel"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["hoteladresse"].'</td>
				<td>'.$row["nbn"].'</td>
				<td>'.$row["date"].'</td>
				<td>'.$row["room"].'</td>
				<td>'.$row["rp"].'</td>
				<td>'.$row['Nom']." ".$row['Prenom'].'</td>
			</tr>
		';
	}
	$output .= '
		</table>
	</div>
	';
	return $output;
}


//lena
if(isset($_POST["action"]))
{
	include('pdf.php');
	$file_name = md5(rand()) . '.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	$html_code .= fetch_customer_data($connect);
	$pdf = new Pdf();
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	file_put_contents($file_name, $file);
	
	require 'class/class.phpmailer.php';

			require 'credential.php';

	$mail = new PHPMailer;
	$mail->IsSMTP();								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '587';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = EMAIL;					//Sets SMTP username
	$mail->Password = PASS;					//Sets SMTP password
	$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'pawp6703@gmail.com';			//Sets the From email address for the message
	$mail->FromName = 'gmail.com';			//Sets the From name of the message
	$mail->AddAddress('mariembenmassoud123@gmail.com', 'Mariem Ben Massaoud');		//Adds a "To" address
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'Reservations Details';			//Sets the Subject of the message
	$mail->Body = 'Please Find reservations details in attach PDF File.';				//An HTML or plain text message body
	if($mail->Send())								//Send an Email. Return true on success or false on error
	{
		$message = '<label class="text-success">Customer Details has been send successfully...</label>';
	}
	unlink($file_name);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dynamic PDF Send As Attachment with Email</title>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<script src="bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center"> Reservation Details</h3>
			<br />
<div class="dontPrint"></div>
			<form method="post">
				<input type="submit" name="action" class="btn btn-danger"" value="PDF Send" /><?php echo $message; ?>
				<td>
				 <a type="button" class="btn btn-primary shop-item-button" href = "print.php?idreservation=<?= $reservation['idreservation']?>"  onClick="window.print()">Print</a>
				
				 </td>
			</form>
		</div>
			<br />
			<?php
			echo fetch_customer_data($connect);
			?>			
		</div>
		<br />
		<br />
	</body>
</html>
<style>
@media print {
    * { -webkit-print-color-adjust: exact; }
    html { background: none; padding: 0; }
    body { box-shadow: none; margin: 0; }
    span:empty { display: none; }
    .add, .cut { display: none; }

    .dontPrint {
        visibility: hidden;
    } 
    .dontPrint1 {
    	visibility: hidden;

    }
    .dontPrint1 {
    	color: #006400;
    }
 .btn btn-primary shop-item-button {
 	visibility: hidden;
 }
</style>