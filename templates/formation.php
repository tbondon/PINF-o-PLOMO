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



?>
<style type="text/css">
	
	
	
	
	.diff_formation{
		margin-left:1%; 
		margin-right:1%; 
		margin-top: 100px;
	}
	
	.form-etendu{
                margin-top:162px;
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



<div class="page-header" id="page-formation">
	
<div class="card-deck diff_formation" >
  
<?php
listerProgramme();


/*if (isAdmin($_SESSION["id_joueur"])) {
	echo "<div style='border:1px solid black;background-color:grey;'> Administration Formations :</div>";
	//ajouterProgramme();
	//modifierProgramme();

}*/


?>  

</div>
</div>