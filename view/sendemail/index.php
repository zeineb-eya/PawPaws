<!DOCTYPE html>
<html>
<head>
	<title>Paw Paws</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	    <title>Paw Paws</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/roompagestyle.css">

</head>
<body>
	   <!-- Navigation -->

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Paw PAws</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../Acceuil.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../DashboardUser.php">Account</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<br>
<br>
<br>
<br>
<div class="container">
<h1 class="text-center">Sending Emails</h1>

<hr>
	<?php 
		if(isset($_POST['sendmail'])) {
			require 'PHPMailerAutoload.php';
			require 'credential.php';

			$mail = new PHPMailer;

			//$mail->SMTPDebug = 4;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = EMAIL;                 // SMTP username
			$mail->Password = PASS;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom(EMAIL, 'paw paws');
			$mail->addAddress($_POST['email']);     // Add a recipient

			$mail->addReplyTo(EMAIL);
			// print_r($_FILES['file']); exit;
			/*for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
				$mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    // Optional name
			}*/
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = $_POST['subject'];
			$mail->Body    = '<div style="border:2px solid red;">This is the HTML message body</div>';
			$mail->AltBody = $_POST['message'];

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
		}
	 ?>
	<div class="row">
    <div class="col-md-9 col-md-offset-2">
        <form role="form" method="post" enctype="multipart/form-data">
        	<div class="row">
                <div class="col-sm-9 form-group">
                    <label for="email">To Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" maxlength="50">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="Test Mail" maxlength="50">
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="name">Message:</label>
                    <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Your Message Here" maxlength="6000" rows="4">Test mail using PHPMailer</textarea>
                </div>
            </div>
           <!-- <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="name">File:</label>
                    <input name="file[]" multiple="multiple" class="form-control" type="file" id="file">
                </div>
            </div>-->
             <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="sendmail" class="btn btn-lg btn-success btn-block">Send</button>
                </div>
            </div>
        </form>
	</div>
</div>
</body>
</html>
