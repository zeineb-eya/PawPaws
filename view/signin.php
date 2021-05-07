<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Paw Paws</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="../Assets2/css/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="../Assets2/fonts/font-awesome-5/css/fontawesome-all.min.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="../Assets2/css/style.css"/>
</head>
<body class="form-v5">
	<div class="page-content">
		<?php 

			include "../controller/UserC.php";
			require_once "../model/User.php";
			if (isset($_POST["Login"]) && isset($_POST["password"]))
			{
				if (!empty($_POST["Login"]) && !empty($_POST["password"]))
				{
					 $x=verification_sign_in ($_POST["Login"], $_POST["password"]);
					 if ($x!==0)
					 {
					 	 Connect ($x);
					 }
				}
				else echo "Remplissez les champs";
			}	


		?>
		<div class="form-v5-content">
			<form class="form-detail" action="signin.php" method="post">
				<h2>Register Account Form</h2>
				<div class="form-row">
					<label for="full-name">Login</label>
					<input type="text" name="Login" id="Login" class="input-text" placeholder="Inserer votre login" required>
					<i class="fas fa-user"></i>
				</div>
				<div class="form-row">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="input-text" placeholder="Inserer votre mot de passe" required>
					<i class="fas fa-lock"></i>
				</div>
				<div class="form-row">
					Vous n'avez pas de compte ?
					<a href="Signup.php">Register</a>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="Login" href="Acceuil.php">
				</div>
			</form>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>