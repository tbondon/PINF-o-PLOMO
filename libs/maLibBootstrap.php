<?php


/*
Ce fichier définit diverses fonctions permettant de faciliter la production de mises en formes complexes
Il est utilisé en conjonction avec le style de bootstrap et insère des classes bootstrap
*/

function mkHeadLink($label,$view,$currentView="",$class="nav-item")
{
	// fabrique un lien pour l'entête en insèrant la classe 'active' si view = currentView

	// EX: <?=mkHeadLink("Accueil","accueil",$view)
	// produit <li class="active"><a href="index.php?view=accueil">Accueil</a></li> si $view= accueil

	if ($view == $currentView) 
		$class .= " active";
	return "<li class=\"$class\" style='margin-left:20px'> <a class=\"nav-link\" href=\"index.php?view=$view\" style=\"
text-decoration: none;  \">$label</a></li>";
}

function mkHeadLinkBtnBlanc($label,$view,$currentView="",$class="nav-item")
{
	// fabrique un lien pour l'entête en insèrant la classe 'active' si view = currentView

	// EX: <?=mkHeadLink("Accueil","accueil",$view)
	// produit <li class="active"><a href="index.php?view=accueil">Accueil</a></li> si $view= accueil

	if ($view == $currentView) 
		$class .= " active";
	return "<a class=\"btn btn-outline-light\" href=\"index.php?view=$view\" >$label</a>";
}

function mkHeadLinkBtnNoir($label,$view,$currentView="",$class="nav-item")
{
	// fabrique un lien pour l'entête en insèrant la classe 'active' si view = currentView

	// EX: <?=mkHeadLink("Accueil","accueil",$view)
	// produit <li class="active"><a href="index.php?view=accueil">Accueil</a></li> si $view= accueil

	if ($view == $currentView) 
		$class .= " active";
	return "<a class=\"btn btn-outline-dark\" href=\"index.php?view=$view\" >$label</a>";
}



?>

