<?php

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

?>
<!--<link rel="stylesheet" type="text/css" href="./css/faq.css">
-->
<style type="text/css">

	.faq-etendu{
                margin-top:162px;
         }	

	.survole
	{
		border: lightgrey solid 1px;
		cursor: pointer;
	}

	.croix
	{
		
		display: block;
		position: absolute;
		width: 25px;
		height: 25px;
		left:13%;
		cursor: pointer;

	}
	.survoleFaq{
		border: grey solid 1px;
		padding: 10px;
		padding-left: 50px;
	}
	.textarea
	{
		display: block;
		width:750px;
		height:30em;
	}
	.question
	{
		color: #13458f;
		font-size: 2em;
		cursor:pointer;
		
	}
	.question:hover
	{
		color: #3e90f0;
		transition:0.3s;
	}
	
	.reponse
	{
		color: #6D6D6D;
		font-size: 1em;
		display:none;
		/*background-color:;*/
		
	}
	.faq
	{
		margin-left: 10%;
		margin-top: 100px;
		width: 80%;
	display: flex;
    
		
	}
	
	#zoneFaq
	{
		margin: 2%;
		margin-bottom:100px;
		margin-left:5%;
		margin-right:20%;
	}
	.arrow
	{
		/*float:left;
		position:absolute;
		left:9%;
		margin-top:0.5%;
		width :2%;
		height:2%;*/
		width :20px;
		height:20px;
	}
	.editor
	{
		margin-left:0%;
		margin-right:20%;
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
	
	    //console.log($(window).scrollTop());
	
	    if ($(window).scrollTop() > 100) {
	      $('#faq').addClass('faq-etendu');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#faq').removeClass('faq-etendu');
	     
	    }
	  });
	});
	

</script>

<div class="page-header" id="faq" >	
<?php
//on recup la variable admin de l'user co


		//on recupère la variable admin
		$reponse= verifAdminUser($_SESSION["pseudo"]);
		$admin= parcoursRs($reponse);
		if($admin[0]["admin"]==1)
		{
			//si admin on affiche la page admin
			echo "<script src='./js/jsAdminFaq.js' type='text/javascript'></script>";//si admin ca charge une page js qui contient les interactions pour supprimer les questions reponses
			include("./templates/adminFaq.php");//ca charge le formulaire pour mettre des questions et reponses 
		}else echo "<script src='./js/nonAdminFaq.js' type='text/javascript'></script>";	
?>
<div id="zoneFaq">
<?php
// On récupère tout le contenu de la table faq pour tout le monde
	$reponse = selectFaq();
	$donnees=parcoursRs($reponse);
	foreach($donnees as $data)
	{
		if(isset($data))  
		{
  ?>



<div class="faq" id=<?php echo $data["id_faq"] ?>>
	<!--<img src="./ressources/right-arrow.png" class="arrow"/>-->
	<div><!--NE PAS AJOUTER D'ELT HTML OU RETIRER DES NOMS DE CLASSES JUSTE AJOUTER DES NOM DE CLASS-->
		<div class="question"><img src="./ressources/right-arrow.png" class="arrow"/><?php echo $data["question_faq"] ?>
		</div>
		<div class="reponse"><?php echo $data["reponse_faq"] ?>
		</div>
	</div>
</div>

<?php
		}
	}
?>
