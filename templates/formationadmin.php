
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

?>
<style type="text/css">
	
	
	.form-etendu{
                margin-top:62px;
         }
         
         input[type=submit]:hover, input[type=reset]:hover {
 		background-color:#9FC8F7;
 	}
 	
	input[type=submit]:active, input[type=reset]:active {
 		background-color:#9FC8F7;
 		box-shadow:1px 1px 1px #3E90F0 inset;
	}
	
	textarea, select, option {
 		background-color:#E7F1FD;
 		border-radius: 5px;
 		
	}
	
	input{
		background-color:#EDF4FE;
		border-radius: 5px;
		cursor:pointer;
	}
	
	input,label{
		margin-top:1%;
		margin-bottom:1%;
	}
	
	#creaformation{
		border: 1px solid black;
		border-radius: 5px;
		margin-top:2%;
		margin-bottom:2%;
		margin-left:10%; 
		margin-right:10%;
		background-color:#F09E3E;
	}
	
	textarea{
		width:50%;
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
		$('#page-formation').addClass('form-etendu');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#page-formation').removeClass('form-etendu');
	     
	    }
	  });
	});
</script>

<?Php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

if(isset($_SESSION["id_joueur"]))
	if(isAdmin($_SESSION["id_joueur"])){	
			
echo "<div class='page-header' id='page-formation'>";

	echo "<center><div style=\"background-color:lightgrey;\">
				<img style=\"margin:5px;width:50px;height:50px;\" src='ressources/attention.png' alt=\'Image'  >
				En tant qu'Administrateur de ce site vous pouvez modifier cette page ci-dessous.
				";

	echo "</br>Pour voir l'affichage normal veuillez cliquer ici: </br>";
	?>
	</br>
	<form enctype="multipart/form-data" method="post" action="controleur.php">
					<input type="submit" value="Affichage Formation visiteur" name="action">
	</form>
	</br>
	</div>
	</center>
<?php
listerProgrammeAdmin();


?>

<div style="text-align:center" id="creaformation" >
<br><h4>Ajouter une formation:</h4><br>
<form enctype="multipart/form-data" method="post" action="controleur.php">
					<label>Titre : </label>
					<input type="text" name="nomFormation">
					<label>Description : </label>
					<input type="text" name="descriptionFormation">
					<label>Session : </label>
					<input type="text" name="sessionFormation">
					<label>Choisir le pdf : </label>
					<input type="file" name="file[]">
					<label>Choisir l'image : </label>
					<input type="file" name="file[]" accept="image/*">
					</br>
					<input type="submit" value="Ajouter Une Formation" name="action">
	</form>
</div>

<?php
echo "</div>";

}
else
	rediriger("index.php?view=formation");
else
	rediriger("index.php?view=formation");	
?>    
