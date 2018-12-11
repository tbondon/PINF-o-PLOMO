<link rel="stylesheet" href="css/circle.css">
<?php
include_once "libs/modele.php"; 
include_once("libs/fonctions.php");
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

$desac=0;
if($desac !=1){
?> 

<style type="text/css">

	.page-header{
		margin-top : 100px;
		margin-bottom:1rem!important;
		margin-left:1rem!important;
		margin-right:1rem!important;
	}

	.quiz{
		margin-left:15%;
		margin-top:5%;
	}
	
	.bouton-valider-vert{
		margin-left:15%;
	}
	
	
	
	.quizz-etendu{
                margin-top:162px;
        }
        
        .tab{
                margin-left:1rem!important;
                margin-right:1rem!important;
        }
        
        .clearfix{
                text-align:center;
        }
        
        .clearfix:before,.clearfix:after {content: " "; display: table;}
        .clearfix:after {clear: both;}
        .clearfix {*zoom: 1;}
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

$(document).ready(function(){
	
	var connecte = '<?php echo $_SESSION["connecte"]; ?>';
	console.log(connecte);
	
		if (connecte){
			var bloc_base = $("<div class='quizz'></div>");
			$(".page-header").html(bloc_base);
			lister_quizz(bloc_base,connecte,null,null,null);
		}
		else
		{
			var bloc_base = $("<div class='inscription'></div>");
			$(".page-header").html(bloc_base);
			afficher_formulaire(bloc_base,connecte);
		}
		
			
});
var score = 0;
function afficher_formulaire(bloc_base,connecte){
	$(".inscription").append('<div class="container"><h2>Inscription</h2><div class="errorrr" style="color : red"></div><form><div class="form-group"><label for="pwd">Nom:</label><input type="text" class="form-control" id="pwd" placeholder="Nom" name="nom" required></div><div class="form-group"><label for="pwd">Prénom:</label><input type="text" class="form-control" id="pwd" placeholder="Prénom" name="prenom" required></div><div class="form-group"><label for="email">Email:</label><input type="email" class="form-control" id="email" placeholder="Email" name="email" required></div></div>');
	
	$(".inscription").append($('<button type="button" class="btn btn-danger" style="display: block; margin-left: auto; margin-right: auto">Commencer le quiz</button></form>').click(function(){
		var mail=$("input[name=email]").val();
		var nom=$("input[name=nom]").val();
		var prenom=$("input[name=prenom]").val();
		if(mail!='' && nom!='' && prenom !='')
		{
		var bloc_base = $("<div class='quizz'></div>");
		$(".page-header").html(bloc_base);
		lister_quizz(bloc_base,connecte,mail,nom,prenom)
		}
		else
		{
			$(".errorrr").html('Veuillez renseigner tout les champs svp');
		}
	}));
	}

function lister_quizz(bloc_base,connecte,mail,nom,prenom){

  
	$(".quizz").html('<div class="input-group"><select class="custom-select" id="inputGroupSelect04"><option selected>Choisissez votre quizz</option></select><div class="input-group-append"></div></div>');
	$.getJSON(
			"data.php",
			{"action":"select_quizz"
			},
			function(oRep)
			{
				console.log(oRep);
				$(".select_quizz",bloc_base).html("");
				for (var i=0; i<oRep.quizz.length;i++)
				{

					$(".custom-select",bloc_base).append("<option value='"+oRep.quizz[i]["id_quizz"]+"'>"+oRep.quizz[i]["nom_quizz"]+"</option>");
				}
					$(".input-group-append",bloc_base).html($('<button class="btn btn-outline-secondary" type="button">Valider</button>').click(function(){
						var idQuizz=$(".custom-select option:selected", bloc_base).val();
						afficher_quizz(bloc_base,connecte,mail,nom,prenom,idQuizz);
					}));
			});
}
function afficher_quizz(bloc_base,connecte,mail,nom,prenom,idQuizz){
	$.getJSON(
			"data.php",
			{"action":"afficher_question",
			"idQuizz":idQuizz
			},
			function(oRep)
			{
					//for(var i = 0; i<oRep.questions.length; i++)
					
				var i = 0;
				var max = oRep.questions.length;
				afficher_question(i,max,oRep,bloc_base,connecte,mail,nom,prenom,idQuizz);
					
			});
			
}

function afficher_question(i,max,oRep,bloc_base,connecte,mail,nom,prenom,idQuizz){


	var idQuest = oRep.questions[i]["id_question"];
	var question = oRep.questions[i]["question"];
	nb=i+1;
	$(".quizz").html("<br><div class='progress' style='margin-left:1rem!important; margin-right:1rem!important;'><div class='progress-bar progress-bar-striped bg-info' role='progressbar' style='width:"+nb*10+"%' aria-valuenow='"+nb*10+"' aria-valuemin='0' aria-valuemax='100'></div></div><br><div class='display-4'style='margin-left:1rem!important;margin-top:1rem!important;' id='quest"+idQuest+"'>"+nb+". "+question+"</div>");
	$(".quizz").append("<div class='quiz' id='quiz'></div>");
		$.getJSON(
			"data.php",
			{"action":"selectRep",
			"idQuest": idQuest},
			function(oRep1)
			{
				for(var j = 0; j<oRep1.reponses.length; j++)
				{
					//console.log(oRep);
					var idRep = oRep1.reponses[j]["id_reponse"];
					var reponse = oRep1.reponses[j]["reponse"];
					var vraiOuFaux = oRep1.reponses[j]["vrai_faux"];
					var image = oRep1.reponses[j]["image_reponse"];
				
				if(image == 0) $("#quiz",bloc_base).append("<div class='radio'><label><input type='radio' name='reponse' value='"+vraiOuFaux+"'>"+reponse+"</label></div>");
				else $("#quiz",bloc_base).append("<div class='radio'><label><input type='radio' name='reponse' value='"+vraiOuFaux+"'><img style='height : 100px; margin-left : 10px;' src='ressources/photosQuizz/"+reponse+"' alt='' /></label></div>");
				}
				
					
				$(".quizz").append($("<br><div class='btn btn-outline-success bouton-valider-vert' >Valider</div>").click(function(){
						var vraiOuFaux = $('input:radio[name=reponse]:checked').val();
						if(vraiOuFaux == 1) score++;
						console.log(score);
						i++;
						
						if (i<max)
						{
							afficher_question(i,max,oRep,bloc_base,connecte,mail,nom,prenom,idQuizz);
						}
						
						else{
							pourcentage = score*10;
					
						
						
							if (score>5){
								$(".quizz").html("<div class='c100 p"+pourcentage+" big green' style='text-align: center'><span>"+pourcentage+"%</span><div class='slice'><div class='bar'></div><div class='fill'></div></div>");
								$(".quizz").prepend("<div class='alert alert-success' role='alert'><strong>Resultat</strong> Votre score est de "+score+" sur 10.</div>");
							}
							else {
								$(".quizz").html("<div class='c100 p"+pourcentage+" big orange' style='text-align: center'><span>"+pourcentage+"%</span><div class='slice'><div class='bar'></div><div class='fill'></div></div>");
								$(".quizz").prepend("<div class='alert alert-warning' role='alert'><strong>Resultat</strong> Votre score est de "+score+" sur 10.</div>");
							}
							
							if (!(connecte))
							{
								$(".quizz").prepend("<div class='alert alert-info' role='alert'>Merci <strong>"+prenom+" "+nom+"</strong> de votre participation<br>");
								$.getJSON(
									"data.php",
									{"action":"enregiScore",
									"prenom" : prenom,
									"nom" : nom,
									"mail" : mail,
									//"idQuizz" : idQuizz,
									"score" : score
									},
									function(oRep)
									{
									
									});
						
							}
						
						}
				}));
				
			});

	
}
</script>


<div class="page-header" id="page-quizz">
<h1 style="text-align:center">QUIZZ</h1>
</div>

<?php }
?>