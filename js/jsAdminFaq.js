$(document).ready(function(){
	
	$(".arrow").remove();//on enleve la fleche 
	$(".reponse").css("display","block");//on affiche la question
	
	//varible globale qui stocke la value de depart d'une div
	var firstContenuQuestion="";
	var firstContenuReponse="";
	//variable global qui gere l'effacement de la croix

	
	$(document).on("mouseover",".faq",function(){
		$(this).addClass("survoleFaq");
		//on ajoute une croix
		var croix = $("<img>").addClass("croix").attr("src","./ressources/croixFAQ.png");
		$(this).prepend(croix);
	});

	$(document).on("mouseleave",".faq",function(){
		$(this).removeClass("survoleFaq");
		//on supprime la croix pour supprimer
		$(".croix").remove();
	});

	$(document).on("click",".croix",function(){
			//on efface la faq

			if(confirm("êtes-vous sur de vouloir supprimer?"))
			{
				console.log($(this).parent().attr("id")); //.parent().attr("id")
				$(this).parent().remove();
				//cote serveur
				$.ajax({
					url:"controleur.php",
					type:"POST",
					data:"id_faq="+$(this).parent().attr("id")+"&action=suppFAQ",
						
					error:function(){
						alert("error");
					}
				});
			}
			
		});
/*
	$(document).on("mouseover",".question, .reponse",function(){
		//console.log(this);
		//on affiche une border
		
		$(this).addClass("survole");
		
	});
	$(document).on("mouseleave",".question, .reponse",function(){
	
		//on rechange le css et on fait disparaitre la petite poubelle
		$(this).removeClass("survole");
		$(".poubelle").remove();
	});

	$(".faq").on("click",".question, .reponse",function(){
		
		if($(this).attr("class")[0]=="q") firstContenuQuestion=$(this).html();
		if($(this).attr("class")[0]=="r") firstContenuReponse=$(this).html();
		//console.log(firstContenuReponse);
		//console.log($(this).parent().attr("id"));
		//au click on permet de modifier le texte

		//on recupère la value de l'element
		//console.log($(this).text());
		var contenu=$(this).html();
		//on fait apparaitre un textarea avec le contenu de l'elt
		//avec un id p ou r selon le type de l'elt
		var textarea=$("<textarea>").html(contenu).attr("class",$(this).attr("class")[0]).addClass("textarea").attr("id",$(this).parent().parent().attr("id"));
		$(this).replaceWith(textarea);
		
		
		
	});

	$(document).on("keydown","textarea",function(event){
		//si on appuie sur entrée
		//console.log(event.key);
		if(event.key=="Enter"){
			if(confirm("êtes-vous sur de voulair remplacer le texte?"))
			{
						
				//on recupere le texte du textarea
				var newContenu = $(this).val();
				//console.log(newContenu);

				//on change le textarea avec son nouveu texte
				if($(this).attr("class")[0]=="q")//si c'est une question
				{
									//on cree la nouvelle question et on la remplace avec le textarea
					var newQuestion = $("<div>").attr("class","question").text(newContenu);
					$(this).replaceWith(newQuestion);
					//console.log(newQuestion.text());
					
					//cote serveur
					$.ajax({
							url:"./controleur.php",
							type:"POST",
							data:"newQuestion="+newContenu
							+"&id_faq="+$(this).attr("id")
							+"&action=updateQuestionFaq",
							success : function()
							 { 
        							document.location.reload(true);//pour eviter d'avoir du html cote client dans la reponse
    						 },
							error : function(){
								alert("error");
							}
							
						});
				}
				if($(this).attr("class")[0]=="r")//si c'est une reponse
				{
					var newReponse = $("<div>").attr("class","reponse").text(newContenu).css("display","block");
					$(this).replaceWith(newReponse);
					
					//cote serveur
					$.ajax({
							url:"./controleur.php",
							type:"POST",
							data:"newReponse="+newContenu
							+"&id_faq="+$(this).attr("id")
							+"&action=updateReponseFaq",
							 success : function()
							 { 
        							document.location.reload(true);//pour eviter d'avoir du html cote client dans la reponse
    						 },
							error : function(){
								alert("error");
							}
							
						});
				}
			}
		}

		if(event.key=="Escape")//si on appuie sur echape on annule tout
		{
			//on enleve le textarea et on remaet le texte par defaut
			//console.log(firstContenu);
			if($(this).attr("class")[0]=="q"){
				//on remet le texte dans une question
				var newQuestion = $("<div>").attr("class","question").text(firstContenuQuestion);
				$(this).replaceWith(newQuestion);
			}
			if($(this).attr("class")[0]=="r"){
				//on remet le texte dans une reponse
				var newReponse = $("<div>").attr("class","reponse").css("display","block").html(firstContenuReponse);
				$(this).replaceWith(newReponse);
			}
			//document.location.reload(true);
		}
	});
*/


});

