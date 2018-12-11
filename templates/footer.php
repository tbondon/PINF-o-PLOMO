<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

?>
<link rel="stylesheet" href="css/font.css" />
<link rel="stylesheet" href="css/footer.css" />
<link media="screen" type="text/css" rel="stylesheet" href="css/html.css"></link>
<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">

</div>

<!-- fin du content --> 

</div>
<!-- fin du wrap -->

<!--<div class="jumbotron" style="margin-top:10%; display : table-row; height: 30px;background-color:lightgrey; ">
	
	<h1 style="padding-left:1%; padding-top:1%; font-size: 16px;"> Formaleaz - Vos solutions de formation de A à Z</h1>
	<h5  style="padding-left:1% ;font-size: 10px;"> Nous contacter :</h5>
	<p class="lead"  style="padding-left:5%; font-size: 10px;">Par mail à contact@formaleaz.fr
	</br>Par téléphone au: 06 87 09 48 21
	</br>Par téléphone au: 09 52 67 92 25</p>
	<a  class="btn btn-outline-dark"  href="#" role="button">Haut de page</a>
-->
<?php
    		/*if (valider("connecte","SESSION"))
			{
				echo "<br>Utilisateur <b>$_SESSION[pseudo]</b> connecté depuis <b>$_SESSION[heureConnexion]</b> &nbsp; "; 
				echo "<a href=\"controleur.php?action=Logout\" style=\"text-decoration:none;font-family: OCR A Std, monospace;\">Se Déconnecter</a>";
			}
			*/?>
			
			
			<div class="jumbotron footer" id="footer" >	
				<div class='form_mdp2' style='padding:1%;'> 
					<div class='info_contact2'>
						<h3 class="titre_footer">Formaleaz - Vos solutions de formation de A à Z</h3>
						<a  class="btn btn-outline-light"  href="#" role="button">Haut de page</a>
					</div>

					<form class='changement_mdp2'>
						<h3>Nous contacter :</h3>
						<label>Par mail à :
							<a href="mailto:contact@formaleaz.fr" ><span>contact@formaleaz.fr</span></a>
						</label>
						<label>Par téléphone au:
							<span> 06 87 09 48 21</span>
						</label>
						<label>Par téléphone au:
							<span>09 52 67 92 25</span>
						</label>
						
						<div style='clear_both2'>
						
						</div>
						
					</div>
					
					<a href="https://www.facebook.com/Formaleaz-1177335752294596/" title="notre Facebook" target="_blank" ><img alt="Share on Facebook" src="images/flat_web_icon_set/color/Facebook.png" /></a>
					<div class="footercond">
						<a class="footercondElt" href="index.php?view=cgv" >CGV</a>
						|
						<a class="footercondElt" href="index.php?view=cgu" >CGU</a>
						|
						<a target=_blank rel="noopener noreferrer" class="footercondElt" href="ressources/REGLEMENT_INTERIEUR.pdf" >Règlement intérieur stagiaires</a>
						|
						<a class="footercondElt" href="index.php?view=mentions" >Mentions légales</a>
						
					</div>
					
				</div>
			</body>
			</html>