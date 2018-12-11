<?php
// inclure ici la librairie faciliant les requêtes SQL
include_once("maLibSQL.pdo.php");

function console_log( $data ){
	echo '<script>';
	echo 'console.log('. json_encode( $data ) .')';
	echo '</script>';
}
						
function listerUtilisateurs($classe = "both")
{
	// NB : la présence du symbole '=' indique la valeur par défaut du paramètre s'il n'est pas fourni
	// Cette fonction liste les utilisateurs de la base de données 
	// et renvoie un tableau d'enregistrements. 
	// Chaque enregistrement est un tableau associatif contenant les champs 
	// id,pseudo,blacklist,connecte,couleur

	// Lorsque la variable $classe vaut "both", elle renvoie tous les utilisateurs
	// Lorsqu'elle vaut "bl", elle ne renvoie que les utilisateurs blacklistés
	// Lorsqu'elle vaut "nbl", elle ne renvoie que les utilisateurs non blacklistés

	$SQL = "select * from users";
	
	return parcoursRs(SQLSelect($SQL));

}

function listerQuestions($classe = "both")
{


	$SQL = "select * from questions";
	if ($classe == "valide")
		$SQL .= " where valide=1";
	if ($classe == "pasvalide")
		$SQL .= " where valide=0";

	$SQL .= " ORDER BY valide ASC";
	
	// echo $SQL;
	return parcoursRs(SQLSelect($SQL));

}
function listerReponses($quest)
{
	

	$SQL = "select id_quest,rep1,rep2,rep3,rep4,correct from reponse";
	
	
	$SQL .= " where id_quest=$quest ORDER BY id_rep ASC";
	
	// echo $SQL;
	return parcoursRs(SQLSelect($SQL));

}


function validerUtilisateur($id_user)
{
	// cette fonction affecte le booléen "blacklist" à vrai
	$SQL = "UPDATE users SET valide=1 WHERE id_user=$id_user";
	SQLUpdate($SQL);
}

function supprimerUtilisateur($id_user)
{
	// cette fonction affecte le booléen "blacklist" à vrai
	$SQL = "DELETE from users WHERE id_user='$id_user'";
	SQLDelete($SQL);
}
function deleteRessource($id)
{
	
	// cette fonction affecte le booléen "blacklist" à vrai
	$SQL = "DELETE from ressources WHERE id_ressource=\"$id\"";
	SQLDelete($SQL);
}


function interdireUtilisateur($id_user)
{
	// cette fonction affecte le booléen "blacklist" à vrai
	$SQL = "UPDATE users SET blacklist=1 WHERE id_user=$id_user";
	// les apostrophes font partie de la sécurité !! 
	// Il faut utiliser addslashes lors de la récupération 
	// des données depuis les formulaires

	SQLUpdate($SQL);
}

function autoriserUtilisateur($id_user)
{
	// cette fonction affecte le booléen "blacklist" à faux 
	$SQL = "UPDATE users SET blacklist=0 WHERE id_user=$id_user";
	SQLUpdate($SQL);
}

function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès

	$SQL="SELECT id_user FROM users WHERE pseudo_user='$login' AND mdp_user='$passe'";
	
	return SQLGetChamp($SQL);
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}


function creerUser($login,$passe,$nom,$prenom,$mail,$admin,$programme,$date,$matricule) {
	$date_debut=date('Y-m-d');

	$SQL = "INSERT INTO users(pseudo_user,mdp_user,nom_user,prenom_user,mail_user,date_debut,date_fin,admin,nom_programme,id_matricule) VALUES ('$login','$passe','$nom','$prenom','$mail','$date_debut','$date','$admin','$programme','$matricule')";

	return SQLInsert($SQL); 	
	// renvoie l'id de l'utilisateur créé 
}
function getDateUser($login)
{
 return	$SQL1=SQLGetChamp("SELECT date_fin FROM users WHERE pseudo_user='$login'");
}


function isValid($id_user) {
	$SQL = "SELECT valide FROM users WHERE id_user=$id_user"; 
	return SQLGetChamp($SQL);

	// equivalent à 
	// $tabR = parcoursRs(SQLSelect($SQL))
	// return $tabR[0]["valide"];
}


function isAdmin($id_user) {
	$SQL = "SELECT admin FROM users WHERE id_user=$id_user"; 
	return SQLGetChamp($SQL);

	// equivalent à 
	// $tabR = parcoursRs(SQLSelect($SQL))
	// return $tabR[0]["valide"];
}
function getPseudo($id_user){
	$SQL = "SELECT pseudo_user FROM users WHERE id_user='$id_user'"; 
	return SQLGetChamp($SQL);
}
function isPseudoAdmin($pseudo_user) {
	$SQL = "SELECT admin FROM users WHERE pseudo_user=$id_user"; 
	return SQLGetChamp($SQL);

	// equivalent à 
	// $tabR = parcoursRs(SQLSelect($SQL))
	// return $tabR[0]["valide"];
}
function connecterUtilisateur($id_user)
{
	// cette fonction affecte le booléen "blacklist" à vrai
	$SQL = "UPDATE users SET connecte=1 WHERE id_user='$id_user'";
	$_SESSION["connecte"]=true;
	SQLUpdate($SQL);
}
function deconnecterUtilisateur($id_user)
{
	// cette fonction affecte le booléen "blacklist" à vrai
	$_SESSION["connecte"]=false;
	$SQL = "UPDATE users SET connecte=0 WHERE id_user=$id_user";
	SQLUpdate($SQL);
}

function UpdatePDFBDD($source,$id)
{
		$SQL="UPDATE programme SET pdf_programme='fichiers/$source' WHERE id_programme='$id'";
		return SQLUpdate($SQL);

}
function envoyerRessources($name,$id,$nom)
{
	$SQL = "INSERT INTO ressources(id_user,chemin_ressource,nom_ressources) VALUES ('$id','ressourcesProfil/$name','$nom')";
	return SQLInsert($SQL); 
}
function UpdateImageBDD($source,$id)
{
		$SQL="UPDATE programme SET photo_programme='ressources/$source' WHERE id_programme='$id'";
		return SQLUpdate($SQL);

}
function UpdatePDFstatBDD($source)
{
		$SQL="UPDATE stat SET text_stat='fichiers/$source' WHERE id_stat=1";
		return SQLUpdate($SQL);

}
function AjouterFormation($nom,$description,$session,$name1,$name2)
	{
		$SQL = "INSERT INTO programme(nom_programme,description_programme,pdf_programme,photo_programme,session_programme) VALUES ('$nom','$description','$name1','$name2','$session')";

	return SQLInsert($SQL); 

	}
function AjouterBarre($titre,$pourcentage)
	{
		$date=date('Y-m-d');
		$SQL = "INSERT INTO stat(titre_stat,valeur_stat,date_stat) VALUES ('$titre',$pourcentage,'$date')";

	return SQLInsert($SQL); 

	}
function AjouterCV($nom,$prenom,$programme,$name1)
{
	$SQL = "INSERT INTO cvtheque(pdf_diplome,nom_diplome,prenom_diplome,formation_diplome) VALUES ('fichiers/$name1','$nom','$prenom','$programme')";
	return SQLInsert($SQL); 
}
function supprimerCVBDD($val)
{
		$SQL="DELETE FROM cvtheque WHERE id_cv='$val'";
		return SQLDelete($SQL);

}
function supprimerStat($id){
		$SQL="DELETE FROM stat WHERE id_stat='$id'";
		return SQLDelete($SQL);		
}
function ModifierBarre($titre,$pourcentage,$id)
	{
		$date=date('Y-m-d');
		$SQL = "UPDATE stat SET titre_stat='$titre',valeur_stat='$pourcentage',date_stat='$date' WHERE id_stat='$id'";

	return SQLUpdate($SQL); 

	}
function supprimerProgrammeBDD($val)
{
		$SQL="DELETE FROM programme WHERE id_programme='$val'";
		return SQLDelete($SQL);

}
function updateChampsBDD($id,$nom,$description,$session)
{
		$SQL="UPDATE programme SET nom_programme='$nom',description_programme='$description',session_programme='$session' WHERE id_programme='$id'";
		return SQLUpdate($SQL);

}
/*function rendreAdminUtilisateur($id_joueur){
{
$SQL = "UPDATE users SET admin=1 WHERE id_user=$id_user";
 return	SQLUpdate($SQL);
}*/
function rendreNonAdminUtilisateur($id_user){
$SQL = "UPDATE users SET admin=0 WHERE id_user='$id_user'";
 return SQLUpdate($SQL);	
}
function rendreAdminUtilisateur($id_user){
$SQL = "UPDATE users SET admin=1 WHERE id_user='$id_user'";
 return SQLUpdate($SQL);	
}
/////////////////////////////////////////////////////////
///////////FAQ//////////////////////////////////////////
function deleteFaq($id){
	$SQL= SQLDelete("DELETE FROM faq WHERE id_faq=".$id);
	return $SQL;
}
function addFaq($question,$reponse){

	SQLInsert("INSERT INTO faq(question_faq, reponse_faq) VALUES ('".$question."','".$reponse."')");
}
function updateQuestionFaq($id_faq,$newQuestion){
	$SQL="UPDATE faq SET question_faq='$newQuestion' WHERE id_faq='$id_faq'";
	return SQLUpdate($SQL);
}
function updateReponseFaq($id_faq,$newReponse){
	$SQL="UPDATE faq SET reponse_faq='$newReponse' WHERE id_faq='$id_faq'";
	return SQLUpdate($SQL);
}
function verifAdminUser($pseudo_user){
	$SQL="SELECT admin FROM users WHERE pseudo_user='$pseudo_user'";
	return SQLSelect($SQL);
}
function selectFaq(){
	$SQL=SQLSelect('SELECT * FROM faq ORDER BY id_faq DESC');
	return $SQL;
}
function updateMDPBDD($mdp,$id){
	$SQL="UPDATE users SET mdp_user='$mdp' WHERE id_user='$id'";
	return SQLUpdate($SQL);
}
//////////////////////////////////////////////////////////

////////////////////:////////////////////////////////////////
////////////////ACTUALITE////////////////////////////////////
function getArticles($premiereEntree,$nbArticlesParPages){
	//die($premiereEntree." ".$nbArticlesParPages);
	$SQL=SQLSelect("SELECT id_article,titre_article,lien_photo,paragraphe,DATE_FORMAT(date_article, '%d-%m-%Y') AS date_article FROM article ORDER BY id_article DESC LIMIT $premiereEntree,$nbArticlesParPages ");
	return $SQL;
}
function creerArticle($titre,$date,$lien,$contenu){
//	die($date);
	$SQL=SQLInsert("INSERT INTO article(titre_article,date_article,lien_photo,paragraphe) VALUES('$titre','$date','./ressources/photosArticles/$lien','$contenu')");
	return $SQL;
}
function deleteArticle($id_article){
	$SQL=SQLDelete('DELETE FROM article WHERE id_article='.$id_article);
	return $SQL;
}
function getArticle($id){
	$SQL=SQLSelect("SELECT id_article,titre_article,lien_photo,paragraphe,DATE_FORMAT(date_article, '%d-%m-%Y') AS date_article FROM article WHERE id_article=".$id);
	return $SQL;
}
function countArticles(){
	$SQL=SQLSelect("SELECT COUNT(*) AS total FROM article");
	return $SQL;
}
function getCheminPhotoArticle($id_article){
	$SQL=SQLSelect("SELECT lien_photo FROM article WHERE id_article=".$id_article);
	return $SQL;
}
////////////////////////////////////////////////////////////

/////////////////////////QUIZZZ///////////////////////////
//////////////////////////////////////////////////

function selectprogramme()
{
	// cette fonction permet de sélectionner les categories suivant le type d'utilisateur(admin,user,visitor)
	// pour l'admin on lui affiche toutes les categories (où spe_admin=0 && spe_admin=1)
	// user et visitor possèdent les mêmes catégories, on leur affiche les categories "general", pas celle qui sont spécialement dédié à l'admin (où spe_admin=0)

	$SQL= "SELECT nom_programme,id_programme  FROM programme Order by id_programme";

	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	

}

function select_quizz()
{
	// cette fonction permet de sélectionner les categories suivant le type d'utilisateur(admin,user,visitor)
	// pour l'admin on lui affiche toutes les categories (où spe_admin=0 && spe_admin=1)
	// user et visitor possèdent les mêmes catégories, on leur affiche les categories "general", pas celle qui sont spécialement dédié à l'admin (où spe_admin=0)

	$SQL= "SELECT nom_quizz,id_quizz FROM quizz Order by id_quizz";

	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	

}

function select_id_quizz($nom)
{
	$SQL= "SELECT id_quizz FROM quizz WHERE nom_quizz = $nom";
	SQLSelect($SQL);
}

function select_questions($id_quizz,$image)
{
	// cette fonction permet de sélectionner les categories suivant le type d'utilisateur(admin,user,visitor)
	// pour l'admin on lui affiche toutes les categories (où spe_admin=0 && spe_admin=1)
	// user et visitor possèdent les mêmes catégories, on leur affiche les categories "general", pas celle qui sont spécialement dédié à l'admin (où spe_admin=0)

	$SQL= "SELECT question,id_question FROM question  WHERE id_quizz =$id_quizz AND image_question = $image Order by id_question";

	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	

}

function select_questions_all($id_quizz)
{
	// cette fonction permet de sélectionner les categories suivant le type d'utilisateur(admin,user,visitor)
	// pour l'admin on lui affiche toutes les categories (où spe_admin=0 && spe_admin=1)
	// user et visitor possèdent les mêmes catégories, on leur affiche les categories "general", pas celle qui sont spécialement dédié à l'admin (où spe_admin=0)

	$SQL= "SELECT question,id_question FROM question  WHERE id_quizz =$id_quizz Order by id_question";

	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	

}

function select_reponse($vrai_faux,$id_quest)
{
	// cette fonction permet de sélectionner les categories suivant le type d'utilisateur(admin,user,visitor)
	// pour l'admin on lui affiche toutes les categories (où spe_admin=0 && spe_admin=1)
	// user et visitor possèdent les mêmes catégories, on leur affiche les categories "general", pas celle qui sont spécialement dédié à l'admin (où spe_admin=0)

	$SQL= "SELECT reponse,id_reponse FROM reponse WHERE  id_question=$id_quest and vrai_faux = $vrai_faux ";

	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	

}
function select_reponses($id_quest)
{
	// cette fonction permet de sélectionner les categories suivant le type d'utilisateur(admin,user,visitor)
	// pour l'admin on lui affiche toutes les categories (où spe_admin=0 && spe_admin=1)
	// user et visitor possèdent les mêmes catégories, on leur affiche les categories "general", pas celle qui sont spécialement dédié à l'admin (où spe_admin=0)

	$SQL= "SELECT reponse,id_reponse,vrai_faux,image_reponse FROM reponse WHERE  id_question=$id_quest ORDER BY RAND()";

	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	

}

function insert_question($question,$id_quizz,$image)
{
	// insert la vdm2i dans la base de données 
	$SQL="INSERT INTO question(question,id_quizz,image_question) VALUES ('$question','$id_quizz',$image)" ;

	return SQLInsert($SQL);
}

function insert_bonne_rep($reponse,$question,$image)
{ 
	// insert la vdm2i dans la base de données 
	$SQL="INSERT INTO reponse(id_question,vrai_faux,reponse,image_reponse) VALUES ((SELECT id_question FROM question WHERE question = '$question'),1,'$reponse',$image)" ;

	return SQLInsert($SQL);
}

function select_id_quest($question)
{
	// insert la vdm2i dans la base de données 
	$SQL="SELECT id_question FROM question WHERE question = '$question' ";

	return SQLSelect($SQL);
}
function insert_mauvaise_rep($reponse,$question,$image)
{
	// insert la vdm2i dans la base de données 
	$SQL="INSERT INTO reponse(id_question,vrai_faux,reponse,image_reponse) VALUES ((SELECT id_question FROM question WHERE question = '$question'),0,'$reponse',$image)" ;

	return SQLInsert($SQL);
}


function insertquizz($programme,$nom)
{
	// insert la vdm2i dans la base de données 
	$SQL="INSERT INTO quizz(nom_quizz,id_programme) VALUES ('$nom',$programme)";

	return SQLInsert($SQL);
}

function delete_question($id_quest)
{
	$SQL =" DELETE FROM question WHERE id_question=$id_quest";
	SQLDelete($SQL);
}

function delete_reponses($id_quest)
{
	$SQL = " DELETE FROM reponse WHERE id_question=$id_quest";
	SQLDelete($SQL);
}

function update_question($quest,$id_quest)
{
	$SQL = "UPDATE question SET question='$quest' WHERE id_question=$id_quest";
	SQLUpdate($SQL);
}

function update_reponse($rep,$id_rep)
{
	$SQL = "UPDATE reponse SET reponse='$rep' WHERE id_reponse=$id_rep";
	SQLUpdate($SQL);
}

function delete_reponse($id_rep)
{
	$SQL = " DELETE FROM reponse WHERE id_reponse=$id_rep";
	SQLDelete($SQL);
}

function delete_quizz($id_quizz)
{
	$SQL = " DELETE FROM quizz WHERE id_quizz=$id_quizz";
	SQLDelete($SQL);
}
function afficher_question($id){
		$SQL = "SELECT * FROM question WHERE id_quizz=$id ORDER BY RAND() LIMIT 10";
		$rs = SQLSelect($SQL);
		return parcoursRs($rs); 
}
function insert_resultat($prenom,$nom,$score,$email){
	$date_resultat=date('Y-m-d');
	$SQL = "INSERT INTO quizzresultats(nom_resultat,prenom_resultat,score_resultat,mail_resultat,date_resultat) VALUES ('$nom','$prenom',$score,'$email',$date_resultat)";
	return SQLInsert($SQL);
}

function select_resultat(){
	$SQL = "SELECT * FROM quizzresultats ORDER BY date_resultat";
	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
}

function delete_resultat($id_res)
{
	$SQL = " DELETE FROM quizzresultats WHERE id_resultat=$id_res";
	SQLDelete($SQL);
}
/*function delete_questions_reponses($id_quizz)
{
	$SQL = " DELETE FROM question WHERE id_quizz=$id_quizz";
	SQLDelete($SQL);
}*/



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
