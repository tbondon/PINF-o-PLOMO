//supprimer les article avec requete ajax

$(document).ready(function(){

	$(document).on("mouseover",".article",function(){
		//$(".croix").remove();
		$(this).addClass("survole");
		var croix = $("<img>").addClass("croix").attr("src","./ressources/croixFAQ.png");
		$(this).prepend(croix);
	});

	$(document).on("mouseleave",".article",function(){
		$(".croix").remove();
		$(this).removeClass("survole");
	});

	$(document).on("click",".croix",function(e){
		if (confirm("êtes vous sur de vouloir supprimer l'article?")) 
		{
			 $(this).parent().remove();
			 //gérer la suppression sur le serveur
			$.ajax({
					url:"controleur.php",
					type:"POST",
					data:"action=suppArticle&"+"id_article="+$(this).parent().attr("id"),
					error : function(){
						alert("error");
					}
				});
			
		}
	return false;
	});
	

	

});