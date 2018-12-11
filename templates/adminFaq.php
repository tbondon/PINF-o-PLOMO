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
if (isset($_SESSION["connecte"]) && ($_SESSION["connecte"]))//si connecté
	{
		//on recupère la variable admin
		$reponse= verifAdminUser($_SESSION["pseudo"]);
		$admin= parcoursRs($reponse);
		if($admin[0]["admin"]==1)
		{

/*
	page qui sert à charger le formulaire pour l'admin et qui gère aussi la requete ajax
*/


  ?>
  </br></br></br>
<!--  <script src=".././ckeditor/ckeditor.js"></script>
-->  <script type="text/javascript" src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
  <script type="text/javascript">
      
  	$(document).ready(function(){
         tinymce.init({
           selector: '#editor',
                      height:500,
                      width:700,
                      theme: 'modern',
                      plugins: [
                        'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                        'save table contextmenu directionality emoticons template paste textcolor'
                      ],
                     
                      toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
           content_css: [
             '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
             '//www.tinymce.com/css/codepen.min.css']
         });
      
  	//	CKEDITOR.replace( 'editor1' );
  	                  
  	                  //permet de valider avant le submit
	  		$(document).on("click","#submit",function(){
  			if(confirm("êtes-vous sur d'uploader?"))
  			{
  				//le formulaire est envoyé
  			}
  			else
  			{
  				return false;//on annule
  			}
  		});
  		
  		//petit script qui compte le nombre de caracteres
  		$("input[name=question_faq]").on("keyup",function(){
           	  var nbChar=0;
           	  nbChar=$(this).val().length;
           	  //console.log(nbChar);
           	  $(".nbChar").empty();
           	  $(".nbChar").prepend("nombre de caractères: "+nbChar+", au max 150");
           	  if(nbChar==0) $(".nbChar").empty(); 
           	});
  	
  	});
  </script>
  <form method="post" style="margin-top: 100px;margin-left:10px ; margin-left: 15%" action="controleur.php" >
  	<p>Ajouter une section:</p>
	<input required type="text" name="question_faq" style="width:300px" maxlength="150"><p class="nbChar"></p><br></br></br>
	<p>Ajouter son contenu:</p>
         <div class="editor">
                  <textarea type="text" name="reponse_faq" id="editor">
                         <h4><em><strong>Bla Bla Bla ?</strong></em></h4>
                           <p>bla bla bla bla</p>
                           <h4><em><strong>Bla Bla Bla Bla Bla ?</strong></em></h4>
                           <p>bla bla bla</p>
                  </textarea>
         </div>
	<input type="hidden" name="action" value="addFAQ">
	<br><br>
	<input class="btn btn-secondary" id="submit" type="submit" name="submit" value="Envoyer">
</form>
<br>



<?php
		}
	}
?>