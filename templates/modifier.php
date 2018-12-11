<?php
include_once("libs/fonctions.php");
include_once("libs/modele.php");
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
<style>
	.all
	{
		margin-top : 100px;
	}
	.btn2:hover
	{
		background-color : orange
	}
	.btn2
	{
		width : 30px;
		border-radius : 100px;
	}
	#test{
		margin-top : -25px;
		margin-left : 30px;
	}
	.question2{
		margin-top : 100px;
	}
	.repList{
		margin-top : 100px;
	}
	.page-header{
		margin-top : 50px;
	}
	.quizz-etendu{
                margin-top:112px;
        }
</style>

<script>
	$(document).ready(function() {
		  //change the integers below to match the height of your upper dive, which I called
		  //banner.  Just add a 1 to the last number.  console.log($(window).scrollTop())
		  //to figure out what the scroll position is when exactly you want to fix the nav
		  //bar or div or whatever.  I stuck in the console.log for you.  Just remove when
		  //you know the position.
		$(window).scroll(function () { 
		
				
		
			if ($(window).scrollTop() > 100) {
				$('#page-quizz').addClass('quizz-etendu');
			}
		
			if ($(window).scrollTop() < 101) {
				$('#page-quizz').removeClass('quizz-etendu');
		      
			}
		});
	});
</script>

<script src="jquery.js"></script>
<script>

$(document).ready(function(){
	var connecte = '<?php echo $_SESSION["connecte"]; ?>';

	if (connecte){
	         var admin='<?php echo isAdmin($_SESSION["id_joueur"]); ?>';
	         if (admin){
	                  	var bloc_base = $('<div class="all"><div class = "success"></div><div class="blocChoixCat"><br><div class="input-group"><select class="custom-select" id="inputGroupSelect04"><option selected value="error">Choisissez votre quizz</option></select><div class="input-group-append"></div></div><div class="alert2"></div></div><div class="bloc"><div class="aj_question"><div class = "button"></div><div class = "button2"></div></div></div><div class="bloc_list"><div class="question2">	<div class="input-group mb-3"><div class="input-group-prepend"><label class="input-group-text" for="inputGroupSelect01">Question sans images</label></div><select class="custom-select" id="inputGroupSelect01" name="question"></select></div><div class="valid"></div></div><div class="repList"></div></div></div>');

						lister_quizz(bloc_base);
						
						$(".page-header").append(bloc_base);
	         }
	         else{
	                  
	         }
		
	}
	else
	{
		
	}
			
});
var nb_mauvaise_rep = 0;

function lister_quizz(bloc_base){
	$(".bloc",bloc_base).css("display" , "none");
	$(".bloc_list",bloc_base).css("display" , "none");
	$(".blocChoixCat",bloc_base).css("display" , "block");
	$.getJSON(
			"data.php",
			{"action":"select_quizz"
			},
			function(oRep)
			{
	
				$(".select_quizz",bloc_base).html("");
				for (var i=0; i<oRep.quizz.length;i++)
				{

					$(".custom-select",bloc_base).append("<option value='"+oRep.quizz[i]["id_quizz"]+"'>"+oRep.quizz[i]["nom_quizz"]+"</option>");
				}
					$(".input-group-append",bloc_base).html($('<button class="btn btn-outline-secondary" type="button">Valider</button>').click(function(){
							var idQuizz=$("#inputGroupSelect04 option:selected", bloc_base).val();
							$('#idQuizz','body').val(idQuizz);
							var yo = $('#idQuizz','body').val();
				
							if (idQuizz == "error")
							{
								$(".alert2",bloc_base).html('<div class="alert alert-danger">Veuillez choisir un quizz svp.</div>');
							}
					
							else{
								$(".bloc",bloc_base).css("display" , "block");
								$(".bloc_list",bloc_base).css("display" , "block");
								$(".blocChoixCat",bloc_base).css("display" , "none");
								lister_question(bloc_base,idQuizz);
								lister_question_image(bloc_base,idQuizz);
								ajouter_question(bloc_base,idQuizz);
								ajouter_question_image(bloc_base,idQuizz);
							}
					}));
			});
	/*$.ajax({
		url:"data.php",
		type:"GET",
		data:{
			"action":"select_quizz"
		},
		success:function(oRep){
			console.log("success | Crédit to ZOUZOU");
			oRep=JSON.parse(oRep);
			$(".select_quizz",bloc_base).html("");
				for (var i=0; i<oRep.quizz.length;i++)
				{

					$(".select_quizz",bloc_base).append("<option value='"+oRep.quizz[i]["id_quizz"]+"'>"+oRep.quizz[i]["nom_quizz"]+"</option>");
				}
					$(".valid2",bloc_base).html($('<button class="btn">Valider</button>').click(function(){
						$(".bloc",bloc_base).css("display" , "block");
						$(".bloc_list",bloc_base).css("display" , "block");
						$(".blocChoixCat",bloc_base).css("display" , "none");
						var idQuizz=$(".select_quizz option:selected", bloc_base).val();
						//lister_question(bloc_base,idQuizz);
					//	ajouter_question(bloc_base,idQuizz);
					}));
		}
	});*/
}

/////////////////////////////////////////////////// QUESTION /////////////////////////////////////////////////////////////
function afficherQuest(bloc_base,id,quest,idQuizz){
$(".bloc_quest",bloc_base).html(quest);
$(".bloc_quest",bloc_base).append($('<img class="btn2" src="ressources/modifier.png" />').click(function(){
		bloc_modif=$(this).parent();
		modifierQuest(bloc_modif,id,quest,idQuizz);
	}));
		
$(".bloc_quest",bloc_base).append($('<img class="btn2" src="ressources/Croix.png" />').click(function(){
		supprimer_question(bloc_base,id,quest,idQuizz)
	}));
}

function modifierQuest(bloc_modif,id,quest,idQuizz){
	$(bloc_modif).html("<input class='input_modif2' type='text' name='quest' value=''>");
	$(".input_modif2").val(quest);
	$(bloc_modif).append($('<img class="btn2" src="ressources/check.png" />').click(function(){
		var question = $(".input_modif2",bloc_modif).val();
		bloc_modif=$(this).parent().parent();
		$.getJSON(
					"data.php",
					{"action":"modifierQuest",
					 "question": question,
					 "id" : id},
					function(oRep2)
					{
						afficherQuest(bloc_modif,id,question,idQuizz);
					});
		}));

}

function supprimer_question(bloc_base,id,quest,idQuizz){
	if(confirm("Etes vous sûr de vouloir supprimer cette question : '"+quest+"' ?")){
		$.getJSON(
					"data.php",
					{"action":"supprimer_question",
					 "id" : id},
					function(oRep2)
					{
						
						$(".repList",bloc_base).html("");
						$(".question2",bloc_base).css("display","block");
						lister_question(bloc_base,idQuizz);
					});
		}
}

//////////////////////////////////////////////Rep//////////////////////////////////////////////////////////////////////////

function ajoutMauvRep(bloc_modif,quest,idQuizz){
	$(".btn2",bloc_modif).css("display","none");
	$(bloc_modif).append('<br><div class="ajoutMauvRep"><span class="required">Mauvaise réponse :</span><input type="text" id="mauvaiseRep" value=""/></div>'); 

		$(".ajoutMauvRep",bloc_modif).append($('<button type="button">Ajouter</button>').click(function(){ 
			var mauvaise_rep = $("#mauvaiseRep",bloc_modif).val();
				$.getJSON(
					"data.php",
					{"action":"ajouter_mauvaise_reponse",
					 "reponse": mauvaise_rep,
					 "question" : quest},
					function(oRep2)
					{
						bloc_base= $(bloc_modif).parent().parent();
						afficher_question(bloc_base,idQuizz);
					});
				
			}));	
}

function modifier_Rep(bloc_base,div,rep,idQuizz){
	$(bloc_base).html("<input class='input_modif' type='text' name='rep' value=''>");
	$(".input_modif").val(rep);
	$(bloc_base).append($('<img class="btn2" src="ressources/check.png" />').click(function(){
		//$(".btn2",bloc_base).css("display","none");
		var reponse = $(".input_modif",bloc_base).val();
		bloc_base=$(this).parent().parent();
		$.getJSON(
					"data.php",
					{"action":"modifierRep",
					 "reponse": reponse,
					 "id" : div},
					function(oRep2)
					{
						afficher_Rep(bloc_base,div,reponse,idQuizz);
					});
	}));
}

function afficher_Rep(bloc_base,div,rep,idQuizz){
	$("#"+div,bloc_base).val(rep);
	$("#id"+div+" > .input-group-append",bloc_base).html($('<button class="btn btn-outline-secondary" type="button">Modifier</button>').click(function(){
	var reponse = $("#"+div,bloc_base).val();
		bloc_base=$(this).parent().parent();
		$.getJSON(
					"data.php",
					{"action":"modifierRep",
					 "reponse": reponse,
					 "id" : div},
					function(oRep2)
					{
						afficher_Rep(bloc_base,div,reponse,idQuizz);
					});
	}));
	$("#id"+div+" > .input-group-append",bloc_base).append($('<button class="btn btn-outline-secondary" type="button">Supprimer</button>').click(function(){
		bloc_supp=$(this).parent().parent().parent().parent().parent() ;
		supprimer_Rep(bloc_supp,div,rep,idQuizz);
		
	}));
}

function afficher_Rep2(bloc_base,div,rep,idQuizz){
$("#"+div,bloc_base).val(rep);
	$("#id"+div+" > .input-group-append",bloc_base).html($('<button class="btn btn-outline-secondary" type="button">Modifier</button>').click(function(){
	var reponse = $("#"+div,bloc_base).val();
		bloc_base=$(this).parent().parent();
		$.getJSON(
					"data.php",
					{"action":"modifierRep",
					 "reponse": reponse,
					 "id" : div},
					function(oRep2)
					{
						afficher_Rep2(bloc_base,div,reponse,idQuizz);
					});
	}));
}


function supprimer_Rep(bloc_base,div,rep,idQuizz){
	if(confirm("Etes vous sûr de vouloir supprimer cette réponse : '"+rep+"' ?")){
		$.getJSON(
					"data.php",
					{"action":"suppRep",
					 "id" : div},
					function(oRep2)
					{
						afficher_question(bloc_base,idQuizz);						
					});

	}

}

function lister_question(bloc_base,idQuizz){
	$.getJSON(
			"data.php",
			{"action":"select_questions",
			 "idQuizz" : idQuizz},
			function(oRep)
			{
				$("#inputGroupSelect01",bloc_base).html("");
				for (var i=0; i<oRep.questions.length;i++)
				{

					$("#inputGroupSelect01",bloc_base).append("<option value='"+oRep.questions[i]["id_question"]+"'>"+oRep.questions[i]["question"]+"</option>");
				}
					$(".valid",bloc_base).html($('<button class="btn">Valider</button>').click(function(){
					afficher_question(bloc_base,idQuizz);
					}));
			});
	
}

function lister_question_image(bloc_base,idQuizz){
	$.getJSON(
			"data.php",
			{"action":"select_questions_image",
			 "idQuizz" : idQuizz},
			function(oRep)
			{
				$(".question2",bloc_base).append('<div class="input-group mb-3" style="margin-top:50px"><div class="input-group-prepend"><label class="input-group-text" for="inputGroupSelect01">Question avec images</label></div><select class="custom-select" id="inputGroupSelect06" name="question"></select></div><div id="valid2" class="valid"></div>');
				for (var i=0; i<oRep.questions.length;i++)
				{

					$("#inputGroupSelect06",bloc_base).append("<option value='"+oRep.questions[i]["id_question"]+"'>"+oRep.questions[i]["question"]+"</option>");
				}
				$("#valid2",bloc_base).html($('<button type="button" class="btn" data-toggle="modal" data-target="#myModal2">valider</button>').click(function(){
					var idQuest = $("#inputGroupSelect06 option:selected", bloc_base).val();
					var nomQuest = $("#inputGroupSelect06 option:selected", bloc_base).html();
					console.log(idQuest);
					console.log(nomQuest);
					$(".pop_up_form").html('<input required type="hidden" name="id_quest" value="'+idQuest+'">');
					$("#pop_up_quest").html('<span class="input-group-text" id="inputGroup-sizing-lg">Question</span>'+nomQuest);
					$.getJSON(
							"data.php",
							{"action":"select_bonne_rep",
							 "idQuest" : idQuest},
							function(oRep1)
							{
								for (var i=0; i<oRep1.bonRep.length;i++)
								{
									var div=oRep1.bonRep[i]["id_reponse"];
									var rep = oRep1.bonRep[i]["reponse"];
									$(".pop_up_form").append('<input required type="hidden" name="bonimg" value="'+rep+'">');
									bloc_modif=$(".pop_up_rep").append('<br><label>Bonne image : </label><img src="ressources/photosQuizz/'+rep+'" style="height:60px;margin-left: 60px;" />');
								}
							});
					
					$.getJSON(
							"data.php",
							{"action":"select_mauvaise_rep",
							 "idQuest" : idQuest},
							function(oRep2)
							{
								for (var i=0; i<oRep2.mauvRep.length;i++)
								{
									var div=oRep2.mauvRep[i]["id_reponse"];
									var rep = oRep2.mauvRep[i]["reponse"];
									$(".pop_up_form").append('<input required type="hidden" name="mauvimg'+i+'" value="'+rep+'">');
									bloc_modif=$(".pop_up_rep").append('<br><label>Mauvaise image : </label><img src="ressources/photosQuizz/'+rep+'" style="height:60px;margin-left: 15px;margin-top:5px;" />');
								}
							});
									
				}));
			});
	
}
	
function ajouter_btn_changer(bloc_base,idQuizz){
	$(".changer",bloc_base).append($('<button type="button">Modifier une autre question</button>').click(function(){
			$(".repList",bloc_base).html("");
			$(".question2",bloc_base).css("display","block");
			lister_question(bloc_base,idQuizz);
		}));
}

function afficher_question(bloc_base,idQuizz){
	$(".question2",bloc_base).css("display","none");
	var idQuest = $("#inputGroupSelect01 option:selected", bloc_base).val();
	var nomQuest = $("#inputGroupSelect01 option:selected", bloc_base).html();
	$(".repList",bloc_base).html("<div class='bloc_quest'></div><div class='bonRep'>Bonne(s) réponse(s)</div><div class='mauvRep'>Mauvaise(s) réponse(s)</div><div class='changer'></div>");

	afficherQuest(bloc_base,idQuest,nomQuest,idQuizz);
	$(".mauvRep",bloc_base).append($('<img class="btn2" src="ressources/plus.png" style ="diplay : block;" />').click(function(){
		bloc_modif=$(this).parent();
		ajoutMauvRep(bloc_modif,nomQuest,idQuizz);
	}));

	$.getJSON(
			"data.php",
			{"action":"select_bonne_rep",
			 "idQuest" : idQuest},
			function(oRep1)
			{

				for (var i=0; i<oRep1.bonRep.length;i++)
				{
					var div=oRep1.bonRep[i]["id_reponse"];
					var rep = oRep1.bonRep[i]["reponse"];
					bloc_modif=$(".bonRep",bloc_base).append('<div class="input-group" id="id'+div+'"><input type="text" id="'+div+'" class="form-control" value="" aria-describedby="basic-addon2"><div class="input-group-append"></div></div>');
					afficher_Rep2(bloc_modif,div,rep,idQuizz);
				}
			});

	$.getJSON(
			"data.php",
			{"action":"select_mauvaise_rep",
			 "idQuest" : idQuest},
			function(oRep2)
			{
				for (var i=0; i<oRep2.mauvRep.length;i++)
				{
					var div=oRep2.mauvRep[i]["id_reponse"];
					var rep = oRep2.mauvRep[i]["reponse"];
					bloc_modif=$(".mauvRep",bloc_base).append('<div class="input-group" id="id'+div+'"><input type="text" id="'+div+'" class="form-control" value="" aria-describedby="basic-addon2"><div class="input-group-append"></div></div>');
					afficher_Rep(bloc_modif,div,rep,idQuizz);
				}
			});
					
					
	ajouter_btn_changer(bloc_base,idQuizz);

}



function ajouter_question(bloc_base,idQuizz) {
		$(".button",bloc_base).html($('<button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> Ajouter une question</button>').click(function(){
		$(".success",bloc_base).html("");
		//var bloc_ajout = $('<div class = "bloc_ajout"><div class="question"><span class="required">Question :</span><input type="text" class="quest" value=""/></div><div class = "aj_bonne_rep">Ajouter bonne réponse<div class="bonne_rep"></div></div><div class = "aj_mauvaise_rep">Ajouter mauvaise réponse<div class="mauvaise_rep"></div><div class="btn-group btn-group-justified" id="btnValidAnnuler"></div><div class="alert"></div></div>');
		var bloc_ajout = $('<div class = "bloc_ajout"><div class="input-group input-group-lg"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-lg">Question</span></div><input id="quest" value="" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"></div><div class = "aj_bonne_rep"><br><div class="bonne_rep"></div></div><div class = "aj_mauvaise_rep"><div class="mauvaise_rep"></div></div><div class="btn-group btn-group-justified" id="btnValidAnnuler"></div><div class="alert"></div>');
		$(this).parent().parent().parent().append(bloc_ajout);
		$(".aj_question",bloc_base).css("display","none");
		ajouter_bonne_reponse(bloc_ajout);
		ajouter_mauvaise_reponse(bloc_ajout);
		ajouter_validation(bloc_base,idQuizz);
		ajouter_annuler(bloc_base);


}));
}

function ajouter_question_image(bloc_base,idQuizz) {
		 
		$(".button2",bloc_base).html('<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">Ajouter question avec images</button>');
		//<button type="button" class=""><span class="glyphicon glyphicon-plus"></span> Ajouter une question</button>    
	/*	$(".button2",bloc_base).html($('<button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-plus"></span> Ajouter une question avec réponses imagées</button>').click(function(){
		$(".success",bloc_base).html("");
		var bloc_ajout = $('<div class = "bloc_ajout"><div class="input-group input-group-lg"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-lg">Question</span></div><input id="quest" value="" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"></div><div class = "aj_bonne_rep"><br><div class="bonne_rep"></div></div><div class = "aj_mauvaise_rep"><div class="mauvaise_rep"></div></div><div class="btn-group btn-group-justified" id="btnValidAnnuler"></div><div class="alert"></div>');
		$(this).parent().parent().parent().append(bloc_ajout);
		$(".aj_question",bloc_base).css("display","none");
		ajouter_bonne_reponse_image(bloc_ajout);
		ajouter_mauvaise_reponse_image(bloc_ajout);
		ajouter_validation_image(bloc_base,idQuizz);
		ajouter_annuler(bloc_base);


}));*/

}

function ajouter_bonne_reponse(bloc_ajout) {
	
	//$(".bonne_rep",bloc_ajout).append('<br><div class="bonne_rep"><span class="required">Bonne réponse :</span><input type="text" class="bon_rep" value=""/></div>');
	$(".bonne_rep",bloc_ajout).append('<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-default">Bonne réponse</span></div><input id="bon_rep" value="" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>');
}

function ajouter_bonne_reponse_image(bloc_ajout) {
	
	//$(".bonne_rep",bloc_ajout).append('<br><div class="bonne_rep"><span class="required">Bonne réponse :</span><input type="text" class="bon_rep" value=""/></div>');
	$(".bonne_rep",bloc_ajout).append('<label>Choisir la bonne image : </label><input id="bon_rep" type="file" name="bon_rep" accept="image/*">');
}

function ajouter_mauvaise_reponse(bloc_ajout) {
	nb_mauvaise_rep ++;
	$(".mauvaise_rep",bloc_ajout).append('<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-default">Mauvaise réponse</span></div><input id="mauvaise_rep'+ nb_mauvaise_rep +'" value="" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>');
//	$(".mauvaise_rep",bloc_ajout).append('<br><div id="mauvaise_rep'+ nb_mauvaise_rep +'"><span class="required">Mauvaise réponse :</span><input type="text" class="mauv_rep'+ nb_mauvaise_rep +'" value=""/></div>');
	$(".aj_mauvaise_rep",bloc_ajout).append($('<img class="btn2" src="ressources/plus.png" />').click(function(){
		nb_mauvaise_rep ++;
		$(".mauvaise_rep",bloc_ajout).append('<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="inputGroup-sizing-default">Mauvaise réponse</span></div><input id="mauvaise_rep'+ nb_mauvaise_rep +'" value="" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></div>');
		//$("mauvaise_rep",bloc_ajout).append('<br><div class="mauvaise_rep'+ nb_mauvaise_rep +'"><span class="required">Mauvaise réponse :</span><input type="text" class="mauv_rep'+ nb_mauvaise_rep +'" value=""/></div>');
	}));

}

function ajouter_mauvaise_reponse_image(bloc_ajout) {
	nb_mauvaise_rep ++;
	$(".mauvaise_rep",bloc_ajout).append('<label>Choisir la mauvaise image : </label><input id="mauvaise_rep'+ nb_mauvaise_rep +'" type="file" name="mauvaise_rep'+ nb_mauvaise_rep +'" accept="image/*">');
//	$(".mauvaise_rep",bloc_ajout).append('<br><div id="mauvaise_rep'+ nb_mauvaise_rep +'"><span class="required">Mauvaise réponse :</span><input type="text" class="mauv_rep'+ nb_mauvaise_rep +'" value=""/></div>');
	$(".aj_mauvaise_rep",bloc_ajout).append($('<img class="btn2" src="ressources/plus.png" />').click(function(){
		nb_mauvaise_rep ++;
		$(".mauvaise_rep",bloc_ajout).append('<br><label>Choisir la mauvaise image : </label><input id="mauvaise_rep'+ nb_mauvaise_rep +'" type="file" name="mauvaise_rep'+ nb_mauvaise_rep +'" accept="image/*">');
		//$("mauvaise_rep",bloc_ajout).append('<br><div class="mauvaise_rep'+ nb_mauvaise_rep +'"><span class="required">Mauvaise réponse :</span><input type="text" class="mauv_rep'+ nb_mauvaise_rep +'" value=""/></div>');
	}));

}

function ajouter_validation(bloc_base,idQuizz){
	$("#btnValidAnnuler",bloc_base).append($('<button type="button" class="btn btn-primary">Valider</button>').click(function(){
	var question = $("#quest",bloc_base).val();
	bonne_rep = $("#bon_rep",bloc_base).val();
	if (question == "" )
	{
		$(".alert",bloc_base).html('<div class="alert alert-danger">Veuillez saisir une question svp.</div>');
	}
	else if (bonne_rep == "")
	{
		$(".alert",bloc_base).html('<div class="alert alert-danger">Veuillez saisir une bonne réponse svp.</div>');
	}
	
	else{
		
	$.getJSON(
		"data.php",
		{"action":"ajouter_question",
		 "question": question,
		 "idQuizz" : idQuizz
		},
		
		function(oRep)
		{
			var nb = 0;
			var nb2 = 0;
		
			$.getJSON(
				"data.php",
				{"action":"ajouter_bonne_reponse",
				 "reponse": bonne_rep,
				 "question" : question
				},
				function(oRep1)
				{
					
				});
			if (nb_mauvaise_rep>0)
			{
				console.log("yoo");
				for (var j=0; j<nb_mauvaise_rep; j++)
				{
				nb2++;
				var mauvaise_rep = $("#mauvaise_rep"+nb2,bloc_base).val();
				console.log(mauvaise_rep);
				$.getJSON(
					"data.php",
					{"action":"ajouter_mauvaise_reponse",
					 "reponse": mauvaise_rep,
					 "question" : question
					},
					function(oRep2)
					{
						nb_mauvaise_rep = 0;
					});
				}
				
			}
			
			$(".success",bloc_base).html('<div class="alert alert-success">Votre question a bien été ajoutée.</div>');
			$(".aj_question",bloc_base).css("display","block");
			$(".bloc_ajout",bloc_base).remove();
			ajouter_question(bloc_base,idQuizz);
			lister_question(bloc_base,idQuizz);
		});
	}
			
}));
}

function ajouter_validation_image(bloc_base,idQuizz){
	$("#btnValidAnnuler",bloc_base).append($('<button type="button" class="btn btn-primary">Valider</button>').click(function(){
	var question = $("#quest",bloc_base).val();
	bonne_rep = $("#bon_rep",bloc_base).val();
	if (question == "" )
	{
		$(".alert",bloc_base).html('<div class="alert alert-danger">Veuillez saisir une question svp.</div>');
	}
	
	else{
		
	$.getJSON(
		"data.php",
		{"action":"ajouter_question",
		 "question": question,
		 "idQuizz" : idQuizz
		},
		
		function(oRep)
		{
			var nb = 0;
			var nb2 = 0;
		
			$.getJSON(
				"data.php",
				{"action":"ajouter_bonne_reponse_image",
				 "reponse": bonne_rep,
				 "question" : question
				},
				function(oRep1)
				{
					
				});
			if (nb_mauvaise_rep>0)
			{
				console.log("yoo");
				for (var j=0; j<nb_mauvaise_rep; j++)
				{
				nb2++;
				var mauvaise_rep = $("#mauvaise_rep"+nb2,bloc_base).val();
				console.log(mauvaise_rep);
				$.getJSON(
					"data.php",
					{"action":"ajouter_mauvaise_reponse",
					 "reponse": mauvaise_rep,
					 "question" : question
					},
					function(oRep2)
					{
						nb_mauvaise_rep = 0;
					});
				}
				
			}
			
			$(".success",bloc_base).html('<div class="alert alert-success">Votre question a bien été ajoutée.</div>');
			$(".aj_question",bloc_base).css("display","block");
			$(".bloc_ajout",bloc_base).remove();
			ajouter_question(bloc_base,idQuizz);
			lister_question(bloc_base,idQuizz);
		});
	}
			
}));
}

function ajouter_annuler(bloc_base){

	$("#btnValidAnnuler",bloc_base).append($('<button type="button" class="btn btn-primary">Annuler</button>').click(function(){
	$(".aj_question",bloc_base).css("display","block");
	$(".bloc_ajout",bloc_base).remove();
	ajouter_question(bloc_base);
	nb_mauvaise_rep = 0;
}));
}




</script>
<body>
<div class="page-header" id="page-quizz"  style="margin-left:2%;margin-right:2%;">
	<h1 style="text-align:center">Modifier</h1>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ajouter question avec réponses imagées</h4>
        </div>
        <div class="modal-body">
        	<form id="formArticle" action="controleur.php" style="margin-top:10px" method="post" enctype="multipart/form-data" >
        		<p style="color : red;">Veuillez remplir les champs avec cette icone <img src="ressources/attention.png" style="height:20px;" />, sinon la question ne sera pas ajoutée. <br>De plus les images ne doivent pas avoir une taille supérieur à 500ko.</p>
         <div class="input-group input-group-lg">
        		<div class="input-group-prepend">
          		<span class="input-group-text" id="inputGroup-sizing-lg">Question</span>
          	</div>
          	<input type="hidden" name="idQuizz" id="idQuizz" value=""/>
          	<input id="quest" value="" name="question" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"><img src="ressources/attention.png" style="height:20px;" />
         </div>
          <input required type="hidden" name="action" value="creerQuestImage" >
         <br><label>Choisir la bonne image : </label><input id="bon_rep" type="file" name="bon_rep" accept="image/*"><img src="ressources/attention.png" style="height:20px;margin-left: -30px;" />
 	<br><label>Choisir les mauvaises images : </label><input  type="file" name="mauv_rep1" accept="image/*"><img src="ressources/attention.png" style="height:20px;margin-left: -30px;" />
 	<br><input  type="file" name="mauv_rep2" accept="image/*">
 	<br><input  type="file" name="mauv_rep3" accept="image/*">
 	<br>
         <div class="btn-group btn-group-justified" id="btnValidAnnuler">
          <button id="submit" type="submit" name="submit" class="btn btn-primary">Valider</button>
         </div>
         </form>

         
        <div class="modal-footer">
          <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
</body>


<div class="modal fade" id="myModal2" role="dialog">
<div class="variable">
	
</div>
	
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Supprimer question avec réponses imagées</h4>
        </div>
        <div class="modal-body">
        	<form id="formArticle" action="controleur.php" style="margin-top:10px" method="post" enctype="multipart/form-data" >
         <div class="input-group input-group-lg">
        		<div class="input-group-prepend" id="pop_up_quest">
          	</div>
         </div>
         <div class="pop_up_rep">
         	
         </div>
        	 
        	 <div class="pop_up_form">
         	
         </div>
 
 
 	<input required type="hidden" name="action" value="supp_quest_img" >
         <div class="btn-group btn-group-justified" id="btnValidAnnuler">
          <button id="submit" type="submit" name="submit" class="btn btn-primary">Supprimer</button>
         </div>
         </form>

         
        <div class="modal-footer">
          <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
