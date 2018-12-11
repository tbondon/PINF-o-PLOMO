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


?> 
<style type="text/css">
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
<style type="text/css">

	.page-header{
		margin-top : 100px;
	}

	.quizz-etendu{
                margin-top:162px;
        }
        #button{
                 float : right;
        }
</style>


<script>

$(document).ready(function(){
var connecte = '<?php echo $_SESSION["connecte"]; ?>';
console.log(connecte);

	if (connecte){
	         var admin='<?php echo isAdmin($_SESSION["id_joueur"]); ?>';
	         if (admin){
	                  console.log("yooooo");
	                  var bloc_base = $("<div class='resultat'></div>");
		         $(".page-header").append(bloc_base);
		         lister_resulat(bloc_base);
	         }
	         else{
	                  
	         }
		
	}
	else
	{
		
	}
	
		
});

function lister_resulat(bloc_base){
         $.getJSON(
		"data.php",
		{"action":"select_resultat"
		},
		function(oRep)
		{
			console.log(oRep);
			$(".select_quizz",bloc_base).html("");
			for (var i=0; i<oRep.resultat.length;i++)
			{
			         var id=oRep.resultat[i]["id_resultat"];
			         var nom = oRep.resultat[i]["nom_resultat"];
			         var prenom = oRep.resultat[i]["prenom_resultat"];
			         var mail = oRep.resultat[i]["mail_resultat"];
			         var score = oRep.resultat[i]["score_resultat"];
			         afficher_resultat(bloc_base,id,nom,prenom,mail,score,i);
			}
		});
}

function afficher_resultat(bloc_base,id,nom,prenom,mail,score,i){
         	$(".resultat").append("<div class='form_mdp' id='"+i+"'></div");
		 $("#"+i,bloc_base).append($('<button id="button" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>').click(function(){
		         supprimer_resultat(bloc_base,id);
		}));
		$("#"+i,bloc_base).append("<label>Nom : <span>"+nom+"</span></label>");
		$("#"+i,bloc_base).append("<label>Prénom : <span>"+prenom+"</span></label>");
		$("#"+i,bloc_base).append("<label>Mail : <span>"+mail+"</span></label>");
		$("#"+i,bloc_base).append("<label>Score : <span>"+score+"/10</span></label>");
}
function supprimer_resultat(bloc_base,id,nom,prenom){
	console.log(nom);
	console.log(prenom);
	
	if(confirm("Etes vous sûr de vouloir supprimer le resultat de "+prenom+" "+nom+" ?")){
		$.getJSON(
			"data.php",
			{"action":"supprimer_resultat",
			 "id" : id},
			function(oRep2)
			{
			        	$(".resultat").html("");
				lister_resulat(bloc_base);
			});
		}
}
</script>
<div class="page-header" id="page-quizz"  style="margin-left:2%;margin-right:2%;">
<h1 style="text-align:center">Resultats QUIZZ</h1>
</div>

