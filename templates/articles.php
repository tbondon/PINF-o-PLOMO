<style type="text/css">
	
		.article-etendu{
                		margin-top:160px;
        		}
		
		.imgArticle
		{
			max-width: 90%;
			max-height: 1000px;
			display: block;
   			margin-left: auto;
    		margin-right: auto;

		}
		.titre
		{
			text-align: center;
			color:rgba(242, 187, 64, 0.95);
			margin-bottom:5%;
		}
		.date{
			color:#3e90f0;
		}
		.contenu
		{
			margin-left:5%;
			margin-right:5%;
			/*margin-bottom:5%;*/
			color:#6D6D6D;
		}
			strong > em
		{
			font-size:1.5em;
		}
		em > strong
		{
			font-size:1.5em;
		}
		.containerImgContenu
		{
			background-color:#F7F8F9;
			padding-bottom:5%;
			padding-top:2%;
		}
	</style>


<?php
function getURL(){
    $adresse = $_SERVER['PHP_SELF'];
    $i = 0;
    foreach($_GET as $cle => $valeur){
        $adresse .= ($i == 0 ? '?' : '&').$cle.($valeur ? '='.$valeur : '');
        $i++;
    }
    return $adresse;
}
		//recup de l'article
	if($id_article=valider("id","GET")){
		$reponse=getArticle($id_article);
	}
		$data=parcoursRs($reponse);
	foreach($data as $donnees)
	{
			
?>

<script >
        $(document).ready(function() {
	  //change the integers below to match the height of your upper dive, which I called
	  //banner.  Just add a 1 to the last number.  console.log($(window).scrollTop())
	  //to figure out what the scroll position is when exactly you want to fix the nav
	  //bar or div or whatever.  I stuck in the console.log for you.  Just remove when
	  //you know the position.
	  $(window).scroll(function () { 
	
	    console.log($(window).scrollTop());
	
	    if ($(window).scrollTop() > 100) {
		$('#page-article').addClass('article-etendu');
	    }
	
	    if ($(window).scrollTop() < 101) {
	      $('#page-article').removeClass('article-etendu');
	     
	    }
	  });
	});
	</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
$(document).ready(function(){
	var url= document.URL; 

	var fb = '<div style="margin-left:5%;margin-bottom:3%" class="fb-share-button" data-href="'+url+'" data-layout="button" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Partager</a></div>';
	console.log(url);
	$(".contenu").before(fb);
});
	
</script>

<div class="page-header" id="page-article">
	
	<div style="margin-top:100px" class="paragraphe">
		<h1 class="titre"><?php echo $donnees["titre_article"]; ?></h1>
		<div class="containerImgContenu">
			<img class="imgArticle" src=<?php echo $donnees["lien_photo"];?>>
			<p class="titre date"><em>le <?php echo $donnees["date_article"]; ?></em></p>
			<br>
			<div class="contenu"><?php echo $donnees["paragraphe"]; ?></div>
		</div>
	</div>
<?php } //fin for ?>

