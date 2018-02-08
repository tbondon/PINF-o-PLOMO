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
<!DOCTYPE html>

<html> <!--  HTML -->
	<head> <!--  HEAD -->
		<meta charset="utf-8">
			<link media="screen" type="text/css" rel="stylesheet" href="css/homepage.css"></link>
				<title> VDM2i </title>
	</head> <!--  FIN HEAD -->
	
	<body> <!--  BODY -->
				
	<div class="ttvdm">
	<?php
	$suc=valider("suc","GET");
	if ($suc==1) echo "<p style='text-align:center;color:green;margin:20px 0px;'>Votre compte a bien été supprimé</p>";
		// la variable cat prend le nom de la catégorie qu'a choisi l'utilisateur
  		$cat=valider("cat","GET");
  		if(!$cat) $cat="home";
  			// on verifie si l'utilisateur a choisi une catégorie
  			if (valider("connecte","SESSION"))
  			{
  				if ($_SESSION['admin'] == 0)
  				{
  					$person='user';
  				}
  				else
  				{
  					$person='admin';
  				}
  			}
  			else
  			{
  				$person='visitor';
   			}


  			if ($cat=='cat1')
  			{
  				if (valider("connecte","SESSION"))
  				{
	  				$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
					
					$addArgs="?view=profil";

					// On redirige vers la page index avec les bons arguments

					header("Location:" . $urlBase . $addArgs);

	  			}
	  			else
	  			{
	  				$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
					
					$addArgs="?view=connectpage&echec=3";

					// On redirige vers la page index avec les bons arguments

					header("Location:" . $urlBase . $addArgs);
	  			}
	  		$taillevdm2i=0;
  			}

  			elseif ($cat=='cat2')
			{
				if($person!='admin') 
				{
					$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
					
					$addArgs="?view=error";

					header("Location:" . $urlBase . $addArgs);
					// On redirige l'utilisateur vers une page d'erreur
				}
				$type='notype';
				$vdm2i = selectvdm2i($type);
	  			$taillevdm2i = count($vdm2i); 
	  			$bynormal=1; 	
	  			$bycat=0;
				for ($i=0; $i < $taillevdm2i ; $i++)
				{
				echo "<div class='vdm'>";
					// on affiche la vdm2i
				echo "<div class='vdm_txt'>" . $vdm2i[$i]["vdm2i"] . "</div>";
				echo "<div class='auteur' id='auteur1'> par " . $vdm2i[$i]["pseudo"] . " le " . $vdm2i[$i]["date_vdm"] . "</div>";
				echo "<form action='controleur.php' method='POST'>";

				echo "<input type='hidden' name='cat' value=" .  $cat . " </input>";
				echo "<input type='hidden' name='id_vdm' value=" .  $vdm2i[$i]["id_vdm2i"] . " </input>";
				$mail=findmail($vdm2i[$i]["pseudo"]);
				echo "<input type='hidden' name='mail' value=" . $mail . " </input>";
				echo "<button class='admin' id='admin_valid' name='action' type='submit' value='valid_post'>Valider</button>";
				echo "<button class='admin' id='admin_invalid' name='action' type='submit' value='supp_post'>Supprimer</button>";
				echo "</form>";
				echo "</div>";

				
				// on rajoute deux bouttons valider et supprimer pour cotroler les vdm2i, on envoie au controleur l'id de la vdm2i et le mail de la personne qui a posté cette vdm2i
				}
				$taillevdm2i=0; // pour pas qu'il rentre dans le for d'après et qu'il réaffiche toutes les  vdm2i
			}
			// la categorie 1 est accessible que pour l'admin. cette categorie renvoie un tableau des vdm2i qui n'ont pas été modérées (valider ou supprimer). En dessous de chaque vdm2i on affiche un boutton valider et un boutton supprimer pour modérer la vdm2i.

			elseif ($cat=='cat3')
  			{
  				if($person!='admin') 
				{
					$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
					
					$addArgs="?view=error";

					header("Location:" . $urlBase . $addArgs);
					// On redirige l'utilisateur vers une page d'erreur
				}
				$users = selectuser();
	  			$tailleusers = count($users); 
				for ($i=0; $i < $tailleusers; $i++)
				{
				echo "<div class='vdm'>";
				echo "<form action='controleur.php' method='POST'>";
				$blacklist=$users[$i]["blacklist"];
				if ($blacklist==0)
				{
					$image='images/cross.png';
				}
				elseif($blacklist==1)
				{
					$image='images/valid.png';
				}
				
					echo "<input type='hidden' name='blacklist' value=" . $blacklist . " </input>";
					echo "<input type='hidden' name='id_user' value=" . $users[$i]["id_user"] . " </input>";
					echo "<button class='supp_post'  name='action' type='submit' id='submit' value='gerer_user'>";
						echo "<img class='image_cross'  src='".$image."'></img>";
					echo "</button>";
				echo "</form>";
				echo "<div class='vdm_txt'>" . $users[$i]["pseudo"] . "</div>";
				echo "<div class='auteur' id='auteur1'>" . $users[$i]["email"] ."</div>";
				echo "</div>";

				}
				$taillevdm2i=0;// pour pas qu'il rentre dans le for d'après et qu'il réaffiche toutes les  vdm2i
			}
			// la categorie 2 est accessible que pour l'admin. cette categorie affiche tous les utilisateurs (blacklisté ou non). Si l'utilisateur est blacklisté on affiche un boutton check vert pour le réintégrer.  Si l'utilisateur n'est pas blacklisté on affiche un boutton supprimer rouge pour le blacklister.

  			
  			elseif ($cat=='cat4') 
  			{
  				if (valider("connecte","SESSION"))
  				{
  				$pseudo=$_SESSION['pseudo'];
  				$vdm2i = selectvdmbyuser($pseudo);
				$taillevdm2i = count($vdm2i);
  				}
  				else
  				{
  					$addArgs="?view=connectpage&discon=2";
  					header("Location:" . $urlBase . $addArgs);
  					$taillevdm2i=0;
  				}
  			}
  			// si la categorie choisit est 3 on renvoie un tableau des vdm2i de l'utilisateur si il est connecté sinon on le redirige vers la page de connexion

  			elseif ($cat=='cat5')
  			{
  				$vdm2i = selectvdmbytop();
				$taillevdm2i = count($vdm2i);
				$bycat=0;
				$bynormal=1; 
  			}
  			// si la categorie choisit est 4 on on renvoie un tableau des vdm2i de la plus liké à la moins liké

  			elseif ($cat=='cat6' || $cat=='cat7' || $cat=='cat8' || $cat=='cat9' || $cat=='cat10')
  			{
  				$vdm2i = selectvdmbycat($cat);
				// on calcul le nombre de vdm2i selectionne
  				$taillevdm2i = count($vdm2i); 
				$bycat=1;
				$bynormal=0; 
			}
			// si la categorie choisit est 6,7,8,9 ou 10 on renvoie un tableau des vdm2i suivant la categorie choisit, de la plus récente à la moins récente

			
  			elseif($cat=='home')
  			{
  				$type = 'valid';
  				$vdm2i = selectvdm2i($type);
	  			$taillevdm2i = count($vdm2i); 
	  			$bynormal=1; 	
	  			$bycat=0;
  			}

  			else
  			{
  				$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";

				$addArgs="?view=error";
				// si l'argument n'est pas valid on le redirige vers la page d'erreur

				header("Location:" . $urlBase . $addArgs);
  			}

  			// si aucune categorie n'a été choisit on renvoit un tableau avec toutes les vdm2i de la plus recente à la moins recente

  			if ($cat!='cat1' and $cat!='cat2' and $cat!='cat3' and $cat!='cat4')
  			{
  			echo "<div class='topflop'>";
  			echo"<div class = 'classement' id='top'>";
					echo "<h1>TOP</h1>";
					echo "<div class='class_avis'>";
					$classement ='top';
					$top = selectclassement($classement,$bycat,$bynormal,$cat);
					$tailletop=count($top)-1;
					for ($i=0; $i <=$tailletop; $i++)
						{
							$place=$i+1;
							echo "<div class='class_top'>" . $place . ". " . $top[$i]['pseudo'] . " avec " . $top[$i]['totlike'] . " like(s) </div>";
						}
					echo "</div>";	
				echo "</div>";

				echo"<div class = 'classement' id='flop'>";
					echo"<h1>FLOP</h1>";
					echo "<div class='class_avis'>";
					$classement ='flop';
					$flop = selectclassement($classement,$bycat,$bynormal,$cat);
					$tailleflop=count($flop)-1;
					for ($i=0; $i <=$tailleflop; $i++)
						{
							$place=$i+1;
							echo "<div class='class_top'>" . $place . ". " . $flop[$i]['pseudo'] . " avec " . $flop[$i]['totdislike'] . " dislike(s) </div>";
						}
					echo "</div>";						
				echo "</div>";
			echo "</div>";
  			} 
  			// Si la categorie choisit n'est ni la 0,1,2 ou 3 on affiche 2 tableaux sur la droite de l'écran. un tableau top avec les 3 users les plus likés suivant la catégorie choisit. Et un tableau flop avec les 3 users les plus dislikés suivant la catégorie choisit.
  			
					
						
	  		// on affiche les vdm2i en parcourant le tableau des vdm2i choisit suivant la categorie choisit
			for ($i=0; $i < $taillevdm2i ; $i++)
			{
				echo "<div class='vdm'>";
		
				$id_vdm=$vdm2i[$i]["id_vdm2i"] ;

				if ($person=='admin')
				{
					echo "<form action='controleur.php' method='POST'>";
					echo "<input type='hidden' name='cat' value=" .  $cat . " </input>";
					echo "<input type='hidden' name='id_vdm' value=" . $id_vdm . " </input>";
					echo "<button class='supp_post'  name='action' type='submit' id='submit' value='supp_post'>";
					echo "<img class='image_cross'  src='images/cross.png'></img>";
					echo "</button>";
					echo "</form>";
				} // si l'utilisateur est admin on lui rajoute un boutton supprimer pour qu'il ai la possibilité de supprimer une vdm2i si il change d'avis par rapport à sa modération.
				echo "<div class='vdm_txt'>" . $vdm2i[$i]["vdm2i"] . "</div>";
				if ($person=='visitor')
				{
					$type = "like";
					// on affiche le nombre de like
					echo "<div class='like'><img class='like_im' src='images/like.png'></img>" . nblike($id_vdm,$type) . "</div>";
					$type = "dislike";
					// on affiche le nombre de dislike
					echo "<div class='dislike'><img class='dislike_im' src='images/dislike.png'></img>" . nblike($id_vdm,$type) . "</div>";
				}
				else
				{
					echo "<form action='controleur.php' method='POST'>";
					echo "<input type='hidden' name='id_vdm' value=" . $id_vdm . " </input>";
					$type = "like";
					echo "<input type='hidden' name='cat' value=" . $cat . " </input>";
					// on affiche le nombre de like
					echo "<button name='action' type='submit' value='put_like' class='like'><img class='like_im' src='images/like.png'></img>" . nblike($id_vdm,$type) . "</button>";
					$type = "dislike";
					// on affiche le nombre de dislike
					echo "<button name='action' type='submit' value='put_dislike' class='dislike'><img class='dislike_im' src='images/dislike.png'></img>" . nblike($id_vdm,$type) . "</button>";
				}
				// on affiche l'auteur et la date de la vdm2i
				echo "<div class='auteur' id='auteur1'> par " . $vdm2i[$i]["pseudo"] . " le " . $vdm2i[$i]["date_vdm"] . "</div>";
				echo "</form>";

			echo "</div>";
			}
			// on affiche les vdm2i choisit. dans chaque div on a la vdm2i, en dessous un boutton like et un boutton dislike et le nombre de like et de dislike. En dessous on ecrit le pseudo de l'ecrivain ainsi que la date et l'heure du post.
			?>

	</div>
			
			
	
	</body> <!--  FIN BODY -->

</html>