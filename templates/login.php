<?php

include_once("libs/fonctions.php");
// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=login");
	die("");
}

// Chargement eventuel des données en cookies
$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE"); 
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 


if(valider("date","GET"))
{
		?>
		
		<div class="alert alert-danger">
		<img src="ressources/attention.png" alt="Attention"  style="width:20px;height:20px;">
		<?php echo "Session Terminée"; ?>
		</div>
<?php }

if(valider("variable","GET"))
{
		?>
		
		<div class="alert alert-danger">
		<img src="ressources/attention.png" alt="Attention"  style="width:20px;height:20px;">
		<?php echo "Erreur d'Identifiants"; ?>
		</div>
<?php }
?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<div class="page-header" style="margin:1%"></br></br></br>
	<h1>Connexion</h1>


<p class="lead">

 <form role="form" action="controleur.php">
  <div class="form-group">
    <label for="email">Identifiant</label>
    
    <input type="text" class="form-control" id="email" name="login" value="<?php echo $login;?>" required >
  </div>
  <div class="form-group">
    <label for="pwd">Mot de passe</label>
    <input type="password" class="form-control" id="pwd" name="passe" value="<?php echo $passe;?>" required>
  </div>
  <div class="checkbox">
    <label><input type="checkbox" name="remember" <?php echo $checked;?> >&nbsp;Se souvenir de moi</label>
  </div>
  <button type="submit"class="btn btn-light"  name="action" value="Connexion" >Connexion</button>

</div>
</form>

