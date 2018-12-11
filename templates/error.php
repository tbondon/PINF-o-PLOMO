<?php

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php"; 
include_once "libs/modele.php";

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=homepage");
}

// Chargement eventuel des données en cookies
$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE"); 
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 

?>
<style>
html{
	margin:0;
  padding:0;
  background: url(ressources/legoerror.jpg) no-repeat center fixed; 
/*  -webkit-background-size: cover; /* pour anciens Chrome et Safari */
 /* background-size: cover; /* version standardisée */ 
  
}

 </style>
<html> <!--  HTML -->
	<head> <!--  HEAD -->
		<meta charset="utf-8">
			<link media="screen" type="text/css" rel="stylesheet" href="css/error.css"></link>
	</head> <!--  FIN HEAD -->

	<body> <!--  BODY -->
<center><h1>ERREUR 404</h1></center>
	</body> <!--  FIN BODY -->

</html>