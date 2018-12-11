
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
		  

?>

<style type="text/css">
#formArticle
{
  margin-left:5%;
  margin-right:10%;
}

</style>
<form id="formArticle" action="controleur.php" style="margin-top:100px" method="post" enctype="multipart/form-data" >
	<label for="titre">titre article:</label>
	<input required type="text" name="titre" id="titre" maxlength="150"><p class="nbChar"></p><br>
	<label  for="file" class="btn btn-secondary">choissisez la photo de l'article</label>
  	<input required id="file" type="file" name="icone" style="display: none">
  	</br>
	<span>
	         Pour des soucis de beauté il est conseillé d'uploader des photos de largeur et de hauteur égales,
         	la dimension idéale mais pas obligatoire est : largeur:290px hauteur:250px utilisez si possible un logiciel comme photoshop ou paint pour recadrer l'image.
         	
	</span>
	<br><br>
  	<label for="editor1">contenu de l'article:</label>
  	<div style="margin-left:15%;margin-right:20%">
  	  <input type="hidden" name="action" value="creerArticle" ><!--<span>le gras fusionné avec l'italique ou l'italique fusionné avec le gras auront une police d'écriture un peu plus grosse, il est conseillé de les utiliser pour des titres</span>-->
  	  <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>  
  	</div>
  	
  	
<script type="text/javascript" src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
<!--<script src=".././ckeditor/ckeditor.js"></script>-->
<script type="text/javascript">
          tinymce.init({
                      selector: '#editor1',
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
          $(document).ready(function(){
            //CKEDITOR.replace( 'editor1' );
  	        
  	         //permet de valider avant le submit
  	        	$(document).on("click","#submit",function(){
  			if(confirm("êtes-vous sur d'uploader l'article?"))
  			{
  				//le formulaire est envoyé
  			}
  			else
  			{
  				return false;//on annule
  			}
  		});
  		
  	         //petit script pour compter le nombre de caracteres
           	$("input[name=titre]").on("keyup",function(){
           	  var nbChar=0;
           	  nbChar=$(this).val().length;
           	  console.log(nbChar);
           	  $(".nbChar").empty();
           	  $(".nbChar").prepend("nombre de caractères: "+nbChar+", au max 150");
           	  if(nbChar==0) $(".nbChar").empty(); 
           	});
  	
  	});
  </script>
  	<br><br>
	<button id="submit" type="submit" name="submit" class="btn btn-secondary" >Uploader l'article</button>
	<br><br>
</form>

<?php  
		}
	}
?>
 
  
  