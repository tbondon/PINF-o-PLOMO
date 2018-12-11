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
if(valider("var","GET"))
	{
			?>
			
			<div class="alert alert-danger" style="margin-top:80px;" >
			<img src="ressources/close.png" alt="Attention"  style="width:20px;height:20px;margin:5px;">
			<?php echo "Error lors du transfert"; ?>
			</div>
	<?php }
if(valider("variable","GET"))
	{
			?>
			
			<div class="alert alert-succes" style="margin-top:80px;" >
			<img src="ressources/check.png" alt="Attention"  style="width:20px;height:20px;margin:5px;">
			<?php echo "Envoie réussi"; ?>
			</div>
	<?php }
if(isset($_SESSION["id_joueur"]))
	if(isAdmin($_SESSION["id_joueur"])){	
			
console_log(date('Y-m-d'));
?>

<style type="text/css">
		
		
		.cv-admin{
                		margin-top:62px;
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
		$('#page-admin').removeClass('cv-admin');
		$('#page-admin').addClass('cv-admin');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#page-admin').removeClass('cv-admin');
	     
	    }
	  });
	});
	
</script>

<div class="page-header" id='page-admin' style="margin-left:1%">
	<h1>Envoyer des ressources :</h1>

 <form enctype="multipart/form-data" method="post" action="controleur.php">
  <div class="form-group">
    <label >Nom de l'utilisateur:</label>
     <?php listerPersonneMenuDeroulant(); ?>
    </div>
    <div class="form-group">
    <label >Titre du fichier:</label>
     	<input type="text" name="nom" required>
    </div>
    </br><label>Choisir le fichier: </label>
         <input type="file"  name="FileToUpload" required>
</br>
  <input type="submit" value="Envoyer Ressources" name="action">
</form>

</p>
</div>
<?php
echo "</div>";

}
else
	rediriger("index.php?view=acceuil");
else
	rediriger("index.php?view=acceuil");	
?>    
