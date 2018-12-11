<?php
session_start();

	//echo $_SERVER["REQUEST_URI"] . "<br />";

	include_once "libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/modele.php"; 

	$data["action"] = valider("action");
	$data["feedback"] = false;

	// si on a une action, on devrait avoir un message classique
	$data["feedback"] = "entrez action: ";

	switch($data["action"])
	{
		case 'select_quizz' :
				$data["quizz"]=select_quizz();
		break;
		
		case 'ajouter_question' :
			if ($id_quizz = valider("idQuizz"))
			{
				if ($question = valider("question"))
				{
					insert_question($question,$id_quizz,0);
					$data["feedback"] = true ; 
				}
			}
			break;

			case 'ajouter_bonne_reponse' :
				if($question = valider("question"))
				{
					if ($reponse = valider("reponse"))
					{
					insert_bonne_rep($reponse,$question,0); 
					$data["feedback"] = true ; 
					}	
				}
						
			break;

			case 'ajouter_mauvaise_reponse' :
				if($question = valider("question"))
				{
					if ($reponse = valider("reponse"))
					{
					insert_mauvaise_rep($reponse,$question,0);
					$data["feedback"] = true ; 
					}

				}
						
			break;

			case 'select_questions' :
			if ($idQuizz = valider("idQuizz"))
				{
					$data["questions"]=select_questions($idQuizz,0);
				}
			
			break;
			
			case 'select_questions_image' :
			if ($idQuizz = valider("idQuizz"))
				{
					$data["questions"]=select_questions($idQuizz,1);
				}
			
			break;
		
		
			
			case "selectRep" : 
				if ($idQuest = valider("idQuest"))
				{
					$data["reponses"]=select_reponses($idQuest);
				}
			break;

			case "select_bonne_rep" : 
				if ($idQuest = valider("idQuest"))
				{
					$data["bonRep"]=select_reponse(1,$idQuest);
				}
			break;

			case "select_mauvaise_rep" : 
				if ($idQuest = valider("idQuest"))
				{
					$data["mauvRep"]=select_reponse(0,$idQuest);
				}
			break;

			case "modifierRep" :
				if ($reponse = valider("reponse"))
				{
					if ($id = valider("id"))
					{
						update_reponse($reponse,$id);
					}
				}
			break;

			case "modifierQuest" :
				if ($question = valider("question"))
				{
					if ($id = valider("id"))
					{
						update_question($question,$id);
					}
				}
			break;

			case "suppRep" :
				if ($id = valider("id"))
					{
						delete_reponse($id);
					}
			break;

			case "supprimer_question" :
			if ($id = valider("id"))
					{
						delete_reponses($id);
						delete_question($id);
					}
			break;
			
			case "afficher_question" :
			if ($id = valider("idQuizz"))
			{
				$data["questions"]=afficher_question($id);
			}
				
		
			break;
			
			case 'enregiScore' :
			if ($score = valider("score"))
			{
				if ($prenom = valider("prenom"))
				{
					if ($nom = valider("nom"))
					{
						if($email = valider("mail"))
						{
						//	if($idQuizz = valider("idQuizz")){
						insert_resultat($prenom,$nom,$score,$email);
								//insert_resultat($prenom,$nom,$score,$email,$idQuizz);
						//	}
						}
					}
				}
			}
			break;
			
			case "select_resultat" :
		
				$data["resultat"]=select_resultat();
			break;
			
			case "supprimer_resultat" :
			if ($id = valider("id"))
					{
						delete_resultat($id);
					}
			break;
			
			
			


	}

		
	 
	echo json_encode($data);

?>










