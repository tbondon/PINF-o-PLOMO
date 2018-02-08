<html> <!--  HTML -->
		
	<head> <!--  HEAD -->
		<meta charset="utf-8">
			<link media="screen" type="text/css" rel="stylesheet" href="css/header.css"></link>
				<title> VDM2i </title>
	</head> <!--  FIN HEAD -->
	
	<body> <!--  BODY -->
		<div id="gen">
					<a href="index.php?view=homepage&cat=home">
					<img class="image_ig2i"  src="images/logo.png"></img>
					</a>
					<div id="right">
							<?php 
							include_once "libs/modele.php"; 
							if (valider("connecte","SESSION"))								
									echo mkHeadLink("Soumettre une VDM2i","soumettrevdm",$view,"soum");
							// si l'utilisateur est connecté le boutton "soumettre une VDM2i" renvoie sur la page pour soumettre une vdm2i
							else 
								echo mkHeadLink("Soumettre une VDM2i","connectpage&discon=1",$view,"soum");
							// si l'utilisateur n'est pas connecté le boutton "soumettre une VDM2i" renvoie sur la page pour se connecter
								
							?>
							<form action="controleur.php" method="POST">
					  
								<div id="search">
									<input id="but_search" type="text" value="" placeholder="rechercher" name="recherche"/>
									<button type="submit" class="btn_recherche" name="action" value="rechercher"/>
										<img class="img_loupe" src="images/loupe.png"></img>
									</button>
								
								</div>  
							</form>

							<?php
							// Si l'utilisateur n'est pas connecte, on affiche un lien de d'inscription
							if (!valider("connecte","SESSION"))
								echo mkHeadLink("Inscription","signupage",$view,"inscript"); 
							// Si l'utilisateur est connecte, on affiche bienvenue "pseudon de l'utilisateur"
							else echo "<p class='pseudo_con'>Bienvenue&nbsp" . "<strong>" . $_SESSION['pseudo'] ."</strong>" . "</p>";

							?>
							<?php
							// Si l'utilisateur n'est pas connecte, on affiche un lien de connexion 
							if (!valider("connecte","SESSION"))
								echo mkHeadLink("Connexion","connectpage",$view,"connect"); 
							// Si l'utilisateur est connecte, on affiche un lien de deconnexion 
							else echo "<a href='controleur.php? action=Logout' class='connect'> Déconnexion</a>";
							?>
						</div>
		</div>
		<div class="categories">
			<ul>
				<?php
				if (valider("connecte","SESSION"))
				{
					if ($_SESSION["admin"]==1)
					{
						$type='admin'; 
					}
					else
					{
						$type='user';
					}

				} 
				
				else
				{
					$type='visitor';
				}

				// on regarde si l'utilisateur est de type admin ou non pour ça on verifie si il est connecte ou non et on regarde la variable de session admin 

				$categorie = selectcat($type); // on range dans un tableau toutes les categories
				$taillecategorie=count($categorie); // on calcule la taille de ce tableau
				echo "<ul>";
				for ($i=0; $i < $taillecategorie ; $i++)
				{
					$id=$categorie[$i]['id_cat'];
					echo mkHeadLink($categorie[$i]['nom_cat'],"homepage&cat=cat$id",$view);
				}
				echo "</ul>";
				// on parcourt le tableau des categories et on crée un lien pour chaque catégorie
				?>
		</div>
		</body>
</html>