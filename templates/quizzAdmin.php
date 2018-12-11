<?php
include_once("libs/fonctions.php");
include_once("libs/modele.php");
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


?> 
<style type="text/css">
	.page-header{
		margin-top : 50px;
	}
	.quizz-etendu{
                margin-top:112px;
        }
        .btn{
        	color:black;
        }
        
</style>

<script>
	$(document).ready(function() {
		  //change the integers below to match the height of your upper dive, which I called
		  //banner.  Just add a 1 to the last number.  console.log($(window).scrollTop())
		  //to figure out what the scroll position is when exactly you want to fix the nav
		  //bar or div or whatever.  I stuck in the console.log for you.  Just remove when
		  //you know the position.
		$(window).scroll(function () { 
		
				
		
			if ($(window).scrollTop() > 100) {
				$('#page-quizz').addClass('quizz-etendu');
			}
		
			if ($(window).scrollTop() < 101) {
				$('#page-quizz').removeClass('quizz-etendu');
		      
			}
		});
	});
</script>

<div class="page-header" id="page-quizz">
<?php
	if(isset($_SESSION["id_joueur"]))
		if(isAdmin($_SESSION["id_joueur"]))
		{
		$desac=0;
		if($desac !=1)
		{?>
	<h1 style="text-align:center">Partie administrateur - QUIZZ</h1>
	<center>
	<div class="btn-group btn-group-justified" style="margin-top:3%; text-align:center;">
	  <a href="index.php?view=creerQuizz" class="btn " style="background-color:#F09E3E">Créer un nouveau quizz</a>
	  <a href="index.php?view=modifier" class="btn " style="background-color:#F09E3E">Modifier un quizz</a>
	  <a href="index.php?view=quizz" class="btn " style="background-color:#F09E3E">Tester un quizz</a>
	  <a href="index.php?view=resultat" class="btn " style="background-color:#F09E3E">Consulter les résultats</a>
	   <a href="index.php?view=supprimer" class="btn " style="background-color:#F09E3E">Supprimer un quizz</a>
	</div>
	</center>
	<?php }}?>
</div>
	
