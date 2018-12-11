<body style="background-color:white; background-size: cover;">
	<link rel="stylesheet" href="css/footer.css" />
	
	
	
	
	<style type="text/css">
		
		.boutonsSelection{
			margin:0 auto;
		}
		
		.cv-etendu{
                		margin-top:94px;
        		}
        		
        		.titre_CV{
        			margin-top:60px;
        			margin-left:1rem!important;
        		}
        	
        		
        		.bouton-envoyer{
        			margin-left:1rem!important;
        		}
	</style>
	
	
	
	
	<script >
        $(document).ready(function() {
	  //change the integers below to match the height of your upper dive, which I called
	  //banner.  Just add a 1 to the last number.  console.log($(window).scrollTop())
	  //to figure out what the scroll position is when exactly you want to fix the nav
	  //bar or div or whatever.  I stuck in the console.log for you.  Just remove when
	  //you know the position.
	  $(window).scroll(function () { 
	
	    console.log($(window).scrollTop());
	
	    if ($(window).scrollTop() > 100) {
		$('#page-cv').removeClass('cv-etendu');
		$('#page-cv').addClass('cv-etendu');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#page-cv').removeClass('cv-etendu');
	     
	    }
	  });
	});
	</script>
	
	
<?php
include_once("libs/modele.php");
include_once("libs/fonctions.php");

//C'est la propriété php_self qui nous l'indique : 
// Quand on vient de index : 
// [PHP_SELF] => /chatISIG/index.php 
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/accueil.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

echo "<div class='page-header' id='page-cv'>";

?>

<?php
	$categorie=valider("categorie","GET");

	
	


	echo "<form enctype=\"multipart/form-data\" id='pagecv' style='margin-top:30px;' class='cv' method=\"post\" action=\"controleur.php\">";
		echo "<input type=\"hidden\" name=\"formation\" value=\"\" >	";
		echo "<button class='btn btn-outline-primary' style='margin-left:30px;margin-top:1rem!important;' type='submit' name='action' value=\"Choix Formation CV\"> Tous </button>";
		echo "</form >";
	$select = parcoursRs(SQLSelect("select formation_diplome from cvtheque group by formation_diplome "));
	foreach ($select as $dataSelect)
		{
		$formation=$dataSelect['formation_diplome'];
		if ($formation == "Préparation au titre de Secrétaire Assistante")
			$formationAux="Secrétaire Assistante";
		if ($formation == "Préparation au titre de Secrétaire Comptable")
			$formationAux="Secrétaire Comptable";
		if ($formation == "Préparation au TOSA")
			$formationAux="TOSA";
		echo "<form enctype=\"multipart/form-data\" id='pagecv' class='cv' method=\"post\" action=\"controleur.php\">";
		echo "<input type=\"hidden\" name=\"formation\" value=\"$formation\">	";
		echo "<button class='btn btn-outline-primary' style='margin-left:30px;margin-top:1rem!important; type='submit' name='action' value=\"Choix Formation CV\"> $formationAux </button>";
		echo "</form >";
	
		}
	
	


echo"<div class='row' style='margin-left:1rem!important; margin-right:1rem!important; margin-top:50px'>";

if($categorie=valider("categorie","GET")){
	listerCVtheque($categorie);
}
else
	listerCVtheque();




echo "</div>";
?>  