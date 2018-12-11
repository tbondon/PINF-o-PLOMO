<!--	<link rel="stylesheet" type="text/css" href="./css/styleActualite.css">-->
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


<style type="text/css">

	.actu-etendu{
                margin-top:156px;
        }
	
	.article
	{
		float: left;
		margin: 2%;
		margin-top:5%;
		overflow:hidden;
		height:450px;
	}
	.article:hover
	{
		background-color:#EEEFF0;
		border:2px solid #EEEFF0;
		transition:0.2s;
	}
	.img
	{
		width:100%;
		max-width:290px;
		height: auto;
		height:250px;
	}
	.buttonCreer
	{
		
		cursor: pointer;
		margin-left: 20%;
	}
	
	.aArticle
	{
		text-decoration: none;
		color: black;
	}
	
	.aArticle:hover
	{
		text-decoration: none;
		color: rgba(179, 39, 104, 0.95);
	}
	.date
	{
		display: block;
	   	margin-bottom: auto;
		color:#3e90f0;
	}
	.survole
	{
	
		transition: 0.5s;
	}
	.croix
	{
		width: 25px;
		height: 25px;
		position: absolute;
		cursor:pointer;
		background-color: lightgrey;
	
	}
	.containerArticles
	{
		display:flex;
		flex-wrap:wrap;
		justify-content: space-around;
		align-items:center;
		margin-left: 15%;
		margin-right:15%;
		margin-top:5%;
	}
	.navPages
	{
		
		float:right;
		clear:left;
		margin-right: 2%;
		font-size: 1.5em;
		color: #BABABA;
		
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
	
	    
	
	    if ($(window).scrollTop() > 100) {
	      $('#page-actu').addClass('actu-etendu');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#page-actu').removeClass('actu-etendu');
	      
	    }
	  });
	 
	});
</script>

<div class="page-header" id="page-actu">	
<?php
		if (isset($_SESSION["connecte"]) && ($_SESSION["connecte"]))//si connecté
		{
			//on recupère la variable admin
			$reponse= verifAdminUser($_SESSION["pseudo"]);
			$admin= parcoursRs($reponse);
			if($admin[0]["admin"]==1)
			{
			//si admin on affiche la page admin
			echo "<script src='./js/jsAdminActualite.js' type='text/javascript'></script>";//si admin ca charge une page js qui contient les interactions pour supprimer les articles
	
			echo "<a href='./index.php?view=creerArticleAdmin'><div style='margin-top:100px'><button class='buttonCreer btn btn-secondary'>creer un article</button></div></a>";
			}
			
		}
?>

<div class="containerArticles">
	<?php
		//recup du nombre d'articles
		$nbArticlesParPages=12;
		$total=countArticles();
		$data=parcoursRs($total);
		$tot=$data[0]["total"];
		//Nous allons maintenant compter le nombre de pages. ceil() renvoie l'entier supérieur
		$nombreDePages=ceil($tot/$nbArticlesParPages);
		
		
		if(isset($_GET['page']) && ($_GET["page"]>=1 && $_GET["page"]<INF)) // Si la variable $_GET['page'] existe et est un entier entre 1 et INFINITY
		{
		     $pageActuelle=intval($_GET['page']);
		 
		     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages on est a la derniere page
		     {
		          $pageActuelle=$nombreDePages;
		     }
		}
		else // Sinon
		{
		     $pageActuelle=1; // La page actuelle est la n°1    
		}
		$premiereEntree=($pageActuelle-1)*$nbArticlesParPages; // On calcul la première entrée à lire
		
		
		//recup des articles
		$reponse=getArticles($premiereEntree,$nbArticlesParPages);
		$data=parcoursRs($reponse);
		foreach($data as $donnees)
		{
			if(isset($donnees))
			{
	  ?>
		<a class="aArticle" href='./index.php?view=articles&id=<?php echo $donnees["id_article"];?>'>
			<div class="card article" style="width: 18rem;" id=<?php echo $donnees["id_article"];?>>
				<!--<div class="img" style="background-image:url('<?php echo $donnees["lien_photo"];?>')"></div>-->
	  		<img class="card-img-top img" src="<?php echo $donnees["lien_photo"];?>" alt="Card image cap">
	  			
		  			<div style="bottom:0 ;position:absolute" class="card-body">
		  				<p class="card-text date"><em>le <?php echo $donnees["date_article"]; ?></em></p>
		    				<h6 class="card-title"><?php echo $donnees["titre_article"]; ?></h6>
		    				<!--<p><?php echo $donnees["paragraphe"]; ?></p>-->
		    				
		  			</div>
		  	
			</div>
		</a>
	
		
		
<?php 
		}//fin if
	}//fin for
?>
</div>	<!-- fin div container -->
<nav class="navPages" aria-label="Page navigation example">
	<ul class="pagination">
		<li><a style="text-decoration: none;" href="/index.php?view=actualite&page=<?php if(!isset($_GET["page"])) echo 1; else if($_GET["page"]<=0) echo 1 ; else echo $pageActuelle-1;?>"><&nbsp;</a></li>	
<?php	
//on cree les liens des pages
	echo "<li>$pageActuelle</li>";
	echo "<p>&nbsp;/&nbsp;</p>";
	echo "<li>$nombreDePages</li>";
?>
		<li><a style="text-decoration: none;" href="/index.php?view=actualite&page=<?php if(!isset($_GET["page"])) echo 2; else if($_GET["page"]>=$nombreDePages) echo $nombreDePages ; else echo $pageActuelle+1;?>">&nbsp;></a></li>
	</ul>
</nav>


</div>   <!--fin page-header-->