<?php
// inclure ici la librairie faciliant les requêtes SQL
include_once("maLibSQL.pdo.php");
	/////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////
	//				Cette fonction liste les differents programme du site .			   //
	/////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////
function listerProgramme()
{
	$SQL="SELECT * FROM programme";
	$prog = parcoursRs(SQLSelect($SQL));
	foreach ($prog as $dataProg)
	{
		echo "<br>";
		echo "<div class='card  mb-3'>";
		$id=$dataProg['id_programme'];
		$nom=$dataProg['nom_programme'];
		$pdf=$dataProg['pdf_programme'];
		$image=$dataProg['photo_programme'];
		$description=$dataProg['description_programme'];
		$session=$dataProg['session_programme'];

		echo "<img class='card-img-top ' src='$image' alt=\'Image1'>";
			echo "<div class='card-body '>";
				echo "<h5 class='card-title text-primary'>$nom</h5>";
				
				echo "<p class='card-text text-dark' style='text-align: justify;'>$description</p>";
			echo "</div>";
			echo"<div class='card-footer bg-transparent '>";
				echo"<a href='$pdf' target=\"_blank\" class='btn btn-outline-primary btn-lg btn-block'>En savoir plus</a></br>";
				echo"<h5 style='color:#C20069;text-align:center;font-weight:bold;'>$session</h5>";
			echo"</div>";
		echo"</div>";
	}
}
	/////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////
	//		Cette fonction liste les differents programme du site .	Modifiable		   //
	/////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////

function listerProgrammeAdmin()
{
	$SQL="Select * from programme";
	//return parcoursRs(SQLSelect($SQL));
	//$prog = listerProgramme() ;
	$prog = parcoursRs(SQLSelect($SQL));
	foreach ($prog as $dataProg)
	{
		echo "<br>";
		echo "<div style='padding-top:1%;border:1px solid black; border-radius: 10px;text-align:center; margin-left:10%; margin-right:10%; padding-top:1%;padding-bottom:1%;'>";

		$id=$dataProg['id_programme'];
		$nom=$dataProg['nom_programme'];
		$pdf=$dataProg['pdf_programme'];
		$image=$dataProg['photo_programme'];
		$description=$dataProg['description_programme'];
		$session=$dataProg['session_programme'];

		echo "<form enctype=\"multipart/form-data\" method=\"post\"  onSubmit=\"return confirm('Etes vous sûr de valider ?');\" action=\"controleur.php\"  >
		<img src='$image' style='width:25% ;heigh:auto; margin-bottom:1%' alt=\'Image1'  >
		<input type=\"hidden\" name=\"id\" value=\"$id\">
		<br><textarea  style=\"resize:none;\"  name=\"nom\"  rows=3>$nom</textarea><br>
		<br><b><textarea style=\"resize:none;\"  name=\"description\"  rows=3>$description</textarea></b><br>
		<br>
		<textarea style=\"resize:none;margin-bottom:1%;\"  name=\"session\"  rows=3>$session</textarea><br>
		<div style=\"background-color:#3EF09E;margin:auto;padding-top:1%;padding-bottom:1%; width:50%; border-radius: 5px;\">N'oubliez pas de valider ci dessous. </div>
		<input style='margin-top:1%; margin-bottom:1%' type=\"submit\" value=\"Modifier les champs\" name=\"action\">
		<br><a href='$pdf' target='_blank' style='padding:0.2%;background-color:#9E3EF0;cursor:pointer; border-radius: 5px; text-decoration:none;color:white;'>Voir le programme</a><br></form>";

			echo "<br><form enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return confirm('Etes vous sûr de valider le changement d'image ?');\" action=\"controleur.php\">
					<label>Changer l'image : </label>
					<input type=\"hidden\" name=\"id\" value=\"$id\">
					<input type=\"file\" name=\"FileToUpload\" accept=\"image/*\">
					<input type=\"submit\" value=\"Uploader\" name=\"action\">
					</form>";
			echo "<br><form enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return confirm('Etes vous sûr de valider le changement de pdf ?');\" action=\"controleur.php\">
					<label>Changer le pdf : </label>
					<input type=\"hidden\" name=\"id\" value=\"$id\">
					<input type=\"file\" name=\"FileToUpload\">
					<input type=\"submit\" value=\"Uploader2\" name=\"action\"></form>";

			echo "<br><form enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return confirm('Etes vous sûr de supprimer ce programme ?');\" action=\"controleur.php\">
					<input type=\"hidden\" name=\"id\" value=\"$id\">
					<input type=\"submit\" value=\"Supprimer cette Formation\" name=\"action\">
					</br>
					</form>";
		echo "</div>";
    }
}


function afficherpdfadmin()
{
	$pdf = SQLGetChamp("Select text_stat from stat where id_stat=1");
	echo "<iframe src='$pdf' style=\"height:60%\"></iframe>";
		echo "<br><form enctype=\"multipart/form-data\" method=\"post\" action=\"controleur.php\">;
					<label>Changer le pdf : </label>
					<input type=\"hidden\" name=\"id\" value=\"$id\">
					<input type=\"file\" name=\"FileToUpload\">
					<input type=\"submit\" value=\"Modifier PDF Stat\" name=\"action\">
					</form>";
}


function listerMenuDeroulant(){
	$SQL="Select nom_programme from programme";
	$prog = parcoursRs(SQLSelect($SQL));
	echo "<SELECT name='programme'>";
	foreach ($prog as $dataProg){
		$var=$dataProg['nom_programme'];
		console_log($var);
		echo "<OPTION value='$var'> $var</OPTION>" ;
	}
	 
echo "</SELECT>";
}
function listerPersonneMenuDeroulant()
{
	$SQL="Select * from users";
	$prog = parcoursRs(SQLSelect($SQL));
	echo "<SELECT name='user'>";
	foreach ($prog as $dataProg){
		$varid=$dataProg['id_user'];
		$var=$dataProg['nom_user'];
		$var2= $dataProg['prenom_user'];
		$var3= $var . " " .$var2 ;
		echo "<OPTION value='$varid'> $var3</OPTION>" ;
	}
	 
echo "</SELECT>";
}
//function listercvtheque($categorie)
function listercvtheque($categorie)
{
		if(!$categorie)
			$SQL="Select * from cvtheque";
		else{
		$SQL="Select * from cvtheque where formation_diplome='$categorie'";
		}
		$prog = parcoursRs(SQLSelect($SQL));
		foreach ($prog as $dataProg)
		{
				$id=$dataProg['id_cv'];
				$nom=$dataProg['nom_diplome'];
				$pdf=$dataProg['pdf_diplome'];
				$prenom=$dataProg['prenom_diplome'];
				$description=$dataProg['formation_diplome'];
				if ($description == "Préparation au titre de Secrétaire Assistante")
					$description="Secrétaire Assistante";
				if ($description == "Préparation au titre de Secrétaire Comptable")
					$description="Secrétaire Comptable";
				if ($description == "Préparation au TOSA")
					$description="TOSA";
				echo "<br>";
				echo"<div class='col-sm-4'>";
					echo "<div class='card text-white bg-light border-secondary mb-3'>";
						echo "<div class='card-body' >";
							echo "<h5 class='card-title tex-primary' style='color:#5e92e4; text-align:center;'>$nom</h5>";
							echo "<h5 class='card-title tex-primary'  style='color:#5e92e4; text-align:center;'>$prenom</h5>";
							echo "<p class='card-text text-dark' style='text-align: justify; text-align:center;color:white;'>$description</p>";
						echo "</div>";
						echo"<div class='card-footer bg-light'>";
							echo"<a href='$pdf' target=\"_blank\" class='btn btn-primary btn-lg btn-block'>Découvrir le CV</a></br>";
						echo"</div>";
					echo"</div>";
			echo"</div>";
		}	
		
}
function listercvthequeAdmin()
{
	echo "<center>";
	$SQL="Select * from cvtheque";
	$prog = parcoursRs(SQLSelect($SQL));
	foreach ($prog as $dataProg)
	{
		echo "<br>";

		$id=$dataProg['id_cv'];
		$nom=$dataProg['nom_diplome'];
		$pdf=$dataProg['pdf_diplome'];
		$image=$dataProg['prenom_diplome'];
		$description=$dataProg['formation_diplome'];
		if ($description == "Préparation au titre de Secrétaire Assistante")
			$description="Secrétaire Assistante";
		if ($description == "Préparation au titre de Secrétaire Comptable")
			$description="Secrétaire Comptable";
		if ($description == "Préparation au TOSA")
			$description="TOSA";
		
		echo"<div class='col-sm-4'>";
					echo "<div class='card text-white border-secondary mb-3'>";
						echo "<div class='card-body' >";
							echo "<h5 class='card-title tex-primary' style='color:rgba(79, 144, 233, 0.98); text-align:center;'>$nom</h5>";
							echo "<h5 class='card-title tex-primary'  style='color:rgba(79, 144, 233, 0.98); text-align:center;'>$prenom</h5>";
							echo "<p class='card-text text-dark' style='text-align: justify; text-align:center;color:white;'>$description</p>";
						echo "</div>";
						echo"<div class='card-footer bg-transparent border-secondary'>";
						echo"<a href='$pdf' target=\"_blank\" class='btn btn-outline-primary btn-lg btn-block'>Découvrir le CV</a></br>";
						echo"</div>";
			
		echo "<br><center><form enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return confirm('Etes vous sûr de supprimer ce CV ?');\" action=\"controleur.php\">
			<input type=\"hidden\" name=\"id\" value=\"$id\">
			<input type=\"submit\" value=\"Supprimer ce CV\" name=\"action\">
			</br>
			</form></center>";
			echo"</div>";
			echo"</div>";
		
    }
    echo "</center>";
}
function listermonProfil()
{
	$id=$_SESSION['id_joueur'];
	$SQL="SELECT * FROM users where id_user='$id'  ";
	$prog = parcoursRs(SQLSelect($SQL));
	foreach ($prog as $dataProg)
	{	
		
		$i=0;
		$pseudo=$dataProg['pseudo_user'];
		$nom=$dataProg['nom_user'];
		$prenom=$dataProg['prenom_user'];
		$mail=$dataProg['mail_user'];
		$matricule=$dataProg['id_matricule'];
		$nom_du_programme=$dataProg['nom_programme'];
		$mdp=$dataProg['mdp_user'];
		
		while($pseudo[$i])
		{	$i++;
		}
		
	
		
		echo "<div class='form_mdp'> <h2>Mon profil</h2>
		<div class='info_contact'>
		<h3>Informations générales</h3>
		<label>Formation : ";
		echo "<span>$nom_du_programme</span></label>";
		echo "<label>Pseudo : ";
		echo "<span>$pseudo</span></label>";
		echo "<label>Nom : ";
		echo "<span>	$nom</span></label>";
		echo "<label>Prenom : ";
		echo "<span>$prenom</span></label>";
		echo "<label>Adresse mail : ";
		echo "<span>$mail</span></label>";
		echo "<label>Numéro de matricule : ";
		echo "<span>$matricule</span></label></div>";
		echo "<form class='changement_mdp' enctype=\"multipart/form-data\" method=\"post\"  onSubmit=\"return confirm('Etes vous sûr de valider ?');\" action=\"controleur.php\"  >
		
		<input type=\"hidden\" name=\"id\" value=\"$id\">
		
		<h3>Changement  mot de passe</h3>
		<label>Ancien Mot de passe  :</label>
		<input type=\"password\" name=\"ancienmdp\" required >
		<label>Nouveau Mot de passe  :</label>
		<input type=\"password\" name=\"mdp\" required>
	
			<label>Confirmer Nouveau Mot de passe :</label>
		<input type=\"password\" name=\"mdpCheck\"required >
		<input type=\"submit\" value=\"Modifier le mdp\" name=\"action\">";
		
		echo "</form>
		<div style='clear_both'></div></div>";
			
	}
}
?>

<style> 



.changement_mdp{}
.changement_mdp label{
	min-width: 250px; 
	text-align:left;
	
}

.form_mdp label{
	display: block;
	
}

.form_mdp h2 {
	margin:15px 0;
	display: block; 
	line-height: 1.5em; 
	padding: 0 10px 
}

.form_mdp  h3 {}

.form_mdp label span { 
	font-weight:bold; 
	color:#627F91; 
	margin-left: 7px
}

.form_mdp{
	display: block;
	width:75%;  
	margin:auto; 
	background:#D0EDF7
	
}

.form_mdp div, .form_mdp form  {
	display:block; 
	position: relative; 
	float:left;
	width:50%; 
	height: 100%
	
}

.info_contact{
	display: block; 
	float:left;
}


@media screen and (max-width:762px) {
	
	.form_mdp div, .form_mdp form  {display:block; position: relative; float:left;width:100%!important; height: 100%}
	.form_mdp h2 {margin:15px 0;display: block; line-height: 1.5em; padding: 0 10px }
	.changement_mdp { margin-top: 20px }
	
}




iframe {
    width: 65%;
    height: 70%;
    margin:auto;
    display:block;
    background-color: #777;
}




</style>
