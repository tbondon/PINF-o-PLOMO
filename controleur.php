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
		// ATTENTION : le codage des caractères peut poser PB si on utilise des actions comportant des accents... 
		// A EVITER si on ne maitrise pas ce type de problématiques

		/* TODO: A REVOIR !!
		// Dans tous les cas, il faut etre logue... 
		// Sauf si on veut se connecter (action == Connexion)

		if ($action != "Connexion") 
			securiser("login");
		*/

		// Un paramètre action a été soumis, on fait le boulot...
		switch($action)
		{
			
			
			// Connexion //////////////////////////////////////////////////
			case 'Connexion' :
				// On verifie la presence des champs login et passe
				if ($login = valider("login"))
				{
					if ($passe = valider("passe"))
					{
					$passe=md5($passe);
						// On verifie l'utilisateur, 
						// et on crée des variables de session si tout est OK
						// Cf. maLibSecurisation
						if (verifUser($login,$passe)==1)
						{
							
								// tout s'est bien passé, doit-on se souvenir de la personne ? 
								if (valider("remember")) 
								{
									setcookie("login",$login , time()+60*60*24*30);
									setcookie("passe",$passe, time()+60*60*24*30);
									setcookie("remember",true, time()+60*60*24*30);
								}
								else
								{
									
									setcookie("login","", time()-3600);
									setcookie("passe","", time()-3600);
									setcookie("remember",false, time()-3600);
								}
					
								$id=valider("id_joueur","SESSION");
								connecterUtilisateur($id);
								
								
									
						}
					
						else if(verifUser($login,$passe) == 5 ) $addArgs = "?view=login&date=1";
						else $addArgs = "?view=login&variable=1";	
					}
					else $addArgs = "?view=login&variable=1";
				}
				else $addArgs = "?view=login&variable=1";	
			break;

			case 'Logout' :
				$id=valider("id_joueur","SESSION");
				deconnecterUtilisateur($id);
				session_destroy();
				
			break;

			case 'Envoyer Ressources':
				if (!empty($_FILES["FileToUpload"]))
					{
						
						if (is_uploaded_file($_FILES["FileToUpload"]["tmp_name"]))
						{	
							$id=valider('user');
							$titre=valider('nom');
							$name = $_FILES["FileToUpload"]["name"];
							copy($_FILES["FileToUpload"]["tmp_name"],"ressourcesProfil/$name");
							envoyerRessources($name,$id,$titre);
							$addArgs = "?view=envoyerressources&variable=Succes";
		
						}	
						else
						{
								$addArgs = "?view=envoyerressources&var=Error";
						}
					}
				else
						$addArgs = "?view=envoyerressources&var=Error";
			break;

			
			case 'Inscription' :
				// On verifie la presence des champs login et passe
						
				
				
				if ($login = valider("login")){
					if(SQLGetChamp("Select pseudo_user from users where pseudo_user='$login'"))
					{
						rediriger("index.php?view=inscriptionadmin&variable=Error");	
					}
					else if( $passe = valider("passe")){
							if( $nom = valider("nom")){
								if( $matricule = valider("matricule")){
									if( $prenom = valider("prenom")){
										if( $mail = valider("mail")){
											if( $programme = valider("programme")){
												if( $date = valider("date") ){
													if( $admin = valider("admin"))
													{
															if($admin == 2)
																$admin=0;
															$passe=md5($passe);
															creerUser($login,$passe,$nom,$prenom,$mail,$admin,$programme,$date,$matricule); 
															$addArgs = "?view=inscriptionadmin&var=succes";
														
													}
													else 
														$addArgs = "?view=inscriptionadmin&variable=Error";
												}else 
													$addArgs = "?view=inscriptionadmin&variable=Error";
											}else 
												$addArgs = "?view=inscriptionadmin&variable=Error";
										}else 
											$addArgs = "?view=inscriptionadmin&variable=Error";
									}else 
										$addArgs = "?view=inscriptionadmin&variable=Error";
								}else 
									$addArgs = "?view=inscriptionadmin&variable=Error";
							}else 
								$addArgs = "?view=inscriptionadmin&variable=Error";
						}else 
							$addArgs = "?view=inscriptionadmin&variable=Error";
					}else 
						$addArgs = "?view=inscriptionadmin&variable=Error";
				
			break; 
			
			
			case "Valider" : 
			if ($id_joueur = valider("id_joueur"))
				validerUtilisateur($id_joueur);
			$addArgs = "?view=admin";
			break; 
			
			

			case "Blacklister" : 
			if ($id_joueur = valider("id_joueur"))
				interdireUtilisateur($id_joueur);
			$addArgs = "?view=admin";
			break; 
			
			case "Rendre Admin" : 
			if ($id_joueur = valider("id_joueur")){
				rendreAdminUtilisateur($id_joueur);
			}
			$addArgs = "?view=partieadmin";
			break; 
			
			case "Rendre Non Admin" : 
			if ($id_joueur = valider("id_joueur"))
				rendreNonAdminUtilisateur($id_joueur);
			$addArgs = "?view=partieadmin";
			break;

			case "Supprimer" : 
			if ($id_joueur = valider("id_joueur"))
				supprimerUtilisateur($id_joueur);
			$addArgs = "?view=partieadmin";
			break; 
			
			case "Réactiver" : 
			if ($id_joueur = valider("id_joueur"))
				autoriserUtilisateur($id_joueur);
			$addArgs = "?view=partieadmin";
			break; 
			
			case "Modifier le mdp":
			if ($ancienmdp = valider("ancienmdp")){
			if ($id = valider("id")){
				$ancienmdp=md5($ancienmdp);
				$login=SQLGetChamp("Select pseudo_user from users where id_user='$id'");
				if(verifUserBdd($login,$ancienmdp)){
				if ($mdp = valider("mdp"))	{
						if ($mdp2= valider("mdpCheck"))	{
								if($mdp == $mdp2){
							$mdp=md5($mdp);
							updateMDPBDD($mdp,$id);
							$addArgs = "?view=monprofil&var=succes";	
			}else 	
				$addArgs = "?view=monprofil&variable=Error";
			}else	
				$addArgs = "?view=monprofil&variable=Error";
			}else 	
				$addArgs = "?view=monprofil&variable=Error";
			}else 	
				$addArgs = "?view=monprofil&variable=Error";
			}else 	
				$addArgs = "?view=monprofil&variable=Error";
			}else 	
				$addArgs = "?view=monprofil&variable=Error";
			break;
			
			case 'Supprimer cette ressource':
				if ($id_ressource = valider("id_ressource")){
					deleteRessource($id_ressource);
					$addArgs = "?view=mesressources&var=Succes";
				}
				else
					$addArgs = "?view=mesressources&variable=Error";
				
			break;
			
			case 'Uploader' : 
			if (!empty($_FILES["FileToUpload"]))
			{
			
				if (is_uploaded_file($_FILES["FileToUpload"]["tmp_name"]))
				{	
					
					$id=valider('id');
					$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
					$extension_upload = strtolower(  substr(  strrchr($_FILES['FileToUpload']['name'], '.')  ,1)  );
				

					if ( in_array($extension_upload,$extensions_valides) ) 
					{
					//print("Quelques informations sur le fichier récupéré :<br>");
					//print("Nom : ".$_FILES["FileToUpload"]["name"]."<br>");
					//print("Type : ".$_FILES["FileToUpload"]["type"]."<br>");
					//print("Taille : ".$_FILES["FileToUpload"]["size"]."<br>");
					//print("Tempname : ".$_FILES["FileToUpload"]["tmp_name"]."<br>");
					$name = $_FILES["FileToUpload"]["name"];
					copy($_FILES["FileToUpload"]["tmp_name"],"ressources/$name");
					UpdateImageBDD($name,$id);

				}
				else 
					die("pb");
				}
				else
				{
					die("pb");
				}
				
			}
			$addArgs = "?view=formationadmin";
			break;

			case 'Uploader2' : 
			if (!empty($_FILES["FileToUpload"]))
			{
				
				if (is_uploaded_file($_FILES["FileToUpload"]["tmp_name"]))
				{	
					$id=valider('id');
					$name = $_FILES["FileToUpload"]["name"];
					copy($_FILES["FileToUpload"]["tmp_name"],"fichiers/$name");
					UpdatePDFBDD($name,$id);

				}	
				else
				{
					die("pb");
				}
			}	
			$addArgs = "?view=formationadmin";
			break;
			
			case 'Modifier PDF Stat' : 
			if (!empty($_FILES["FileToUpload"]))
			{
				
				if (is_uploaded_file($_FILES["FileToUpload"]["tmp_name"]))
				{	
					$id=valider('id');
					$name = $_FILES["FileToUpload"]["name"];
					copy($_FILES["FileToUpload"]["tmp_name"],"fichiers/$name");
					UpdatePDFstatBDD($name);

				}	
				else
				{
					die("pb");
				}
			}	
			$addArgs = "?view=pagestatadmin";
			break;

			case "Affichage Formation visiteur" :
			$addArgs = "?view=formation";
			break;
			
			case "Affichage Stat visiteur" :
			$addArgs = "?view=teststat";
			break;
			
			case "Choix Formation CV" :
					$valeur=valider('formation');
			$addArgs = "?view=CVtheque&categorie=$valeur";
			break;
			
			case "Affichage CV-theque visiteur" :
			$addArgs = "?view=CVtheque";
			break;
			
			case "Affichage Statistiques visiteur" :
			$addArgs = "?view=pagestat";
			break;

			case "Modifier les champs" :
				
				$id=valider('id');
				$nom=valider('nom');
				$description=valider('description');
				$session=valider('session');
				updateChampsBDD($id,$nom,$description,$session);
				$addArgs = "?view=formationadmin";
			break;


			
			case "Ajouter Une Formation" :
			if (!empty($_FILES["file"]))
			{

				if (is_uploaded_file($_FILES["file"]["tmp_name"][0]))
				{	
					
					$name1 = $_FILES["file"]["name"][0];
					copy($_FILES["file"]["tmp_name"][0],"fichiers/$name1");

					$name2 = $_FILES["file"]["name"][1];
					copy($_FILES["file"]["tmp_name"][1],"ressources/$name2");

				}	
				else
				{
					die("pb");
				}
			}
			else
				{
					die("pb 1");
				}
			
			$nom=valider('nomFormation');
			$description=valider('descriptionFormation');
			$session=valider('sessionFormation');
			AjouterFormation($nom,$description,$session,'fichiers/'.$name1,'ressources/'.$name2);
			$addArgs = "?view=formationadmin";
			break;
			
			case "Ajouter un CV" :
			if (!empty($_FILES["file"]))
			{

				if (is_uploaded_file($_FILES["file"]["tmp_name"][0]))
				{	
					
					$name1 = $_FILES["file"]["name"][0];
					copy($_FILES["file"]["tmp_name"][0],"fichiers/$name1");
				}	
				else
				{
					die("pb");
				}
			}
			else
				{
					die("pb 1");
				}
			
			$nom=valider('nomDiplome');
			$prenom=valider('prenomDiplome');
			$programme=valider('programme');
			AjouterCV($nom,$prenom,$programme,$name1);
			$addArgs = "?view=CVthequeAdmin";
			break;
			
			case "Ajouter Une Stat" :
			if($titre=valider('titre'))
				if($pourcentage=valider('pourcentage')){
					if($pourcentage <= 101){
			AjouterBarre($titre,$pourcentage);
			$addArgs = "?view=teststatadmin";
				}
			else 
				$addArgs = "?view=teststatadmin&variable=1";
				}
			else 
				$addArgs = "?view=teststatadmin&variable=1";	
			else 
				$addArgs = "?view=teststatadmin&variable=1";	
			break;
			
			case "Modifier Stat" :
			if($titre=valider('titre'))
				if($pourcentage=valider('pourcentage')){
					if($id=valider('id_stat')){
						if($pourcentage <= 101){
			ModifierBarre($titre,$pourcentage,$id);
			$addArgs = "?view=teststatadmin&success=1";
				}
			else 
				$addArgs = "?view=teststatadmin&variable=1";
				}
			else 
				$addArgs = "?view=teststatadmin&variable=1";	
			}
			else 
				$addArgs = "?view=teststatadmin&variable=1";	
			else 
				$addArgs = "?view=teststatadmin&variable=1";		
			break;
			
			case "Supprimer cette Formation" :
			$id=valider('id');
			supprimerProgrammeBDD($id);
			$addArgs = "?view=formationadmin";
			break;
			
			case "Supprimer cette Stat" :
			if($id=valider('id_stat')){
			supprimerStat($id);
			$addArgs = "?view=teststatadmin&success=1";
			}
			else
			$addArgs = "?view=teststatadmin&variable=1";
			break;
			
			case "Supprimer ce CV" :
			$id=valider('id');
			supprimerCVBDD($id);
			$addArgs = "?view=CVthequeAdmin";
			break;
			
			case 'suppFAQ':
				//on efface la faq
				//on verifie si les parametres sont ok
				if($id_faq=valider("id_faq","POST"))
				{
					deleteFaq($id_faq);
				}
				
			break;
			case "addFAQ":
				//on verifie si les parametres sont ok
					if($question=valider("question_faq","POST"))
					{
						if($reponse=valider("reponse_faq","POST"))
						{
							
							addFaq($question,$reponse);	
						}
							
					}
				$addArgs="?view=faq";
			break;
			
			case "updateQuestionFaq": 
				//on verifie si les parametre sont ok
				if($id_faq=valider("id_faq","POST"))
				{
					if($newQuestion=valider("newQuestion","POST"))
					{
						updateQuestionFaq($id_faq,$newQuestion);	
					}
				}
			break;
			case "updateReponseFaq":
				//on verifie si les parametre sont ok
					if($id_faq=valider("id_faq","POST"))
					{
						if($newReponse=valider("newReponse","POST"))
						{
							updateReponseFaq($id_faq,$newReponse);
						}
				}
				
			case "chargerPlusArticles":
				getArticles($_POST["limit"],$_POST["offset"]);	
			break;
			case "creerArticle" :
				
			/*	if (!empty($_FILES["icone"]))
			{

				if (is_uploaded_file($_FILES["icone"]["tmp_name"]))
				{
					//print("Quelques informations sur le fichier récupéré :<br>");
					//print("Nom : ".$_FILES["icone"]["name"]."<br>");
					//print("Type : ".$_FILES["icone"]["type"]."<br>");
					//print("Taille : ".$_FILES["icone"]["size"]."<br>");
					//print("Tempname : ".$_FILES["icone"]["tmp_name"]."<br>");
					$name = $_FILES["icone"]["name"];
					copy($_FILES["icone"]["tmp_name"],"./ressources/$nomRep/$name");
					//logo_copyright("./ressources/$nomRep/$name","./ressources/$nomRep/copyright$nomRep/$name");


					$dataImg = getimagesize("./ressources/$nomRep/$name");  
					$type= substr($dataImg["mime"],6);// on enleve "image/" 

					 //creation de la miniature
					miniature($type,"./ressources/$nomRep/$name",200,"./ressources/$nomRep/$name");

					$dataImg = getimagesize("./ressources/$nomRep/copyright$nomRep/$name");  
					$type= substr($dataImg["mime"],6);// on enleve "image/" 

				}
				else
				{
					die("problème de création d'image");
				}
			}*/
				
				  if(isset($_FILES["icone"]))
				  {
				
				  		if ($_FILES['icone']['error'] > 0) $erreur = "Erreur lors du transfert";
				  		if ($_FILES['icone']['size'] > 2000000) $erreur = "Le fichier est trop gros";
				
				  		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
						//1. strrchr renvoie l'extension avec le point (« . »).
						//2. substr(chaine,1) ignore le premier caractère de chaine.
						//3. strtolower met l'extension en minuscules.
						$extension_upload = strtolower(  substr(  strrchr($_FILES['icone']['name'], '.')  ,1)  );
						if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
				
					
						  $resultat = move_uploaded_file($_FILES['icone']['tmp_name'],"./ressources/photosArticles/".$_FILES['icone']['name']);
					   	  if (!$resultat) die("error");
					   	  
						 //print("Quelques informations sur le fichier récupéré :<br>");
						//print("Nom : ".$_FILES["icone"]["name"]."<br>");
						//print("Type : ".$_FILES["icone"]["type"]."<br>");
						//print("Taille : ".$_FILES["icone"]["size"]."<br>");
						//print("Tempname : ".$_FILES["icone"]["tmp_name"]."<br>");
						$name = $_FILES["icone"]["name"];
					/*	copy("./ressources/photosArticles/".$_FILES['icone']['name'],"./ressources/miniaturesArticles/$name");
					
					
						$dataImg = getimagesize("./ressources/photosArticles/$name");  
						$type= substr($dataImg["mime"],6);// on enleve "image/" 
	
						 //creation de la miniature
						miniature($type,"./ressources/photosArticles/$name",200,"./ressources/miniaturesArticles/$name");
	*/
				
					   	  
				
					   	  //on ajoute dans la bdd
					
							if($titre=valider("titre","POST"))//on teste le titre
							{
								if(strlen($titre)<256)
								{
									if($contenu=valider("editor1","POST"))//on teste le contenu de l'article
									{
										if($_FILES['icone']['name']!="")//on teste l'image  ps: on a deja testé si le fichier existe au dessus
										{
											$lien=$_FILES['icone']['name'];
											$date=date('Y-m-d H:i:s');//die($date);
											creerArticle($titre,$date,$lien,$contenu);
											
										}
									}
								}
							}

				
				  }
			$addArgs="?view=actualite";

			break;
			case "suppArticle" :
				//on va d'abbord récupérer le chemin de l'image associé à l'article pour pouvoir
				//la supprimer sur le serveur
				if($id_article=valider("id_article","POST"))
				{
					$data=getCheminPhotoArticle($id_article);//on recupere le chemin avec une requete SQL
					$chemin_photo=parcoursRs($data);
					
					$fichier=$chemin_photo[0]["lien_photo"];//contient le chemin du fichier a efface
					$dossier_traite = "./ressources/photosArticles";//le dossier contenant mes images pour les articles
					$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
					 
					// Si le fichier n'est pas un répertoire…
					if ($fichier != ".." AND $fichier != "." AND !is_dir($fichier))
					       {
					
					       unlink($fichier); // On efface.
					       }
				
					closedir($repertoire); // Ne pas oublier de fermer le dossier ***EN DEHORS de la boucle*** ! Ce qui évitera à PHP beaucoup de calculs et des problèmes liés à l'ouverture du dossier.
										
					
					deleteArticle($id_article);//enfin on supprime dans la base l'article
				}
			
				$addArgs="?view=actualite";
			break;
			
			
			//////////////////////////////////////quizz////////////////////////////////////////////////////////////
			case "supp_quest_img" :
				
				if($id_quest=valider("id_quest","POST"))
				{
					if($bonrep=valider("bonimg","POST"))
					{
					$bonrep="./ressources/photosQuizz/".$bonrep;
					$dossier_traite = "./ressources/photosQuizz";//le dossier contenant mes images pour les articles
					$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
					 
					// Si le fichier n'est pas un répertoire…
					
					if ($bonrep != ".." AND $bonrep != "." AND !is_dir($bonrep))
					       {
					       unlink($bonrep); // On efface.
					       }
				
					closedir($repertoire); // Ne pas oublier de fermer le dossier ***EN DEHORS de la boucle*** ! Ce qui évitera à PHP beaucoup de calculs et des problèmes liés à l'ouverture du dossier.
					}
					
					if($mauvrep0=valider("mauvimg0","POST"))
					{
					$mauvrep0="./ressources/photosQuizz/".$mauvrep0;
					$dossier_traite = "./ressources/photosQuizz";//le dossier contenant mes images pour les articles
					 
					$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
					 
					// Si le fichier n'est pas un répertoire…
					if ($$mauvrep0 != ".." AND $mauvrep0 != "." AND !is_dir($mauvrep0))
					       {
					       unlink($mauvrep0); // On efface.
					       }
				
					closedir($repertoire); // Ne pas oublier de fermer le dossier ***EN DEHORS de la boucle*** ! Ce qui évitera à PHP beaucoup de calculs et des problèmes liés à l'ouverture du dossier.
					}
					
					if($mauvrep1=valider("mauvimg1","POST"))
					{
					$mauvrep1="./ressources/photosQuizz/".$mauvrep1;
					$dossier_traite = "./ressources/photosQuizz";//le dossier contenant mes images pour les articles
					 
					$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
					 
					// Si le fichier n'est pas un répertoire…
					if ($mauvrep1 != ".." AND $mauvrep1 != "." AND !is_dir($mauvrep1))
					       {
					       unlink($mauvrep1); // On efface.
					       }
				
					closedir($repertoire); // Ne pas oublier de fermer le dossier ***EN DEHORS de la boucle*** ! Ce qui évitera à PHP beaucoup de calculs et des problèmes liés à l'ouverture du dossier.
					}
					
					if($mauvrep2=valider("mauvimg2","POST"))
					{
					$mauvrep2="./ressources/photosQuizz/".$mauvrep2;
					$dossier_traite = "./ressources/photosQuizz";//le dossier contenant mes images pour les articles
					 
					$repertoire = opendir($dossier_traite); // On définit le répertoire dans lequel on souhaite travailler.
					 
					// Si le fichier n'est pas un répertoire…
					if ($mauvrep2 != ".." AND $mauvrep2 != "." AND !is_dir($mauvrep2))
					       {
					       unlink($mauvrep2); // On efface.
					       }
				
					closedir($repertoire); // Ne pas oublier de fermer le dossier ***EN DEHORS de la boucle*** ! Ce qui évitera à PHP beaucoup de calculs et des problèmes liés à l'ouverture du dossier.
					}
					
					delete_reponses($id_quest);
					delete_question($id_quest);
				}
			
				$addArgs="?view=modifier";
				
			
			
			break;
			case "soumettre" :
				
				if ($programme = valider("programme"))
				{
					if ($nom = valider("nom"))
					{
						$programme=$programme-1;
						insertquizz($programme,$nom);
						$addArgs="?view=quizzAdmin";
					}	
				}
			break;
			case 'supp_quizz' :
			if ($id_quizz = valider("quizz"))
					{
						$id_quizz=$id_quizz-1;
						delete_quizz($id_quizz);
						$questions = select_questions_all($id_quizz);
						foreach ($questions as $dataQuestions){
							
							$id=$dataQuestions['id_question'];
							delete_reponses($id);
							delete_question($id);
						}
						$addArgs="?view=quizzAdmin";
					}		
			break;
			
			case "creerQuestImage" :
				if (!empty($_FILES["bon_rep"]))
				{
			
					if (is_uploaded_file($_FILES["bon_rep"]["tmp_name"]))
					{	
						$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
						$extension_upload = strtolower(  substr(  strrchr($_FILES["bon_rep"]['name'], '.')  ,1)  );
					
	
						if ( in_array($extension_upload,$extensions_valides) ) 
						{
							if ($id_quizz = valider("idQuizz"))
							{
								if ($question = valider("question"))
								{
									if (!empty($_FILES["mauv_rep1"]))
									{
								
										if (is_uploaded_file($_FILES["mauv_rep1"]["tmp_name"]))
										{	
											$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
											$extension_upload = strtolower(  substr(  strrchr($_FILES["mauv_rep1"]['name'], '.')  ,1)  );
										
						
											if ( in_array($extension_upload,$extensions_valides) ) 
											{
														echo("suis la");
														$name1 = $_FILES["bon_rep"]["name"];
														copy($_FILES["bon_rep"]["tmp_name"],"ressources/photosQuizz/$name1");
														insert_question($question,$id_quizz,1);
														echo("question ok");
														insert_bonne_rep($name1,$question,1); 
														$name = $_FILES["mauv_rep1"]["name"];
														copy($_FILES["mauv_rep1"]["tmp_name"],"ressources/photosQuizz/$name");
														insert_mauvaise_rep($name,$question,1); 
														echo("muavaise rep1 ok");
														if (!empty($_FILES["mauv_rep2"]))
														{
													
															if (is_uploaded_file($_FILES["mauv_rep2"]["tmp_name"]))
															{	
																$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
																$extension_upload = strtolower(  substr(  strrchr($_FILES["mauv_rep2"]['name'], '.')  ,1)  );
															
											
																if ( in_array($extension_upload,$extensions_valides) ) 
																{
																		$name2 = $_FILES["mauv_rep2"]["name"];
																		copy($_FILES["mauv_rep2"]["tmp_name"],"ressources/photosQuizz/$name2");
																		insert_mauvaise_rep($name2,$question,1);
																}
															}
														}
														if (!empty($_FILES["mauv_rep3"]))
														{
													
															if (is_uploaded_file($_FILES["mauv_rep3"]["tmp_name"]))
															{	
																$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
																$extension_upload = strtolower(  substr(  strrchr($_FILES["mauv_rep3"]['name'], '.')  ,1)  );
															
											
																if ( in_array($extension_upload,$extensions_valides) ) 
																{
																		$name3 = $_FILES["mauv_rep3"]["name"];
																		copy($_FILES["mauv_rep3"]["tmp_name"],"ressources/photosQuizz/$name3");
																		insert_mauvaise_rep($name3,$question,1);
																}
															}
														}
											}
											
										}
									
									}
								}
							}
						}
						
					}
				
				}
					$addArgs="?view=quizzAdmin";

			break;
			
		}

	}


	// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
	// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
	// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

	// $urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	// On redirige vers la page index avec les bons arguments

	$urlBase = '/index.php';

	header("Location:" . $urlBase . $addArgs);

	// On écrit seulement après cette entête
	ob_end_flush();
	
?>










