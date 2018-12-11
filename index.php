<?php
session_start();
/*
Cette page génère les différentes vues de l'application en utilisant des templates situés dans le répertoire "templates". Un template ou 'gabarit' est un fichier php qui génère une partie de la structure XHTML d'une page. 
La vue à afficher dans la page index est définie par le paramètre "view" qui doit être placé dans la chaîne de requête. En fonction de la valeur de ce paramètre, on doit vérifier que l'on a suffisamment de données pour inclure le template nécessaire, puis on appelle le template à l'aide de la fonction include
Les formulaires de toutes les vues générées enverront leurs données vers la page data.php pour traitement. La page data.php redirigera alors vers la page index pour réafficher la vue pertinente, généralement la vue dans laquelle se trouvait le formulaire. 
*/


	include_once "libs/maLibUtils.php";
	include_once "libs/maLibBootstrap.php";



	// on récupère le paramètre view éventuel 
	$view = valider("view"); 
	/* valider automatise le code suivant :
	if (isset($_GET["view"]) && $_GET["view"]!="")
	{
		$view = $_GET["view"]
	}*/

	// S'il est vide, on charge la vue accueil par défaut
	if (!$view) $view ="accueil";

	// NB : il faut que view soit défini avant d'appeler l'entête
	// Dans tous les cas, on affiche l'entete, 
	// qui contient les balises de structure de la page, le logo, etc. 
	// Le formulaire de recherche ainsi que le lien de connexion 
	// si l'utilisateur n'est pas connecté 

	/*include("templates/header2.php");*/
	if (file_exists("templates/$view.php")) include("templates/header.php");
	// En fonction de la vue à afficher, on appelle tel ou tel template
	switch($view)
	{		

		case "accueil" : 
			include("templates/accueil.php");
		break;
		case "formation" :
			include("templates/formation.php");
			break;
		case "formationadmin" :
			include("./templates/formationadmin.php");
			break;
		case "faq" :
			include("./templates/faq.php");
			break;
		case "article" : 
			include("./templates/actualite.php");
			break;
		case "creerArticleAdmin" :
			include("./templates/creerArticleAdmin.php");
			break;
		case "modifier" : 
			include("./templates/modifier.php");
			break;
		case "pagestatadmin" : 
			include("./templates/pagestatadmin.php");
			break;
		case "pagestat" : 
			include("./templates/pagestat.php");
			break;
		case "contact" : 
			include("./templates/contact.php");
			break;
		 case "quizzAdmin" :
		 	include("./templates/quizzAdmin.php");
		 	break;
		 case "creerQuizz" :
		 	include("./templates/creerQuizz.php");
		 	break;
		 case "quizz" :
		 	include("./templates/quizz.php");
			break;
		case "resultat" :
			include("./templates/resultat.php");
			break;
		case "supprimer" :
			include("./templates/supprimer.php");
			break;
		case "login" :
			include("./templates/login.php");
			break;

			
		default : // si le template correspondant à l'argument existe, on l'affiche
			if (file_exists("templates/$view.php"))
				include("templates/$view.php");
			else include("templates/error.php");

	}


	// Dans tous les cas, on affiche le pied de page
	// Qui contient les coordonnées de la personne si elle est connectée
	if (file_exists("templates/$view.php")) include("templates/footer.php");
?>








