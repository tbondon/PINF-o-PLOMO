

<?php
include_once("libs/modele.php");
include_once("libs/fonctions.php");


if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}

?>   

<style type="text/css">
         
         h3{
                font-weight: bold;
         }
         .row{
                  margin-top:50px;
                  margin-left:1rem!important;
                  margin-right:1rem!important;
         }

         #map {
                height: 700px;
                margin-left:1rem!important;
                margin-right:1rem!important;
        }

         .contact-etendu{
                margin-top:76px;
        }
        
        .tab{
                margin-left:1rem!important;
                margin-right:1rem!important;
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
	      $('#page-contact').addClass('contact-etendu');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#page-contact').removeClass('contact-etendu');
	     
	    }
	  });
	});
</script>



<div class="page-header"  id="page-contact">

        <!--BANDEAU-->
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center  block-forma" id="page-contact" style="margin-bottom:1rem!important; ">
        
                  <h3 class="display-5 text-center">
                               Nos coordonnées
                               <br>
                               <br>
                  </h3>
                  <p class="lead" id="text-div-accueil">
                           06 87 09 48 21 
                           <br>
                           09 52 67 92 25
                           <br>
                           <br>
                           350 Rue Arthur Brunet
                           <br>
                           59220 DENAIN
                           <br>
                           <br>
                           contact@formaleaz.fr
                  </p>
				     <h3 class="display-5 text-center">
    Notre page facebook
     <br>
     <br>
   </h3>
<a href="https://www.facebook.com/Formaleaz-1177335752294596/" title="Partager sur facebook" target="_blank" ><img alt="Share on Facebook" src="images/flat_web_icon_set/color/Facebook.png" /></a>
         </br>
</div>
         
     
  
         
         <!--BANDEAU MAP-->
<div id="map" style="margin-bottom:1rem!important; ">
</div>

    
    
    
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHzEwzguiS0qmNkbiVK6aytkq6AJOm19Y&callback=initMap">
</script>
         
         
</div>

