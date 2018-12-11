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
if(isset($_SESSION["id_joueur"]))
	if(isAdmin($_SESSION["id_joueur"])){
	         
?>

<style type="text/css">

        .stat-etendu{
                margin-top:62px;
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
        
        textarea, select, option {
 		background-color:#E7F1FD;
 		border-radius: 5px;
 		
	}
	
	input{
		width:50%;
		background-color:#EDF4FE;
		border-radius: 5px;
		cursor:pointer;
	}
	
	input,label{
		margin-top:1%;
		margin-bottom:1%;
	}
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
if(valider("variable","GET"))
{
		?>
		
		<div class="alert alert-danger">
		<img src="ressources/attention.png" alt="Attention"  style="width:20px;height:20px;">
		<?php echo "Echec"; ?>
		</div>
<?php }   
if(valider("success","GET"))
{
		?>
		
		<div class="alert alert-success">
		<img src="ressources/check.png" alt="Attention"  style="width:20px;height:20px;">
		<?php echo "Succes"; ?>
		</div>
<?php }
?>

	<div class="page-header" id="page-stat">      

<?php
	echo "<center><div style=\"background-color:lightgrey;\">
				<img style=\"margin:5px;width:50px;height:50px;\" src='ressources/attention.png' alt=\'Image'  >
				En tant qu'Administrateur de ce site vous pouvez modifier cette page ci-dessous.
				";

	echo "</br>Pour voir l'affichage normal veuillez cliquer ici: ";
?>
	<form enctype="multipart/form-data" method="post" action="controleur.php">
					<input type="submit" value="Affichage Stat visiteur" name="action">
	</form></br></div></center>
 

<?php
       

        echo"<div class=\"container tab\" style=\"margin-top:50px\" >
                <div class=\"row\">";
         $SQL="SELECT * FROM stat";
         $variable=parcoursRs(SQLSelect($SQL));
         foreach ($variable as $dataValue) {
         	
         	
                  $titre=$dataValue['titre_stat'];
                  $pourcentage=$dataValue['valeur_stat'];
                  $date=$dataValue['date_stat'];
                  $id=$dataValue['id_stat'];
                  

                 echo "<div class=\"col\"><div style='border: solid 1px #3E90F0; border-radius:5px; padding:1%;'>
                 
                 <center>";           
             
                           echo "<form  enctype=\"multipart/form-data\" method=\"post\"  onSubmit=\"return confirm('Etes vous sur ?');\" action=\"controleur.php\"  >
			         <input type=\"hidden\" name=\"id_stat\" value=\"$id\">	
                                <h4 style=\"text-align:center;\">$titre <button type=\"submit\" value=\"Supprimer cette Stat\" name=\"action\">
                                                      <img src=\"ressources/Croix.png\" style='width:10px;height:10px;'/>
                                                      </button></h4>
                                <h9><small class=\"text-muted\" style=\"\">mis à jour le: $date</small></h9>
                                <h5>$pourcentage %</h5>
                                <br>
                                
                  </center>";
                                       
                                    echo "<center><h5 style=\"background-color:#3EF09E; \">Modifier Stat:</h5></center>";
                                    echo "<label>Titre : </label>
					<input type=\"text\" name=\"titre\" value=\"$titre\" required >
					</br><label>Pourcentage : </label>
					<input type=\"number\" name=\"pourcentage\" value=\"$pourcentage\" required></br>
					<input type=\"submit\" value=\"Modifier Stat\"style=\"margin:5px;\" name=\"action\">";
                      
                   echo "</div></div></form>";
         }

         echo " </div></div>";
         ?>
<div style="width:20%;text-align:left;display:block; margin:2%;border: solid 1px #3E90F0; border-radius:5px; padding:1%;">
<form enctype="multipart/form-data" method="post" action="controleur.php" onSubmit="return confirm('Etes vous sur ?');">
                                             <h5>Nouvelle Stat:</h5>
					</br><label>Titre : </label>
					<input type="text" name="titre" required >
					</br><label>Pourcentage : </label>
					<input type="number" name="pourcentage" required></br>
					<input type="submit" value="Ajouter Une Stat"style="margin:5px;" name="action">
	</form>
</div>
         
         
<?php         
	}
?>    
