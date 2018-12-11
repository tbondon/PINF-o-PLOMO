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

if(isset($_SESSION["id_joueur"]))
	if(isAdmin($_SESSION["id_joueur"])){	

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
<style>
	
	th {

		min-width:100px;
		padding:5px;
		}
</style>

<?php

		
$id=$_SESSION["id_joueur"];
echo "<div class='page-header' id='page-admin'>";
echo "<a class='btn btn-secondary' style='margin:1%' href='./index.php?view=inscriptionadmin'>Inscrire un nouvel utilisateur</a>";
echo "</br>";
echo "<a class='btn btn-secondary' style='margin:1%' href='./index.php?view=envoyerressources'>Ajouter des ressources </a>";
?>
 
<p class="lead" style='margin:1%'>

	Opérations sur les utilisateurs :

	<table border="1" style="margin:1%; padding:2%"> 
		<thead><tr>
		<th style="padding:1%">Pseudo</th>
		<th style="padding:1%">Prenom</th>
		<th style="padding:1%">Nom</th>
		<th style="padding:1%">Mail</th>
		<th colspan="3" style="padding:1%">Opérations</th>
		</tr></thead>

<?php

	$users = listerUtilisateurs();
    foreach ($users as $dataUser) {
		$pseudo=$dataUser['pseudo_user'];
		$iduser=$dataUser['id_user'];
		$pseudoadmin=$_SESSION["id_joueur"];
		if($iduser != $pseudoadmin ){
		echo "<tr>"; 
		console_log($iduser != $pseudoadmin );
		
	
		echo "<td style='padding:1%'>	$pseudo</td>";
		echo "<td style='padding:1%'>	$dataUser[prenom_user]</td>";
		echo "<td style='padding:1%'>$dataUser[nom_user]</td>";	
		echo "<td style='padding-right:5%'>$dataUser[mail_user]</td>";

			echo "<td style='padding:1%'>";
		
			// Supprimer
	$value=$dataUser['id_user'];
echo "
	<form action=\"controleur.php\"  onSubmit=\"return confirm('Etes vous sûr de Supprimer ?');\">
	<input type=\"hidden\" style='padding:1%' name=\"id_joueur\" value=\"$value\" />
	<input class=\"btn-danger\" style='padding:1%' type=\"submit\"  name=\"action\" value=\"Supprimer\" />
	</form>";

			echo "</td>";
			
			echo "<td style='padding:1%'>";
			
	if (!$dataUser["admin"]) $action ="Rendre Admin";
				else $action="Rendre Non Admin";
				echo "
					<form action=\"controleur.php\">
					<input type=\"hidden\" name=\"id_joueur\" value=\"$value\"/>
					<input class=\"btn-warning\" type=\"submit\" name=\"action\" value=\"$action\" />
					</form>";

			echo "</td>";
			
			
			
		echo "</tr>"; 
    
		}}
?>
	</table>
</p>
<?php
}
else
	rediriger("index.php?view=acceuil");
else
	rediriger("index.php?view=acceuil");	
 


?>
