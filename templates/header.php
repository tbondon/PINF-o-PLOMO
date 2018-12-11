<!DOCTYPE html>
<html>
		<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
<head>
<title>Formaleaz - Centre de formation</title>
<link rel="shortcut icon" href="ressources/favicon.png" >	
<?php include_once("libs/modele.php");  ?>
<?php include_once("libs/fonctions.php");  ?>
	<meta    charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link media="screen" type="text/css" rel="stylesheet" href="css/html.css"></link>
	<link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
	
	
	<script >
	var textDire;
		var IconDire;
		var Id;

		function TextDir(dir, textDire) {
			dir.style.width = "120px";
			Id = setTimeout(function() {

				if (dir.style.width == "120px") {
					dir.innerHTML = textDire;
				}
			}, 300);

		}

		function IconDir(dir, IconDire) {
			clearTimeout(Id);
			dir.innerHTML = IconDire;
			dir.style.width = "40px";;

		}
		
		
	
	
	$(document).ready(function() {
	  //change the integers below to match the height of your upper dive, which I called
	  //banner.  Just add a 1 to the last number.  console.log($(window).scrollTop())
	  //to figure out what the scroll position is when exactly you want to fix the nav
	  //bar or div or whatever.  I stuck in the console.log for you.  Just remove when
	  //you know the position.
	  $(window).scroll(function () { 
	
	    
	
	    if ($(window).scrollTop() > 100) {
	      $('#nav_bar').addClass('fixed-top');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#nav_bar').removeClass('fixed-top');
	     
	    }
	  });
	});
	
	
	</script>

	<style type="text/css">
		
	
		
		
		.image-logo{
			display: block;
    			margin-left: auto;
    			margin-right: auto;
    			margin-bottom:5px;
    			margin-top:5px;
		}
		
		.menu{
			
			/*background-color: #3e90f0;*/
			background-color: rgba(0, 68, 148, 0.98);
			
		}
		
		.barnav{
			opacity: 1;
			border: 1.5px solid #494946;
			border-radius: 18px;
			color: white;
			height: 40px;
			width: 40px;
			padding: 4px 3px 0 3px;
			text-align: center;
			cursor:pointer;
			transition: 0.5s;
		}
		
		#nav1,#nav4{
			background-color: #4768ad;
			}

		#nav2,#nav5{
			background-color: #2e76b0;
		}
		
		#nav3,#nav6{
			background-color: #40D063;
		}
			
		#ConteneurBarNav{
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			z-index: 10;
			display: flex;
			flex-direction: column;
			justify-content: center;
			padding-left: 1%;
		}
	</style>
</head>


<body>
<a href="http://formaleaz.fr/index.php?view=accueil">
	<img src="ressources/logo.png" class="image-logo"></img>
</a>
	<nav class="navbar navbar-expand-lg navbar-dark  menu" id='nav_bar'>
		
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon "></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo02" >
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0 " >
				
					<?php
					
						//console_log(isAdmin($_SESSION["id_joueur"]));
						if(isset($_SESSION["id_joueur"]))
							if(isAdmin($_SESSION["id_joueur"]))
							{
								echo mkHeadLink("Accueil","accueil",$view);
								echo mkHeadLink("Formations","formationadmin",$view);
								echo mkHeadLink("Actualité","actualite",$view);
								
								echo mkHeadLink("Quizz","quizzAdmin",$view);
								echo mkHeadLink("FAQ","faq",$view);
								echo mkHeadLink("Que sont-ils devenus ?","teststatadmin",$view); //PAGE AVEC LE PDF SUR LES STATISTIQUES
								echo mkHeadLink("CV-thèque","CVthequeAdmin",$view); //PAGE AVEC LES CV DES DIPLOMES EN PDF
								echo mkHeadLink("Contact","contact",$view);
								echo mkHeadLink("Partie Administrateur","partieadmin",$view);
							}
							else 
							{
								echo mkHeadLink("Accueil","accueil",$view);
								echo mkHeadLink("Formations","formation",$view);
								echo mkHeadLink("Actualité","actualite",$view);
								echo mkHeadLink("Quizz","quizz",$view);
								echo mkHeadLink("FAQ","faq",$view);
								echo mkHeadLink("Que sont-ils devenus ?","teststat",$view); //PAGE AVEC LE PDF SUR LES STATISTIQUES
								echo mkHeadLink("CV-thèque","CVtheque",$view); //PAGE AVEC LES CV DES DIPLOMES EN PDF
								echo mkHeadLink("Contact","contact",$view);
							}
						else
						{
							echo mkHeadLink("Accueil","accueil",$view);
							echo mkHeadLink("Formations","formation",$view);
							echo mkHeadLink("Actualité","actualite",$view);
							echo mkHeadLink("Quizz","quizz",$view);
							echo mkHeadLink("FAQ","faq",$view);
							echo mkHeadLink("Que sont-ils devenus ?","teststat",$view); //PAGE AVEC LE PDF SUR LES STATISTIQUES
							echo mkHeadLink("CV-thèque","CVtheque",$view); //PAGE AVEC LES CV DES DIPLOMES EN PDF
							echo mkHeadLink("Contact","contact",$view);
						}
						
						
					
					?>
        			
      			
			</ul>
			
			   <div class="share-buttons">
  <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fformaleaz.fr%2F&quote=Voici+un+page+qui+pourrait+vous+intéresser+" title="Partager sur facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&quote=Voici+un+page+qui+pourrait+vous+intéresser+' + encodeURIComponent(document.URL)); return false;"><img alt="Share on Facebook" src="images/flat_web_icon_set/color/Facebook.png" /></a>
  <a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fformaleaz.fr%2F&text=Voici+un+page+qui+pourrait+vous+intéresser+http%3A%2F%2Fformaleaz.fr%2F" target="_blank" title="Partager sur twitter" onclick="window.open('https://twitter.com/intent/tweet?text=Voici+un+page+qui+pourrait+vous+intéresser+' + encodeURIComponent(document.URL)); return false;"><img alt="Tweet" src="images/flat_web_icon_set/color/Twitter.png" /></a>
  <a href="https://plus.google.com/share?url=http%3A%2F%2Fformaleaz.fr%2F" target="_blank" title="Partager sur Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><img alt="Share on Google+" src="images/flat_web_icon_set/color/Google+.png" /></a></li>
  <a href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fformaleaz.fr%2F&title=&summary=&source=http%3A%2F%2Fformaleaz.fr%2F" target="_blank" title="Partager sur LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=Voici+un+page+qui+pourrait+vous+intéresser' ); return false;"><img alt="Share on LinkedIn" src="images/flat_web_icon_set/color/LinkedIn.png" /></a></div>
			<form class="form-inline my-2 my-lg-0" style="margin-left:1%;margin-right:2.50<<%">
			<?php 
			if (!valider("connecte","SESSION")) {
				echo mkHeadLinkBtnBlanc("Connexion","login",$view,"btn btn-outline-light");
			}
			else
			
				{
					?>
					
				<div class="btn-group ">
  						<button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						<?php echo getPseudo($_SESSION["id_joueur"])?>
  						</button>
  					<div class="dropdown-menu" aria-labelledby="dropdownMenu1">

    					<?php echo "<a class=\"dropdown-item\" style=\"font-size:16px; margin-right:10px;\" href=\"index.php?view=monprofil\" >Mon Profil</a>";?>
    					<div class="dropdown-divider"></div>
    					<?php echo "<a class=\"dropdown-item\" style=\"font-size:16px;\" href=\"controleur.php?action=Logout\" >Se Déconnecter</a>";?>
  					</div>
				</div>	
				<?php 
				}
			?>
			</form>
		</div>
	</nav>
	
	
	
<!-- <div id="ConteneurBarNav">
   <ul class="share-buttons">
  <li><a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fformaleaz.fr%2F&quote=" title="Partager sur facebook" target="_blank" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&quote=' + encodeURIComponent(document.URL)); return false;"><img alt="Share on Facebook" src="images/flat_web_icon_set/color/Facebook.png" /></a></li>
  <li><a href="https://twitter.com/intent/tweet?source=http%3A%2F%2Fformaleaz.fr%2F&text=:%20http%3A%2F%2Fformaleaz.fr%2F" target="_blank" title="Partager sur twitter" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"><img alt="Tweet" src="images/flat_web_icon_set/color/Twitter.png" /></a></li>
  <li><a href="https://plus.google.com/share?url=http%3A%2F%2Fformaleaz.fr%2F" target="_blank" title="Partager sur Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><img alt="Share on Google+" src="images/flat_web_icon_set/color/Google+.png" /></a></li>
  <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fformaleaz.fr%2F&title=&summary=&source=http%3A%2F%2Fformaleaz.fr%2F" target="_blank" title="Partager sur LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img alt="Share on LinkedIn" src="images/flat_web_icon_set/color/LinkedIn.png" /></a></li></ul>	
	</div> */ -->
	


	



