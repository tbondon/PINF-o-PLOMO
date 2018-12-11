<?php

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php"; 
include_once "libs/modele.php";
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


?> 
<?php
	if(isset($_SESSION["id_joueur"]))
		if(isAdmin($_SESSION["id_joueur"]))
		{?>


<style type="text/css">
	.page-header{
		margin-top : 50px;
	}
	.quizz-etendu{
                margin-top:112px;
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

<div class="page-header" id="page-quizz"  style="margin-left:2%;margin-right:2%;">
<h1 style="text-align:center">Modifier</h1>

<form action="controleur.php" method="POST">

	<div>		          
		<label for="subject">
			<span>Quizz :</span>
			<select id="sujet" name="quizz"> 
			<?php
				$quizz = select_quizz();

				$max = count($quizz);
				for ($i=0; $i < $max ; $i++)
					{
						$id=$quizz[$i]['id_quizz']+1;
						echo "<option value='".$id."'>".$quizz[$i]['nom_quizz']."</option>";
					}
					// On affiche les différentes catégories suivant lesquelles sont classés les vdm2i
			?>  
			</select>

		</label>
	</div>
	<button name="action" type="submit" id="submit" value="supp_quizz">supprimer</button> 
</form>
<?php }
?>