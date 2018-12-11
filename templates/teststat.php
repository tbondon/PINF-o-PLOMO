<link rel="stylesheet" href="css/circle.css">
<?php
include_once("libs/modele.php");
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

        .stat-etendu{
                margin-top:112px;
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

<script >
        $(document).ready(function() {
                
        
   
   
   
	  //change the integers below to match the height of your upper dive
	  $(window).scroll(function () { 
	
	    if ($(window).scrollTop() > 100) {
		$('#page-stat').addClass('stat-etendu');
	    }
	
	    if ($(window).scrollTop() < 101) {
		$('#page-stat').removeClass('stat-etendu');
	    }
	  });
	});
	
</script>


<?php
echo "<div class=\"page-header\"  id=\"page-stat\">";
$SQL="SELECT * FROM stat";
$variable=parcoursRs(SQLSelect($SQL));
foreach ($variable as $dataValue) {
  $titre=$dataValue['titre_stat'];
  $pourcentage=$dataValue['valeur_stat'];
  $date=$dataValue['date_stat'];


  echo"<div class=\"ConteneurUnStat\" style=\"margin-top:50px; text-align:center\" >";
    echo"<h3 class=\"elementflex\">$titre</h3>";
    echo"<div class=\"elementflex\">";         
        echo "<div class=\"c100 p".$pourcentage." big green\" style=\"float:right\">
          <span>$pourcentage%</span>
          <div class=\"slice\">
            <div class=\"bar\"></div>
            <div class=\"fill\"></div>
          </div>";
        echo "</div>";    
       echo "<h9><small class=\"text-muted\" style=\"float:right; bottom:20%; r\"></br></br>mis à jour le: $date</small></h9>";   
   echo "</div>";
  echo "</div>";
}
?>    