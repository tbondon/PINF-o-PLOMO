<?php

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


    <link rel="stylesheet" href="css/circle.css">
    
<style type="text/css">
        
        #deuxieme-bandeau{
                margin-top:1rem!important;
                margin-left:1rem!important;
                margin-right:1rem!important;
        }
        
        #text-div-accueil{
                font-size:16px;
        }
        
        #diff-formations-premierediv{
                font-size:16px;
        }
        
        .image-formatrices{
                height:25%;
                width:25%;
                border: 3px solid white;
                border-radius: 50px 20px;
        }
		.image-certif{
		  height:15%;
		  width:15%;
		}

        #troisieme-bandeau{
                margin-top:1rem!important;
                margin-left:1rem!important;
                margin-right:1rem!important;
        }

        #map {
                height: 400px;
                margin-left:1rem!important;
                margin-right:1rem!important;
        }
        

        #block3{
                
                padding-top:3rem!important;
               
        }

        #block2{
                
                padding-top:3rem!important;
        }
        
        #block1{
                
                padding-top:3rem!important;
        }

        #bandeau-adresse{
                margin-top:1rem!important;
                margin-left:1rem!important;
                margin-right:1rem!important;
        }

        #bandeau-formatrice{
        	
        	margin-top:1rem!important;
                margin-left:1rem!important;
                margin-right:1rem!important;
        }
		
        
        h4{
                font-weight: bold;
        }
        
        .block-forma{
                
                margin-left:1rem!important;
                margin-right:1rem!important;
        }

        .carousel-etendu{
                margin-top:77px;
        }
           
        .titre-carou{
                color : white;
                text-shadow: black 0.1em 0.1em 0.2em;
                font-size: 40px;
        }
    
        .contenu-carou{
                color : lightgrey;
                text-shadow: black 0.1em 0.1em 0.2em;
                font-size: 20px;
        }
</style>



<script >
        
        function initMap() {
                var formaleaz = {lat: 50.324004, lng: 3.381301};
                var map = new google.maps.Map(document.getElementById('map'), {
                          zoom: 10,
                          center: formaleaz
                });
                var marker = new google.maps.Marker({
                          position: formaleaz,
                          map: map
                });
        }

        $(document).ready(function() {
	  //change the integers below to match the height of your upper dive, which I called
	  //banner.  Just add a 1 to the last number.  console.log($(window).scrollTop())
	  //to figure out what the scroll position is when exactly you want to fix the nav
	  //bar or div or whatever.  I stuck in the console.log for you.  Just remove when
	  //you know the position.
	  $(window).scroll(function () { 
	
	    
	
	    if ($(window).scrollTop() > 100) {
	      $('#carouselExampleIndicators').addClass('carousel-etendu');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#carouselExampleIndicators').removeClass('carousel-etendu');
	     
	    }
	  });
	});
</script>



<div class="page-header"  style="margin-top:1rem!important; ">

    <div id="carouselExampleIndicators" id="carousel-accueil" class="carousel slide" data-ride="carousel" data-interval="3000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
        </ol>
        <div class="carousel-inner " id="carou" >
            <div class="carousel-item active">
                <img class="d-block w-100" src="ressources/accueil/carou2.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <!--<h5 class="titre-carou">Titre</h5>
                    <p class="contenu-carou">Description</p>-->
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="ressources/accueil/carou1.jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <!--<h5 class="titre-carou">Titre</h5>
                    <p class="contenu-carou">Description</p>-->
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="ressources/accueil/carou3.jpg" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <!--<h5 class="titre-carou">Titre</h5>
                    <p class="contenu-carou">Description</p>-->
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="ressources/accueil/carou4.jpg" alt="Fourth slide">
                <div class="carousel-caption d-none d-md-block">
                    <!--<h5 class="titre-carou">Titre</h5>
                    <p class="contenu-carou">Description</p>-->
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="ressources/accueil/carou5.jpg" alt="Fifth slide">
                <div class="carousel-caption d-none d-md-block">
                    <!--<h5 class="titre-carou">Titre</h5>
                    <p class="contenu-carou">Description</p>-->
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="ressources/accueil/carou6.jpg" alt="Sixth slide">
                <div class="carousel-caption d-none d-md-block">
                    <!--<h5 class="titre-carou">Titre</h5>
                    <p class="contenu-carou">Description</p>-->
                </div>
            </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
</div>



<!--PREMIER BANDEAU-->
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center  block-forma" style="margin-bottom:1rem!important; margin-top:1rem!important">
        
                <h4> 
                        Formaleaz 
                </h4>
                <br>
                <h6>
                        Vos SOLUTIONS FORMATIONS de A à Z ...
                </h6>
                <br>
                <p class="lead font-weight-normal" id="diff-formations-premierediv">
                        GESTION <br>
                        COMPTABILITÉ <br>
                        BUREAUTIQUE
                </p>
                <?php
                        echo mkHeadLinkBtnNoir("Nos formations","formation",$view,"btn btn-outline-light");
                ?>
       
</div>


<!--BANDEAU STAT-->

<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center  block-forma" style="margin-bottom:1rem!important; margin-top:1rem!important">
<?php $SQL="SELECT * FROM stat order by id_stat LIMIT 1";
         $variable=parcoursRs(SQLSelect($SQL));
         foreach ($variable as $dataValue) {
                  $titre=$dataValue['titre_stat'];
                  $pourcentage=$dataValue['valeur_stat'];
                  $date=$dataValue['date_stat'];     
        echo"<h4 class=\"text-align:center\">$titre</h4>"; ?> 
     
<?php
  echo"<div class=\"ConteneurUnStat\" style=\"margin-top:50px; margin-left:0px\" >"; 
    echo " <div class=\"c100 p".$pourcentage." big green\" style=\"float:right\">
                                                <span>$pourcentage%</span>
      <div class=\"slice\">
        <div class=\"bar\"></div>
        <div class=\"fill\"></div>
      </div>
    </div>";
          }
      echo "<h9><small class=\"text-muted\" style=\"\"></br></br>mis à jour le: $date</small></h9>";  
    echo " </div>";
         
         ?>
       
</div>

<!--SECOND BANDEAU-->
<div class="row" id="deuxieme-bandeau" >
        <div class=" col-sm bg-dark text-light text-center" id="block1">
               
                       <h4 class="display-5 text-center">
                               Responsable formation / DRH 
                               <br>
                               <br>
                       </h4>
                       <p class="lead" id="text-div-accueil">
                              Possibilité de se déplacer en entreprise
                              <br>
                              
                              12 années d'expérience en tant que formatrices 
                              <br>
                              
                              Formation intra ou inter entreprises
                              <br>
                              
                              Optimisation des budgets de formation
                       </p>
                       </br>
        </div>
        <div class="col-sm bg-dark text-light text-center" style="padding-top:3rem!important;" >
               
                       <h4 class="display-5 text-center">
                               TPE
                               <br>
                               <br>
                       </h4>
                       <p class="lead" id="text-div-accueil">
                              Possibilité d'adapter le contenu et la durée de vos stages à vos contraintes de temps
                         
                              <br>
                              Petits groupes de travail
                            
                              <br>
                              Thématiques de stage en adéquation avec vos préoccupations d'entrepreneur
                       </p>
                       </br>
        </div>
</div>


<!--BANDEAU-->
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center  block-forma" style="margin-bottom:1rem!important; margin-top:1rem!important">
        
                <h4 class="display-5 text-center">
                               Demandeurs d'emploi
                               <br>
                               <br>
                        </h4>
                        <p class="lead" id="text-div-accueil">
                                Contact direct avec les formatrices
                              <br>
                              Suivi de votre projet de formation
                              <br>
                              Accueil et convivialité
                              <br>
                              Centre de formation proche de chez vous 
                        </p>
                        </br>
</div>


<!--3E BANDEAU -->
<div class="row" id="troisieme-bandeau" >
        
        <div class="col-sm bg-dark text-light" id="block3">
               
                       <h4 class="display-5 text-center">
                               BUREAUTIQUE/WEB
                               <br>
                               <br>
                       </h4>
                       <p class="lead" id="text-div-accueil">
                                <ul id="text-div-accueil">
                                        <li>Apprenez ou consolidez vos bases en informatique</li>
                                        <li>Appropriez vous les logiciels de la suite office (Word, Excel,Power-Point,...)</li>
                                        <li>Optimisez la gestion de votre messagerie professionnelle</li>
                                        <li>Initiez-vous à la navigation sur internet</li>
                                </ul>
                       </p>
              
              
        </div>
        <div class=" col-sm bg-dark text-light" id="block1">
               
                       <h4 class="display-5 text-center">
                               COMPTABILITE
                               <br>
                               <br>
                       </h4>
                       <p class="lead" id="text-div-accueil">
                                <ul id="text-div-accueil">
                                        <li>Initiez-vous ou renforcez vos connaissances en comptabilité générale</li>
                                        <li>Approfondissez votre méthode de calcul de coût de revient et d'établissement de budget prévisionnel</li>
                                        <li>Préparez des tableaux de bords de gestion adaptés à vos besoin</li>
                                </ul>
                       </p>
               
        </div>
</div>

<div class="position-relative overflow-hidden  p-3 p-md-5 m-md-3 text-center text-dark " style="margin-bottom:1rem!important; ">
  <h4 class="display-5 text-center">
	FormaleAZ est référencé Data-Dock et agrée TOSA
   <br>
   <br>
 </h4>
 <img class="image-certif" src="ressources/tosa.jpg">
 <img class="image-certif" src="ressources/Picto_datadocke.jpg">



</div>



<!--BANDEAU CREATRICES-->
<div class="position-relative overflow-hidden  p-3 p-md-5 m-md-3 text-center text-dark " id="bandeau-formatrice" style="margin-bottom:1rem!important; ">
        <h4 class="text-center">Les Créatrices<br><br></h4>
                <img class="image-formatrices" src="ressources/accueil/ImageFormatrice.JPG">
                </img>
                <br>
                <h>
                        <br>
                        Sandrine GUDIN
                        <br>
                        <small class="text-muted">Formatrice comptabilité / gestion</small>
                        <br>
                        Marie MOUFFETARD
                        <br>
                        <small class="text-muted">Formatrice secretariat, bureautique / gestion commerciale</small>
                        <br>
                </h>
    
                
      
</div>

<div style="display:none;">valencienne centre formation TOSA secrétaire comptable secrétaire assistante réinsertion formation denain</div>

<!--BANDEAU ADRESSE -->
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-dark text-light  " id="bandeau-adresse" style="margin-bottom:1rem!important; ">
       <p>350 Rue Arthur Brunet</p>
       <small class="text-muted">59220 DENAIN</small>
</div>



<!--BANDEAU MAP-->
<div id="map" style="margin-bottom:1rem!important; ">
</div>

    
    
    
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHzEwzguiS0qmNkbiVK6aytkq6AJOm19Y&callback=initMap">
</script>