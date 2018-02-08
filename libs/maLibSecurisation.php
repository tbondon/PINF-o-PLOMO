<?php

include_once "maLibUtils.php";	// Car on utilise la fonction valider()
include_once "modele.php";	// Car on utilise la fonction connecterUtilisateur()

/**
 * @file login.php
 * Fichier contenant des fonctions de vérification de logins
 */

/**
 * Cette fonction vérifie si le login/passe passés en paramètre sont légaux pour un user
 * Elle stocke les informations sur la personne dans des variables de session : session_start doit avoir été appelé...
 * Infos à enregistrer : pseudo, idUser, heureConnexion, isAdmin,mail
 * Elle enregistre l'état de la connexion dans une variable de session "connecte" = true
 * @pre login et passe ne doivent pas être vides
 * @param string $login
 * @param string $password
 * @return false ou true ; un effet de bord est la création de variables de session
 */
function verifUser($login,$password)
{
	$id = verifUserBdd($login,$password);

	if (!$id) return false; 

	// Cas succès : on enregistre pseudo, idUser dans les variables de session 
	// il faut appeler session_start ! 
	// Le controleur le fait déjà !!
	$_SESSION["pseudo"] = $login;
	$_SESSION["idUser"] = $id;
	$mail= selectmail($id);
	$_SESSION["mail"] = $mail;
	$_SESSION["connecte"] = true;
	$_SESSION["heureConnexion"] = date("H:i:s");
	$_SESSION["admin"] = 0;
	return true;
	
}

/**
 * Cette fonction vérifie si le login/passe passés en paramètre sont légaux pour un admin 
 * Elle stocke les informations sur la personne dans des variables de session : session_start doit avoir été appelé...
 * Infos à enregistrer : pseudo, idUser, heureConnexion, isAdmin, mail
 * Elle enregistre l'état de la connexion dans une variable de session "connecte" = true
 * @pre login et passe ne doivent pas être vides
 * @param string $login
 * @param string $password
 * @return false ou true ; un effet de bord est la création de variables de session
 */

function verifadmin($login,$password)
{
	
	
	$id = verifadminBdd($login,$password);

	if (!$id) return false; 
	
	// Cas succès : on enregistre pseudo, idUser dans les variables de session 
	// il faut appeler session_start ! 
	// Le controleur le fait déjà !!
	$_SESSION["pseudo"] = $login;
	$_SESSION["idUser"] = $id;
	$mail= selectmail($id);
	$_SESSION["mail"] = $mail;
	$_SESSION["connecte"] = true;
	$_SESSION["heureConnexion"] = date("H:i:s");
	$_SESSION["admin"] = 1;
	return true;
}

// cette fonction vérifie la concordance entre le pseudo et l'email saisie 
// si le couple existe il renvoie true sinon il renvoie false
function verifPseudo($pseudo,$mail)
{
	
	$id = verifPseudoBdd($pseudo,$mail);

	if (!$id) return false; 
	return true;
	
}

// cette fonction verifie si l'adresse mail en parametre existe ou non
// si elle existe on renvoie true sinon false
function  test_mail($mail)
{
	$id = test_mailBdd($mail);
	if (!$id) return false;
	return true;
}

// cette fonction verifie si le pseudo en parametre existe ou non
// si il existe on renvoie true sinon false
function  test_pseudo($pseudo)
{
	$id = test_pseudoBdd($pseudo);
	if (!$id) return false;
	return true;
}




/**
 * Fonction à placer au début de chaque page privée
 * Cette fonction redirige vers la page $urlBad en envoyant un message d'erreur 
	et arrête l'interprétation si l'utilisateur n'est pas connecté
 * Elle ne fait rien si l'utilisateur est connecté, et si $urlGood est faux
 * Elle redirige vers urlGood sinon
 */
function securiser($urlBad,$urlGood=false)
{
	if (! valider("connecte","SESSION")) {
		rediriger($urlBad);
		die("");
	}
	else {
		if ($urlGood)
			rediriger($urlGood);
	}
}

// on verifie si la vdm2i à été modéré (retourne true) ou non (retourne false)
function verifmoderation($id_vdm)
{
	
	$moderation = verifmoderationBdd($id_vdm);

	if (!$moderation) return false; 
	return true;
	
}



?>
