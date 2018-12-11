	
	$(document).on("click",".question",function(){
		if($(this).siblings().css("display")=="none")//si la reponse associé est cachée
		{
			//on l'affiche
			$(this).siblings().css("display","block");
		}else
		{
			//on l'efface
			$(this).siblings().css("display","none");
			
		}
			
	});
