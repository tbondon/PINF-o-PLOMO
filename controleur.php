<?php

	session_start();

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php"; 

	$addArgs = "";
	if ($action = valider("action"))
	{
		ob_start ();
		echo "Action = '$action' <br />";
		switch ($action)
		{
			// Connection ///////////////////////////////////////////////////
			case 'Connexion' :
				// On verifie la presence des champs login et passe
				if ($login = valider("login"))
				if ($passe = valider("passe"))
				{
					if (verifadmin($login,$passe))
					{
						if (valider("remember")) 
						{
							setcookie("login",$login , time()+60*60*24*30);
							setcookie("passe",$password, time()+60*60*24*30);
							setcookie("remember",true, time()+60*60*24*30);
						} 
						else 
						{
							setcookie("login","", time()-3600);
							setcookie("passe","", time()-3600);
							setcookie("remember",false, time()-3600);
						}
					}
					// On verifie l'utilisateur, 
					// et on crée des variables de session si tout est OK
					// Cf. maLibSecurisation
					elseif (verifUser($login,$passe)) 
					{
						if (verifblack($login,$passe))
						{
							if (valider("remember")) 
							{
								setcookie("login",$login , time()+60*60*24*30);
								setcookie("passe",$password, time()+60*60*24*30);
								setcookie("remember",true, time()+60*60*24*30);
							}
							else 
							{
								setcookie("login","", time()-3600);
								setcookie("passe","", time()-3600);
								setcookie("remember",false, time()-3600);
							}
						}
						else $addArgs="?view=connectpage&echec=2";
					}
					else $addArgs="?view=connectpage&echec=1";
				}
			break;

			// Deconnexion //////////////////////////////////////////////////
			case 'Logout' :
				session_destroy();
			break;

			// Inscription //////////////////////////////////////////////////
			case 'Inscription' :
				$addArgs="?view=signupage";
				// on verifie le pseudo, le mail, le mot de passe et la confirmation du mot de passe
				if ($pseudo = valider("pseudo"))
				if ($mail = valider("mail"))
				if ($passe = valider("passe"))
				if ($passe_confirm = valider("passe_confirm"))
				{
					// on verifie que les 2 mots de passe concordent
					if ($passe==$passe_confirm)
					{
						if (test_pseudo($pseudo) == false)
						{
							if (test_mail($mail) == false)
							{
								if (strlen($passe) >= 5)
								{
									// si le pseudo et l'email ne sont pas déja utilisé et que le mot de passe contient au minimum 5 characteres, on créer un nouveau user avec les données saisies
									insertUser ($pseudo,$mail,$passe);
									// on le renvoie sur la page de connexion en lui affichant un message de succès 
									$addArgs="?view=connectpage&suc=1";
								}
								else $addArgs=$addArgs."&err=4";	
							}
							// on le renvoie sur la page d'inscription avec un message d'échec suivant l'échec
							else $addArgs=$addArgs."&err=3";
						}
						else $addArgs=$addArgs."&err=2";
					}
					else $addArgs=$addArgs."&err=1";
							
				}
			break;

			// Soumettre //////////////////////////////////////////////////
			case 'soumettre' :
				$mail=$_SESSION["mail"] ;
				// si l'utilisateur a coché la case "mail modération" on affecre à la variable moderation 1 sinon on lui affecte 0
				if ($moderation = valider("case_mail"))
					$moderation = 1;
				else
					$moderation = 0;
				$mess=($_POST["message"]);
				$long=mb_strlen($mess,'utf-8');
				// on verifie le sujet(catégorie), le message et le pseudo
				if ($sujet = valider("sujet"))
				if ($message = valider("message"))
				if ($pseudo = valider("pseudo"))
				{
					if (verifPseudo($pseudo,$mail)) 
					{
						if ($long<=300)
						{
							$msg=htmlspecialchars($message);
							// si le couple mail/pseudo est vérifié on insert la vdm2i dans la base de données
							insertVdm ($pseudo,$msg,$sujet,$moderation);
						}
						else $addArgs="?view=soumettrevdm&error=2";	
					}
					// sinon on renvoie l'uilisateur sur la même page en lui affichant un message d'erreur
					else $addArgs="?view=soumettrevdm&error=1";	
				}
			break;

			// Choic catégorie /////////////////////////////////////////////////
			case 'choix_cat' :
				if ($nom_cat =valider("nom_cat"))
					$addArgs="?view=homepage&cat=$nomcat";
				// on renvoie l'utilisateur sur la page d'acceuil avec comme parametre la categorie choisit
			break;

			// Validation du post /////////////////////////////////////////////////////
			case 'valid_post' :
				// on verifie l'id de la vdm2i et le mail
				if ($id_vdm = valider("id_vdm"))
				if ($mail = valider("mail"))
				if ($cat = valider("cat"))
				{
					$option="valid";
					postvalid($id_vdm,$option);
					if (verifmoderation($id_vdm))
					{
						// si la vdm2i a été modéré on envoie un mail à celui qui posté la vdm2i
						$objet='Votre vdm2i a bien ete prise en compte';
						$messageHTML="<p> Bonjour votre vdm2i a bien ete prise en compte ! Merci de votre contribution. L'équipe vdm2i</p>";
						$messageNormal="Bonjour votre vdm2i a bien ete prise en compte ! Merci de votre contribution. L'équipe vdm2i";
						sendMail($mail,$objet,$messageHTML,$messageNormal);
					}
					$addArgs="?view=homepage&cat=cat2";
				}
			break;

			// Suppression du post /////////////////////////////////////////////////////
			case 'supp_post' :
				if ($id_vdm = valider("id_vdm"))
				if ($cat = valider("cat"))
				{	
					// si l'id de la vdm est valide on supprime la vdm2i
					$option="supp";
					postvalid($id_vdm,$option);
				}
				$addArgs="?view=homepage&cat=$cat";
			break;

			// Blacklistage /////////////////////////////////////////////////////
			case 'gerer_user' :
				$blacklist=$_POST["blacklist"];
				$idUser=valider("id_user");
				if(isset($blacklist))
				{
					if($blacklist==0) $act=0;
					if($blacklist==1) $act=1;
				}
				if(isset($act) and isset($idUser))
				{
					if ($act==0) interdireUtilisateur($idUser);
					elseif ($act==1) autoriserUtilisateur($idUser);
				}
				$addArgs="?view=homepage&cat=cat3";
				// si l'utilisateur est blacklisté on le "remet normal", il n'est plus blacklisté.
				// à l'inverse si il n'est blacklisté on le blacklist
				// on renvoit l'admin sur la page d'acceuil avec la categorie blackliistage*/
			break;

			// LIKE /////////////////////////////////////////////////////
			case 'put_like' :
				$iduser=$_SESSION["idUser"];
				if ($idvdm=valider('id_vdm'))
				{
					$like=likeornot($iduser,$idvdm);
					$dislike=dislikeornot($iduser,$idvdm);
					// si la personne a déja liké la vdm on fait une mise à jour de ses like
					//sinon on insert son like 
					if ($like==5)
						putlike($idvdm,$iduser);
					else
						updatelike($like,$dislike,$idvdm,$iduser);
				}
				if ($page=valider('page')) $addArgs="?view=profil";
				elseif ($cat=valider('cat')) $addArgs="?view=homepage&cat=$cat";
			break;

			// LIKE /////////////////////////////////////////////////////
			case 'put_dislike' :
				// même système que put_like mais pour les dislikes ici
				$iduser=$_SESSION["idUser"];
				if ($idvdm=valider('id_vdm'))
				{
					$like=likeornot($iduser,$idvdm);
					$dislike=dislikeornot($iduser,$idvdm);
					// si la personne a déja disliké la vdm on fait une mise à jour de ses dislike
					//sinon on insert son dislike
					if ($dislike==5)
						putdislike($idvdm,$iduser);
					else
						updatedislike($like,$dislike,$idvdm,$iduser);
				}
				if ($page=valider('page')) $addArgs="?view=profil";
				elseif ($cat=valider('cat')) $addArgs="?view=homepage&cat=$cat";
			break;

			// Changer Pseudo /////////////////////////////////////////////////////
			case 'chang_pseudo' :
				$iduser=$_SESSION["idUser"];
				if ($pseudo=valider('pseudo'))
				{
					if (test_pseudo($pseudo) == false)
					{
						// si le nouveau pseudo choisi n'est pas dejà utilisé on met à jour le pseudo, on renvoie l'utilisateur sur son profil et on change la variable de session pseudo
						updatepseudo($iduser,$pseudo);
						$addArgs="?view=profil&suc=1";
						$_SESSION["pseudo"]=$pseudo;
					}
					// si le pseudo est dejà utilisé on renvoie l'utilisateur sur son profil avec un message d'erreur
					else $addArgs="?view=profil&err=1";
				}
				else $addArgs="?view=profil&err=2";
			break;

			// Changer mot de passe /////////////////////////////////////////////////////
			case 'chang_mdp' :
				$iduser=$_SESSION["idUser"];
				if ($old_pass=valider('old_pass'))
				if ($new_pass=valider('new_pass'))
				if ($conf_pass=valider('conf_pass'))
				{
					if(strlen($new_pass)>=5)
					{
						if($conf_pass==$new_pass)
						{
							if (testmdp($old_pass,$iduser))
							{
								// si le nouveau mot de passe est bien confirmé, et que l'ancien mot de passe correspond bien au MDP de l'utilisateur, alors on met à jour son MDP et on renvoie l'utilisateur sur son profil
								updatemdp($new_pass,$iduser);
								$addArgs="?view=profil&suc=2";
							}
							// si le mot de passe est mal confirmé ou que son ancien mot de passe n'est pas bon alors on renvoie l'utilisateur sur son profil avec un message d'erreur
							else $addArgs="?view=profil&err=3";
						}
						else $addArgs="?view=profil&err=4";
					}
					else $addArgs="?view=profil&err=5";
				}
				else $addArgs="?view=profil&err=6";
			break;

			// Supprimer compte /////////////////////////////////////////////////////
			case 'del_count' :
				$iduser=$_SESSION["idUser"];
				$pseudo=$_SESSION["pseudo"];
				if ($pass=valider('pass'))
				if ($conf_pass=valider('conf_pass'))
				{
					if($pass==$conf_pass)
					{
						if (testmdp($pass,$iduser))
						{
							// si le mot de passe est bien confirmé, et que le mot de passe correspond bien au MDP de l'utilisateur, alors on supprime so compte et ses vdm
							// on renvoie l'utilisateur sur la page d'acceuil avec un message de succès
							delete_count($iduser);
							delete_vdm($pseudo);
							session_destroy();
							$addArgs="?view=homepage&suc=1";
						}
						// si le mot de passe est mal confirmé ou que son ancien mot de passe n'est pas bon alors on renvoie l'utilisateur sur son profil avec un message d'erreur		
						else $addArgs="?view=profil&err=7";
					}
					else $addArgs="?view=profil&err=8";
				}
				else $addArgs="?view=profil&err=9";
			break;

			// Rajouter catégorie /////////////////////////////////////////////////////
			case 'plus_cat' :
				if ($cat=valider('cat'))
				{
					$nbcat=nbcat();
					// on calcule le nombre de catégories sélectionnable (les catégories dans lesquels nous pouvons publier), par exemple top, mes vdm2i ne sont pas des catégories sélectionnable
					if ($nbcat<5)
					{
						if (catexist($cat)==0)
						{
							// si le nombre de catégories sélectionnable est inférieur à 5 (c'est le nombre de categorie selectionnable que nous avons prédéfinis) et que la catégorie ajoutée n'est pas déjà existante alors on rajoute la catégorie
							// on renvoie l'utilisateur sur son profil avec un message de succès
							ajoutercat($cat,$nbcat);
							$addArgs="?view=profil&suc=3";
						}
						// si ces conditions ne sont pas respectés on redirige l'utilisateur sur son profil avec un message d'erreur
						else $addArgs="?view=profil&err=13";				
					}
					else $addArgs="?view=profil&err=10";
				}
				else $addArgs="?view=profil&err=11";
			break;

			// Supprimer catégorie /////////////////////////////////////////////////////
			case 'supp_cat' :
				if ($cat=valider('cat'))
				{
					if (catexist($cat)==1)
					{
						// si la categorie à supprimer sélectionné est bien  valide et qu'elle existe alors on l'a supprime et on renvoie l'utilisateur sur son profil avec un message de succès
						supprimercat($cat);
						$addArgs="?view=profil&suc=4";
					}
					// si ces conditions ne sont pas respectés on redirige l'utilisateur sur son profil avec un message d'erreur
					else $addArgs="?view=profil&err=14";			
				}
				else $addArgs="?view=profil&err=12";
			break;

			// Rechercher /////////////////////////////////////////////////////
			case 'rechercher' :
				// si la recherche est valide, on redirige l'utilisateur sur la page recherche avec les resultats correspondant à sa recherche
				if ($recherche=valider('recherche')) $addArgs="?view=rechercher&search=".$recherche;
				// sinon on renvoie l'utilisateur sur la page recherche avec un message d'erreur
			 	else $addArgs="?view=rechercher&err=1";
			break;
		}
	}

	// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat
	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	
	// On redirige vers la page index avec les bons arguments
	header("Location:" . $urlBase . $addArgs);

	// On écrit seulement après cette entête
	ob_end_flush();

?>
