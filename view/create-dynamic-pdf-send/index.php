<?php

$message = '';
$connect = new PDO("mysql:host=localhost;dbname=pawpaws", "root", "");

function fetch_customer_data($connect)
{
	$query = "SELECT * FROM reservations JOIN utilisateur ON utilisateur.id=reservations.iduser JOIN services ON services.idservice=reservations.idservice";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<tr>
				<th>id reservation</th>
				<th>Adresse</th>
				<th>tel</th>
				<th>Email</th>
				<th>pets</th>
				<th>Date</th>
				<th>Special Requirments</th>
				<th>service</th>
				<th>user</th>
			</tr>
	';
foreach($result as $row)

	{
		$output .= '
			<tr>
				<td>'.$row["idreservation"].'</td>
				<td>'.$row["adresse"].'</td>
				<td>'.$row["tel"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["nbn"].'</td>
				<td>'.$row["date"].'</td>
				<td>'.$row["rp"].'</td>
				<td>'.$row["servicetype"].'</td>
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
	$mail->FromName = 'Paw Paws';			//Sets the From name of the message
	$mail->AddAddress('zeinebeyarahmani@gmail.com', 'zeineb');		//Adds a "To" address
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
		<title>Dynamic PDF Send As Attachment with Email in PHP</title>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<script src="bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center"> Dynamic PDF Send As Attachment with Email in PHP</h3>
			<br />
			<form method="post">
				<input type="submit" name="action" class="btn btn-danger" value="PDF Send" /><?php echo $message; ?>
				<td>
				 <a type="button" class="btn btn-primary shop-item-button" href = "print.php?idreservation=<?= $reservation['idreservation']?>"  onClick="window.print()">Print</a>
				
				 </td>
			</form>
			<br />
			<?php
			echo fetch_customer_data($connect);
			?>			
		</div>
		<br />
		<br />
	</body>
</html>





