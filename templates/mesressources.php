
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

<div class="page-header" id="page-monprofil">

<style>
	
	
	.diff_formation{
	margin-left:1%; 
	margin-right:1%; 
	margin-top: 100px;
	}
	
	.page-header{
		margin-top:100px;
	}
	
	.profil-etendu{
                margin-top:162px;
        }
	
	/**
	.div_center{width:100%;display: block;margin:auto;position: relative; height: 100px;} 
	.div_center div{ width: 50%; background:red;display: block;margin:auto;float:left; height:100%}
	**/
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
		$('#page-monprofil').addClass('profil-etendu');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#page-monprofil').removeClass('profil-etendu');
	     
	    }
	  });
	});
</script>

<?php
if(isset($_SESSION["id_joueur"]))
{
	if(valider("variable","GET"))
	{
			?>
			
			<div class="alert alert-danger" style="margin-top:80px;" >
			<img src="ressources/close.png" alt="Attention"  style="width:20px;height:20px;margin:5px;">
			<?php echo "Erreur lors de la suppression"; ?>
			</div>
	<?php }	
	if(valider("var","GET"))
	{
			?>
			
			<div class="alert alert-succes" style="margin-top:80px;" >
			<img src="ressources/check.png" alt="Attention"  style="width:20px;height:20px;margin:5px;">
			<?php echo "Suppression Réussi"; ?>
			</div>
	<?php }
	
	?>







	

<?php 
	echo "<div class='form_mdp'> <h2 style='text-align:center;margin-bottom:20px;'> Mes fichiers:</h2>";
	echo "<div class='info_contact' style='width:100%;'>";
	
			$id=$_SESSION['id_joueur'];
			$SQL="SELECT * FROM ressources where id_user='$id'";
			$prog = parcoursRs(SQLSelect($SQL));
			echo '<ul>';
			foreach ($prog as $dataProg)
			{
			         $id_ressource=$dataProg['id_ressource'];
			         $pdf=$dataProg['chemin_ressource'];
				$nom=$dataProg['nom_ressources'];	
				echo "<form  enctype=\"multipart/form-data\" method=\"post\"  onSubmit=\"return confirm('Etes vous sûr de valider ?');\" action=\"controleur.php\"  >";
				echo '<li>';
				echo "<input type=\"hidden\" name=\"id_ressource\" value=\"$id_ressource\">";
				echo "<label>Titre : <span>$nom </span> </label>" ;
				echo"<label>Fichiers : <a href='$pdf' target=\"_blank\" >Ouvrir</a></label>";
				echo "<button type=\"submit\" value=\"Supprimer cette ressource\" name=\"action\">
                                             <img src=\"ressources/Croix.png\" style='width:10px;height:10px;'/>
                                             </button>";
				echo '</li><hr>';
				
			         
				echo "</form>";
			}
	                  echo '</ul>';
	
                  echo "</div></div>";
}
else
	rediriger("index.php?view=acceuil");
?>    

</div>			