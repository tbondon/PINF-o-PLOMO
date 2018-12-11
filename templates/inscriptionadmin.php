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
			
			<div class="alert alert-success" style="margin-top:80px;" >
			<img src="ressources/check.png" alt="Attention"  style="width:20px;height:20px;margin:5px;">
			<?php echo "Utilisateur Inscrit avec succès"; ?>
			</div>
	<?php }
if(valider("variable","GET"))
	{
			?>
			
			<div class="alert alert-danger" style="margin-top:80px;" >
			<img src="ressources/close.png" alt="Attention"  style="width:20px;height:20px;margin:5px;">
			<?php echo "Echec de l'inscription"; ?>
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


<div class="page-header" id='page-admin' >
	<h1>Inscription d'un nouvel utilisateur :</h1>

 <form role="form" action="controleur.php" method="POST">
  <div class="form-group">
    <label >Login</label>
    <input type="text" class="form-control" name="login" required>
  </div>
  <div class="form-group">
    <label >Passe</label>
    <input type="password" class="form-control"name="passe" required>
  </div>
   <div class="form-group">
    <label></label> Nom  </label>
    <input type="text" class="form-control"name="nom"required>
  </div>
  <div class="form-group">
    <label></label> Prénom </label>
    <input type="text" class="form-control" name="prenom"  required>
  </div>
  <div class="form-group">
    <label></label> Matricule </label>
    <input type="text" class="form-control" name="matricule" required>
  </div>
  <div class="form-group">
    <label> Mail</label>
    <input type="text" class="form-control"name="mail" required >
  </div>
  
    <div class="form-group">
    <label> Date fin validite </label>
    <input type="date" class="form-control"name="date" required>
  </div>
  <div class="form-group" style="background-color:#E9967A;">
   <img src="ressources/attention.png" alt="img" style="width:20px;height:20px;" >
  Admin ?
  <br />

    <input type="radio" name="admin" value="1" />OUI 
    <input type="radio" name="admin" value="2" checked="checked" />NON

</div>
  <div class="form-group">
    <label> Programme ? </label>
     
        <?php listerMenuDeroulant(); ?>
 
</div>
  </br><button type="submit" name="action" value="Inscription" class="btn btn-default" required>Inscription</button>
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
