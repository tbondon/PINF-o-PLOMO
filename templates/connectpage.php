<?php

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php"; 
include_once "libs/modele.php";

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=homepage");
}

// Chargement eventuel des données en cookies
$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE"); 
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 

?>
<html> <!--  HTML -->
		
	<head> <!--  HEAD -->
		<meta charset="utf-8">
			<link media="screen" type="text/css" rel="stylesheet" href="css/connectpage.css"></link>
				<title> VDM2i </title>
	</head> <!--  FIN HEAD -->

	<body> <!--  BODY -->

				<div class="connexion">   
					<h1>Connectez-vous</h1>
			   <?php
			  			$suc=valider("suc","GET");
			  			if ($suc==1) echo "<p style='text-align:center;color:green;margin:20px 0px;'>Compte Créé</p>";
			  			$echec=valider("echec","GET");
			  			if ($echec==1) echo "<p style='text-align:center;color:red;margin:20px 0px;'>Votre pseudo et votre mot de passe ne correspondent pas</p>";
			  			elseif ($echec==2) echo "<p style='text-align:center;color:red;margin:20px 0px;'>Vous êtes censuré temporairement, veuillez être gentil afin d'être réintégré.</p>";
			  			elseif ($echec==3) echo "<p style='text-align:center;color:red;margin:20px 0px;'>Veuillez vous connecter afin d'accéder à votre profil.</p>";
			  			$discon=valider("discon","GET");
			  			if ($discon==1) echo "<p style='color:red;margin:-20px 0px 25px 130px;'>Veuillez vous connecter avant de publier une Vdm2i</p>";
			  			elseif ($discon==2) echo "<p style='color:red;margin:-20px 0px 25px 130px;'>Veuillez vous connecter pour accéder à vos Vdm2i</p>";
			  			// un message d'erreur ou de succès est affiché suivant l'action de l'utilisateur (mauvais pseudo, mot de passe ou création du compte )

			  	?>
					<form action="controleur.php" method="POST">
			  
						<div class="criteres">
							<input class="form_in" type="text" required autocomplete="off" placeholder="pseudo" name="login"/>
						</div>
			  
						<div class="criteres">
							<input class="form_in" type="password" required autocomplete="off" placeholder="mot de passe" name="passe" />
						</div>
			  
							<button class="but_bas" type="submit" name="action" value="Connexion" />Se Connecter  </button>
						 <!-- on envoie au controleur les paramètres de connexion de l'utilisateur (pseudo et mot de passe)-->
			  
					</form>

				</div>
		

	</body> <!--  FIN BODY -->
	
	<footer> <!-- FOOTER -->
	
	</footer><!-- FIN FOOTER -->

</html>