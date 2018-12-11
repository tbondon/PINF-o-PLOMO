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
<style type="text/css">
	.page-header{
		margin-top : 100px;
	}
</style>
<div class="page-header" style="margin-left:2%;margin-right:2%;">
<?php
	if(isset($_SESSION["id_joueur"]))
		if(isAdmin($_SESSION["id_joueur"]))
		{?>
		<h1 style="text-align:center">Créer</h1>
		
		<form action="controleur.php" method="POST">
			<div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <label class="input-group-text" for="inputGroupSelect01">Programme</label>
			  </div>
			  <select class="custom-select" id="inputGroupSelect01" name="programme">
			  	<?php
			  	$programme = selectprogramme();
		
				$max = count($programme);
				for ($i=0; $i < $max ; $i++)
					{
						$id=$programme[$i]['id_programme']+1;
						echo "<option value='".$id."'>".$programme[$i]['nom_programme']."</option>";
					}
					// On affiche les différentes catégories suivant lesquelles sont classés les vdm2i
					?> 
			  </select>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-default">Nom</span>
				</div>
				<input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="nom" required>
			</div>
		
			<button class="btn btn-outline-secondary" name="action" type="submit" id="submit" value="soumettre">Créer mon quizz</button> 
		</form>
		<?php }?>
</div>