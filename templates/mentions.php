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
<div class="CGVclass">
 <p>
  <strong></strong>
</p>
<p>
  <strong></strong>
</p>
<p>
    La société FORMALEAZ est une société à responsabilité limitée (SARL) au
    capital social de 2000,00€
</p>
<p>
    <u>Adresse :</u>
</p>
<p>
    Bp 50017 Ruche d’Entreprises du Hainaut
</p>
<p>
    350 rue Arthur Brunet
</p>
<p>
    Denain 59721
</p>
<p>
    <u>Mél :</u>
</p>
<p>
    contact@formaleaz.fr
</p>
<p>
    <u>Tél :</u>
</p>
<p>
    09 52 67 92 25
</p>
<p>
    06 87 09 48 21
</p>
<p>
    Cette société est inscrite au registre du commerce et des sociétés (RCS) ,
    Immatriculation : 790 104 442 R.C.S. Valenciennes
</p>
<p>
    Le site www.formaleaz.fr est hébergé par OVH – 2 rue Kellermann – 59100
    ROUBAIX – France
    <br/>
    Pour contacter cet hébergeur, rendez-vous à l’adresse
    http://www.ovh.com/fr/support/
</p>
<p>
    Il a été conçu par Formaleaz et réalisé par le groupe "Pinf o Plomo" de
    l’école Centrale Lille IG2I.
</p>

</div>