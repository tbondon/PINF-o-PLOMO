<?php
// inclure ici la librairie faciliant les requêtes SQL
include_once("maLibSQL.pdo.php");


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
	if ($classe == "bl")
		$SQL .= " where blacklist=1";
	if ($classe == "nbl")
		$SQL .= " where blacklist=0";
	
	// echo $SQL;
	return parcoursRs(SQLSelect($SQL));

}


function interdireUtilisateur($idUser)
{
	// cette fonction affecte le booléen "blacklist" à vrai
	$SQL = "UPDATE users SET blacklist=1 WHERE id_user='$idUser'";
	// les apostrophes font partie de la sécurité !! 
	// Il faut utiliser addslashes lors de la récupération 
	// des données depuis les formulaires

	SQLUpdate($SQL);
}

function autoriserUtilisateur($idUser)
{
	// cette fonction affecte le booléen "blacklist" à faux 
	$SQL = "UPDATE users SET blacklist=0 WHERE id_user='$idUser'";
	SQLUpdate($SQL);
}

function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un user 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès
	$passesec=md5($passe);
	$SQL="SELECT id_user FROM users WHERE pseudo='$login' AND mdp='$passesec'";
	return SQLGetChamp($SQL);
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}
function verifblack($login,$passe)
{
	// Vérifie si le user est blacklisté ou non
	// dont les identifiants sont passes en paramètre
	// renvoie faux si blacklisté
	// renvoie l'id de l'utilisateur si non blacklisté
	$passesec=md5($passe);
	$SQL="SELECT id_user FROM users WHERE pseudo='$login' AND mdp='$passesec' AND blacklist=0";
	return SQLGetChamp($SQL);
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}

function verifadminBdd($login,$passe)
{
	// Vérifie l'identité d'un admin 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si admin inconnu
	// renvoie l'id de l'utilisateur si succès
	$passesec=md5($passe);
	$SQL="SELECT id_user FROM users WHERE pseudo='$login' AND mdp='$passesec' AND admin=1";
	return SQLGetChamp($SQL);
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}


function verifPseudoBdd($pseudo,$mail)
{
	// Vérifie le couple pseudo/mail d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si couple inconnu
	// renvoie l'id de l'utilisateur si succès

	$SQL="SELECT id_user FROM users WHERE pseudo='$pseudo' AND email='$mail'";

	return SQLGetChamp($SQL);
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}

function insertUser($pseudo,$mail,$passe)
{
	// insert le nouvel utilisateur dans la base de données (son pseudo, son mail et son mot de passe crypté grâce à la fonction md5)
	$passesec=md5($passe);
	$SQL="INSERT INTO users (email,pseudo,mdp) VALUES ('$mail','$pseudo','$passesec')";
	return SQLInsert($SQL);
}

function test_mailBdd ($mail)
{
	// Vérifie l'existence d'un email  
	// dont l'adresse est passee en paramètre
	// renvoie faux si inconnu
	// renvoie l'id de l'utilisateur si succès
	$SQL="SELECT id_user FROM users WHERE email='$mail'";
	return SQLGetChamp($SQL);
}

function test_pseudoBdd ($pseudo)
{
	// Vérifie l'existence d'un pseudo 
	// dont l'adresse est passee en paramètre
	// renvoie faux si inconnu
	// renvoie l'id de l'utilisateur si succès
	$SQL="SELECT id_user FROM users WHERE pseudo='$pseudo'";
	return SQLGetChamp($SQL);
}

function insertVdm($pseudo,$message,$sujet,$moderation)
{
	// insert la vdm2i dans la base de données 
	$SQL="INSERT INTO vdm2i (pseudo,vdm2i,categorie,date_vdm,moderation) VALUES ('$pseudo','$message','$sujet',NOW(),'$moderation')";

	return SQLInsert($SQL);
}

function selectmail($id)
{
	// on selectionne le mail de l'utilisateur dont l'id est passé en parametre 
	// renvoie l'adresse mail
	$SQL="SELECT email FROM users WHERE id_user='$id'";
	return SQLGetChamp($SQL);

}

function selectvdm2i($type)
{
	// on passe en paramètre de cette fonction le type de vdm2i qu'on veut (valid ou non valid).
	// valid signifiant modéré et invalid signifiant non modéré(!!!! pas supprimé), l'admin n'a pas choisit
	// si le type choisit est valid on affiche toutes les vdm2i où valid=1
	// si le type choisit est invalid on affiche toutes les vdm2i où valid=0
	if ($type=='valid')
	$SQL= "SELECT id_vdm2i,pseudo,vdm2i,DATE_FORMAT(date_vdm, '%d/%m/%Y à %Hh%i') AS date_vdm FROM vdm2i WHERE valid=1 ORDER BY date_vdm desc";
	else
	$SQL= "SELECT id_vdm2i,pseudo,vdm2i,DATE_FORMAT(date_vdm, '%d/%m/%Y à %Hh%i') AS date_vdm FROM vdm2i WHERE valid=0 ORDER BY date_vdm desc";

	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	// renvoie un tableau avec toutes les vdm2i sélectionnées
}

function selectuser()
{
	$SQL= "SELECT id_user ,pseudo, email,blacklist FROM users";
	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	// renvoie un tableau avec toutes les vdm2i sélectionnées
}
	

function selectvdmbycat($cat)
{
	//die("$cat");
	// c'est la même fonction que selectvdm2i sauf qu'ici on change le paramètre type par le paramètre $cat (categorie) qui permet de trier les vdm2i suivant la categorie sélectionnée
	// on affiche que des vdm2i valid
	$SQL= "SELECT id_vdm2i,pseudo,vdm2i,DATE_FORMAT(date_vdm, '%d/%m/%Y à %Hh%i') AS date_vdm FROM vdm2i WHERE categorie='$cat' AND valid=1 ORDER BY date_vdm desc";
	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	// on retourne toujours les vdm2i sous forme de tableau
}

function selectvdmbytop()
{
	// c'est la même fonction que selectvdm2i sauf qu'ici on selectionne les vdm2i valid par rapport au nombre de like qu'elles ont
	// la fonction n'a pas de parametre
	$SQL= "SELECT id_vdm2i,pseudo,vdm2i,DATE_FORMAT(date_vdm, '%d/%m/%Y à %Hh%i') AS date_vdm FROM vdm2i WHERE valid=1 ORDER BY nb_like_2 DESC";
	
	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	// on retourne toujours les vdm2i sous forme de tableau
}


function selectvdmbyuser($pseudo)
{
	// c'est la même fonction que selectvdm2i sauf qu'ici on change le paramètre type par le paramètre $pseudo (pseudo) qui permet de trier les vdm2i suivant le pseudo selectionné
	// on affiche que des vdm2i valid
	$SQL= "SELECT id_vdm2i,pseudo,vdm2i,DATE_FORMAT(date_vdm, '%d/%m/%Y à %Hh%i') AS date_vdm FROM vdm2i WHERE pseudo='$pseudo' AND valid=1 ORDER BY date_vdm desc";
	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	// on retourne toujours les vdm2i sous forme de tableau
}

function selectonevdm($type,$pseudo)
{
	// Cette fonction selectionne qu'une seule vdm.
	// Les paramètres $type et  $pseudo de la fonction permettent de déterminer si on veut la vdm flop ou la vdm top de l'utilisateur via son pseudo
	if ($type=="top")
	{
		$SQL= "SELECT id_vdm2i,pseudo,vdm2i,DATE_FORMAT(date_vdm, '%d/%m/%Y à %Hh%i') AS date_vdm FROM vdm2i WHERE pseudo='$pseudo' AND valid=1  ORDER BY nb_like_2 DESC LIMIT 0,1";
	}
	elseif ($type=="flop")
	{
		$SQL= "SELECT id_vdm2i,pseudo,vdm2i,DATE_FORMAT(date_vdm, '%d/%m/%Y à %Hh%i') AS date_vdm FROM vdm2i WHERE pseudo='$pseudo' AND valid=1  ORDER BY nb_dislike_2 DESC LIMIT 0,1";
	}
	
		$rs = SQLSelect($SQL);
		return parcoursRs($rs); 
}

function postvalid ($id_vdm,$option)
{
	// ici on gère la validité ou non de la vdm2i
	// pour sélectionner la bonne vdm2i on vérifie id_vdm2i avec l'id_vdm passé en paramètre 
	// si la variable $option passe en parametre egal à "valid" on passe valid à 1 dans la BDD 
	// sinon on passe valid à 2 dans la BDD
	if ($option == "valid")
		$SQL= "UPDATE vdm2i SET valid = 1 WHERE id_vdm2i='$id_vdm'";
	else
		$SQL= "UPDATE vdm2i SET valid = 2 WHERE id_vdm2i='$id_vdm'";

	SQLUpdate($SQL);
}

function findmail ($pseudo)
{
	// on selectionne l'email du user dont le pseudo est passé en paramètre
	$SQL= "SELECT email FROM users WHERE pseudo='$pseudo'";

	return SQLGetChamp($SQL);
}

function sendMail($email,$objet,$messageHTML,$messageNormal)
{
	// cette fonction permet d'envoyer un message à l'utilisateur pour lui dire que sa vdm2i à bien été modéré sans que le mail soit placé dans les "indésirables"
	// fonction prise sur internet
	date_default_timezone_set('Etc/UTC');
	require 'mailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "mailvdm2i@gmail.com";
	$mail->Password = "bondonlehenaff";
	$mail->setFrom('mailvdm2i@gmail.com', 'vdm2i');
	$mail->addReplyTo('mailvdm2i@gmail.com', 'vdm2i');
	$mail->addAddress($email);
	$mail->Subject = $objet;
	$mail->IsHTML(true);
	$mail->Body = $messageHTML;
	$mail->AltBody = $messageNormal;
	$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
	);


	if (!$mail->send()) 
	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
    	echo "Message sent!";
   	}
}

function verifmoderationBdd($id_vdm)
{
	// on verifie si la vdm2i dont l'id est passé en paramètre à été modéré ou non 
	// si elle a été modéré on renvoie son id sinon on renvoie rien

	$SQL="SELECT id_vdm2i FROM vdm2i WHERE id_vdm2i='$id_vdm' AND moderation=1";

	return SQLGetChamp($SQL);
}

function nblike($id_vdm,$type)
{
	// cette fonction permet d'afficher le nombre de like/dislike de la vdm2i dont l'id est passé en paramètre suivant si la variable passé en paramètre $type égal à like ou dislike 
	if ($type=='like')
		$SQL="SELECT COUNT(*) FROM likes WHERE id_vdm2i='$id_vdm' and iflike=1";
	else
		$SQL="SELECT COUNT(*) FROM likes WHERE id_vdm2i='$id_vdm' and ifdislike=1";


	return SQLGetChamp($SQL);

}


function selectclassement ($classement,$bycat,$bynormal,$cat)
{
	// cette fonction permet d'afficher les top et les flop.
	//on sélectionne les trois premiers (limit 0,3) utilisateurs qui ont le plus de like/dislike
	// pour cela on place 4 parametres : le type de classement($classement)(top/flop), $bycat qui signifie qu'on veut un classement par catégorie,$bynormal qui signifie qu'on veut un classement général (avec toutes les catégories), et le dernier paramètre qui est la catégorie ($cat) sélectionné quand on a choisit "$bycat"

	if ($classement == "top")
	{
		if ($bynormal==1)
			$SQL="SELECT pseudo,SUM(nb_like_2) AS totlike FROM vdm2i WHERE valid=1 GROUP BY pseudo ORDER BY totlike DESC LIMIT 0,3";
		elseif ($bycat==1)
			$SQL="SELECT pseudo,SUM(nb_like_2) AS totlike FROM vdm2i WHERE categorie='$cat' AND valid=1 GROUP BY pseudo ORDER BY totlike DESC LIMIT 0,3";
	}
	
	else
	{
		if ($bynormal==1)
			$SQL="SELECT pseudo,SUM(nb_dislike_2) AS totdislike FROM vdm2i WHERE valid=1 GROUP BY pseudo ORDER BY totdislike DESC LIMIT 0,3";
		elseif ($bycat==1)
			$SQL="SELECT pseudo,SUM(nb_dislike_2) AS totdislike FROM vdm2i WHERE categorie='$cat' AND valid=1 GROUP BY pseudo ORDER BY totdislike DESC LIMIT 0,3";
	}
	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	// on renvoit le resultat sous forme de tableau
}

function selectcat($type)
{
	// cette fonction permet de sélectionner les categories suivant le type d'utilisateur(admin,user,visitor)
	// pour l'admin on lui affiche toutes les categories (où spe_admin=0 && spe_admin=1)
	// user et visitor possèdent les mêmes catégories, on leur affiche les categories "general", pas celle qui sont spécialement dédié à l'admin (où spe_admin=0)

	if ($type=='admin')
		$SQL= "SELECT nom_cat,id_cat  FROM categorie Order by id_cat";
	else
		$SQL= "SELECT nom_cat,id_cat  FROM categorie WHERE spe_admin=0 Order by id_cat";
	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	

}


function selectcatselectionnable()
{
	// Cette fonction permet de sélectionner les categories dans lesquels l'utilisateur pourra rentrer ses vdm2i, pour cela nous avons créé une colonne selectionnable dans la BDD
	// par exemple nous n'allons pas donner la possibilité à l'utilisateur de renter sa vdm2i dans la categorie top
	// cette fonction ne reçoit pas de paramètre, on sélectionne juste les categorie où selectionnable=1
	$SQL= "SELECT nom_cat,id_cat  FROM categorie WHERE selectionnable=1 Order by id_cat";
	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
	// on retourne toujours les vdm2i sous forme de tableau
}

function likeornot($iduser,$idvdm)
{
	// cette fonction qui prend en parametre l'id du user er l'id de la vdm permet de voir si la vdm séléctionné à déja été liké ou non par l'utilisateur
	// si elle a deja été liké on revoie la valeur du like (1=like, -1=pas de like)
	// sinon on renvoie 5
	$SQL="SELECT iflike  FROM likes WHERE id_user='$iduser' and id_vdm2i='$idvdm'";
	$var=SQLGetChamp($SQL);
	
	if($var==1 or $var == -1) return $var;

	else return 5;
	
}
				
function putlike($idvdm,$iduser)
{
	// on insert respectivement dans la BDD likes l'id du user et l'id de la vdm qui sont passés en paramètres et 1 dans id_user, id_vdm2i et iflike
	// on insert les likes dans les 3 BDD likes, users et vdm2i
	$sql="UPDATE `users` set `nb_like`=nb_like+1 WHERE id_user=$iduser";
	SQLUpdate($sql);
	$sql="UPDATE `vdm2i` set `nb_like_2`=nb_like_2+1 WHERE id_vdm2i=$idvdm";
	SQLUpdate($sql);
	$SQL="INSERT INTO likes (id_user,id_vdm2i,iflike) VALUES ('$iduser','$idvdm',1)";
	return SQLInsert($SQL);


}

function updatelike($like,$dislike,$idvdm,$iduser)
{
	// cette fonction permet de mettre à jour les likes, si la personne a déjà liké on enlève son like (-1) sinon on met un like (1)
	// on met à jour les likes dans les 3 BDD likes, users et vdm2i
	// dans les 2 cas on enleve les dislikes (-1)
	if ($like==1 && $dislike==-1)
	{
		$SQL = "UPDATE likes SET iflike=-1, ifdislike=-1 WHERE id_user='$iduser' and id_vdm2i='$idvdm'";
		$sql="UPDATE `users` set `nb_like`=nb_like-1 WHERE id_user=$iduser";
		$SQLL="UPDATE `vdm2i` set `nb_like_2`=nb_like_2-1 WHERE id_vdm2i=$idvdm";	
	}

	elseif ($like==-1 && $dislike==-1)
	{
		$SQL = "UPDATE likes SET iflike=1, ifdislike=-1 WHERE id_user='$iduser' and id_vdm2i='$idvdm'";
		$sql="UPDATE `users` set `nb_like`=nb_like+1 WHERE id_user=$iduser";
		$SQLL="UPDATE `vdm2i` set `nb_like_2`=nb_like_2+1 WHERE id_vdm2i=$idvdm";
	}
	elseif ($like==-1 && $dislike==1)
	{
		$SQL = "UPDATE likes SET iflike=1, ifdislike=-1 WHERE id_user='$iduser' and id_vdm2i='$idvdm'";
		$sql="UPDATE `users` set `nb_like`=nb_like+1,`nb_dislike`=nb_dislike-1 WHERE id_user=$iduser";
		$SQLL="UPDATE `vdm2i` set `nb_like_2`=nb_like_2+1,`nb_dislike_2`=nb_dislike_2-1 WHERE id_vdm2i=$idvdm";
	}

	SQLUpdate($sql);
	SQLUpdate($SQL);
	SQLUpdate($SQLL);
}

function dislikeornot($iduser,$idvdm)
{
	// pareil que la fonction likeornot mais pour les dislikes
	$SQL="SELECT ifdislike  FROM likes WHERE id_user='$iduser' and id_vdm2i='$idvdm'";
	$var=SQLGetChamp($SQL);
	
	if($var==1 or $var == -1) return $var;

	else return 5;
	
}
				
function putdislike($idvdm,$iduser)
{
	// pareil que la fonction putlike mais pour les dislikes
	$sql="UPDATE `users` set `nb_dislike`=nb_dislike+1 WHERE id_user=$iduser";
	SQLUpdate($sql);
	$sql="UPDATE `vdm2i` set `nb_dislike_2`=nb_dislike_2+1 WHERE id_vdm2i=$idvdm";
	SQLUpdate($sql);
	$SQL="INSERT INTO likes (id_user,id_vdm2i,ifdislike) VALUES ('$iduser','$idvdm',1)";
	return SQLInsert($SQL);
}

function updatedislike($like,$dislike,$idvdm,$iduser)
{
	// pareil que la fonction updatelike mais pour les dislikes
	if ($like==-1 && $dislike==1)
	{
		$SQL = "UPDATE likes SET iflike=-1, ifdislike=-1 WHERE id_user='$iduser' and id_vdm2i='$idvdm'";
		$sql="UPDATE `users` set `nb_dislike`=nb_dislike-1 WHERE id_user=$iduser";
		$SQLL="UPDATE `vdm2i` set `nb_dislike_2`=nb_dislike_2-1 WHERE id_vdm2i=$idvdm";
	}

	elseif ($like==-1 && $dislike==-1)
	{
		$SQL = "UPDATE likes SET iflike=-1,ifdislike=1 WHERE id_user='$iduser' and id_vdm2i='$idvdm'";
		$sql="UPDATE `users` set `nb_dislike`=nb_dislike+1 WHERE id_user=$iduser";
		$SQLL="UPDATE `vdm2i` set `nb_dislike_2`=nb_dislike_2+1 WHERE id_vdm2i=$idvdm";
	}

	elseif ($like==1 && $dislike==-1)
	{
		$SQL = "UPDATE likes SET iflike=-1, ifdislike=1 WHERE id_user='$iduser' and id_vdm2i='$idvdm'";
		$sql="UPDATE `users` set `nb_like`=nb_like-1,`nb_dislike`=nb_dislike+1 WHERE id_user=$iduser";
		$SQLL="UPDATE `vdm2i` set `nb_like_2`=nb_like_2-1,`nb_dislike_2`=nb_dislike_2+1 WHERE id_vdm2i=$idvdm";
	}

	
	
	SQLUpdate($sql);
	SQLUpdate($SQL);
	SQLUpdate($SQLL);
}

function updatepseudo($iduser,$pseudo)
{
	// ici on met à jour le pseudo de l'utilisateur, pour cela on cible l'utilisateur avec son id ($iduser) et on change son pseudo par le pseudo passé en paramètre ($pseudo)
	$SQL = "UPDATE users SET pseudo='$pseudo' WHERE id_user='$iduser'";
	SQLUpdate($SQL);
}

function testmdp($old_pass,$iduser)
{ 
	// cette foncion permet de tester si un mdp correspond à un user
	// pour cela on prend le MDP de l'utilisateur ciblé grace à son id ($iduser) passé en paramètre
	//ensuite on compare ce MDP avec le MDP passé en paramètre ($old_pass) qu'on a prealablement séquencé
	// si les 2 MDP correspondent on retourne true sinon false
	$SQL="SELECT mdp  FROM users WHERE id_user='$iduser'";
	$var=SQLGetChamp($SQL);
	$old_pass_sec=md5($old_pass);
	if ($var==$old_pass_sec) return true;
	else return false;
}

function updatemdp($new_pass,$iduser)
{
	// ici on met à jour le mot de passe de l'utilisateur, pour cela on cible l'utilisateur avec son id ($iduser) et on change son MDP par le MDP passé en paramètre ($new_pass)
	// il faut bien faire attention à séquencer le MDP avant de l'insérer dans la BDD
	$new_pass_sec=md5($new_pass);
	$SQL = "UPDATE users SET mdp='$new_pass_sec' WHERE id_user='$iduser'";
	SQLUpdate($SQL);
}

function delete_count($iduser)
{
	// cette fonction permet de supprimer un utilisateur grace à son id ($iduser) passé en paramètre
	$SQL="DELETE FROM users WHERE id_user='$iduser'";
	SQLDelete($SQL);
}

function delete_vdm($pseudo)
{
	// cette fonction permet de supprimer toutes les vdm2i d'un utilisateur via son pseudo ($pseudo) passé en paramètre
	$SQL="DELETE FROM vdm2i WHERE pseudo='$pseudo'";
	SQLDelete($SQL);
}

function selectdate ($pseudo)
{
	// cette fonction permet de prendre la date à laquelle l'utilisateur à créé son compte 
	// on se sert de son pseudo passé en paramètre pour trouver la bonne date 
	$SQL="SELECT DATE_FORMAT(date_ins, '%d/%m/%Y') AS date_ins FROM users WHERE pseudo='$pseudo'";
	return SQLGetChamp($SQL);
}

function nbvdmbyuser($pseudo)
{
	// cette fonction permet de calculer le nombre de vdm2i valide qu'a ecrit l'utilisateur 
	// on se sert de son pseudo passé en paramètre pour trouver le resultat 
	$SQL="SELECT COUNT(*) FROM vdm2i WHERE pseudo='$pseudo' and valid=1";
	return SQLGetChamp($SQL);
}

function nblikebyuser($id)
{
	// cette fonction permet de calculer le nombre total de like qu'a l'utilisateur 
	// on se sert de son id passé en paramètre pour trouver le resultat 
	$SQL="SELECT nb_like FROM users WHERE id_user='$id'";
	return SQLGetChamp($SQL);
}

function nbdislikebyuser($id)
{
	// cette fonction permet de calculer le nombre total de dislike qu'a l'utilisateur 
	// on se sert de son id passé en paramètre pour trouver le resultat 
	$SQL="SELECT nb_dislike FROM users WHERE id_user='$id'";
	return SQLGetChamp($SQL);
}

function nbcat ()
{
	// cette fonction calcule le nombre de categorie sélectionnable (les catégories dans lesquels nous pouvons publier), par exemple top, mes vdm2i ne sont pas des catégories sélectionnable
	$SQL= "SELECT COUNT(*)  FROM categorie Where selectionnable = 1";
	return SQLGetChamp($SQL);
}

function ajoutercat ($cat,$nbcat)
{
	// cette fonction qui recoit en parametre le nom de la catégorie à ajouter et le nombre de categorie selectionnable permet d'ajouter une catégorie
	//on rajoute au nombre de categorie sélectionnable 5 (le nb de categorie non sélectionnable) et 1 pour pas ecraser la derniere categorie soit 6 en tout
	// son id correspond donc au nouveau nombre de categorie ($nbcat) et son nom au nom passé en paramètre ($cat)
	$nbcat += 6;
	$SQL="INSERT INTO categorie(id_cat,nom_cat,selectionnable,spe_admin) VALUES ('$nbcat','$cat',1,0)";
	//$SQL="INSERT INTO likes (id_user,id_vdm2i,iflike) VALUES ('$iduser','$idvdm',1)";
	SQLInsert($SQL);
}

function supprimercat ($cat)
{
	// cette fonction permet de supprimer une catégorie, elle prend juste en paramètre la catégorie à supprimer
	// tout d'abord o récupère l'id de la cat à supprimer
	// ensuite on supprime la catégorie et toutes les vdm2i qui appartiennent à cette catégorie
	// pour finir on baisse de 1 tout les id des catégories suppérieur à l'id de la categorie supprimé
	$SQL="SELECT id_cat FROM categorie WHERE nom_cat='$cat'";
	$id=SQLGetChamp($SQL);
	$SQL="DELETE FROM categorie WHERE nom_cat='$cat'";
	SQLDelete($SQL);
	$categorie="cat".$id;
	$SQL="DELETE FROM vdm2i WHERE categorie='$categorie'";
	SQLDelete($SQL);
	$SQL = "UPDATE categorie SET id_cat=id_cat-1 WHERE id_cat>'$id'";
	SQLUpdate($SQL);
}

function catexist ($cat)
{
	// ici nous testons si une catégorie existe ou non 
	// on teste cela avec le nom de la categorie passé en paramètre
	$SQL="SELECT nom_cat FROM categorie WHERE nom_cat='$cat'";
	$var=SQLGetChamp($SQL);
	if ($var==$cat) return 1;
	else return 0;
}

function selectsearch ($search)
{
	// cette fonction permet de selctionner les resultats correspondant à la recherche faite auparant
	// pour cela on passe en paramètre la recharche 
	// puis nous recherchons dans la BDD vdm2i les vdm2i contiennent la recherche ($search) passé en paramètre
	// pour cela nous faisons un like % $search %, le premier pourcentage permet de chercher la recherche avec n'importe quel caractère avant et le deuxieme pourcentage permet de chercher la recherche avec n'importe quel caractère après
	$SQL="SELECT vdm2i,id_vdm2i,pseudo,DATE_FORMAT(date_vdm, '%d/%m/%Y à %Hh%i') AS date_vdm FROM vdm2i WHERE vdm2i and valid=1 like '%".$search."%'";
	$rs = SQLSelect($SQL);
	return parcoursRs($rs); 
}



?>
