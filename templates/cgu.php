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
    <strong><u>Objet du site</u></strong>
</p>
<p>
    Le site internet de Formaleaz, organisme de formation, offre un service
    global à ses utilisateurs. Il présente des informations et des services
    relatifs à la recherche et au financement de formations professionnelles.
    <br/>
</p>
<p>
    <strong>
        <u>Informations préalables à l'attention des utilisateurs </u>
    </strong>
</p>
<p>
    Par la consultation et l’utilisation du site www.formaleaz.fr,
    l’utilisateur accepte et reconnaît les présentes conditions générales
    d’utilisation applicables à ce site. L’utilisateur est informé que
    Formaleaz est susceptible de modifier et mettre à jour les présentes
    conditions générales d’utilisation. L’utilisateur s’engage donc à se tenir
    régulièrement informé des éventuelles modifications des présentes
    conditions générales d’utilisation du site www.formaleaz.fr.
    <br/>
</p>
<p>
    <strong><u>Conditions d'utilisation du site </u></strong>
</p>
<p>
    <strong>Par l'utilisateur</strong>
</p>
<p>
    L’utilisation des services fournis par le site www.formaleaz.fr requiert
    notamment le renseignement d’un identifiant, d’une adresse électronique et
    d’un mot de passe propres à chaque utilisateur. Il appartient à
    l’utilisateur de veiller à la confidentialité de ces renseignements et à
    leur utilisation non-frauduleuse.
    <br/>
    <br/>
    L’utilisation et/ou la modification des informations susvisées relèvent de
    la seule responsabilité de l’utilisateur. L’utilisateur s’engage à ne pas
    en faire une utilisation autre que personnelle.
    <br/>
    Il appartient également à l’utilisateur de conserver les informations
    susvisées et de fournir une adresse mél fonctionnelle pour lui permettre
    d’accéder aux services fournis par le site www.formaleaz.fr.
</p>
<p>
    <strong>Politique d'utilisation des cookies</strong>
</p>
<p>
    L'accès à certains contenus du site formaleaz.fr suppose que vous nous
    transmettiez des données personnelles vous concernant. Lorsque vous
    naviguez sur notre site internet, ces informations sont susceptibles d'être
    enregistrées, ou lues, dans votre terminal.
    <br/>
</p>
<p>
    <strong><u>Responsabilité quant au fonctionnement du site </u></strong>
</p>
<p>
    La continuité des services fournis par le site www.formaleaz.fr est en
    principe assurée sous réserve des éventuelles défaillances résultant des
    fournisseurs d’accès à Internet et/ou de celles pouvant perturber ou
    interrompre la connexion au réseau ou au site.
    <br/>
    <br/>
    Les éventuelles difficultés d’accès au site pouvant résulter de diverses
    défaillances du réseau Internet (résultant des fournisseurs d’accès, des
    difficultés de connexion ou autres) ne sauraient engager la responsabilité
    de Formaleaz.
    <br/>
    <br/>
    L’utilisateur est également informé que les informations et autres données
    fournies par Formaleaz sur le site www.formaleaz.fr présentent un caractère
    purement indicatif et ne revêtent aucune valeur contractuelle. Ces données
    et informations ne sauraient engager la responsabilité de Formaleaz et
    peuvent à tout moment être actualisées ou supprimées à son initiative.
    <br/>
</p>
<p>
    <strong><u>Responsabilité quant à l'utilisation du site</u></strong>
</p>
<p>
    <strong>Engagements généraux des utilisateurs </strong>
</p>
<p>
    L’utilisateur accepte les spécificités propres à l’utilisation d’Internet :
</p>
<p>
    Il reconnaît que Formaleaz n’effectue aucun contrôle sur les sites dont
    elle n’est pas l’auteur,
</p>
<p>
    il est responsable du contenu des données personnelles qu’il communique sur
    le site www.formaleaz.fr ou sur un autre site,
</p>
<p>
    il engage sa seule responsabilité sur les sites qu’il consulte, les données
    qu’il accepte de communiquer et les téléchargements qu’il effectue.
</p>
<p>
    Par l’utilisation du site www.formaleaz.fr, l’utilisateur s’engage à :
</p>
<p>
    Respecter les législations française, communautaire et européenne
    applicables,
</p>
<p>
    ne pas faire une utilisation du site www.formaleaz.fr contraire à l’ordre
    public et aux bonnes mœurs,
</p>
<p>
    maintenir la confidentialité de ses identifiant et mots de passe,
</p>
<p>
    s’abstenir de collecter, fournir et/ou enregistrer des informations
    personnelles d’un autre utilisateur du site www.formaleaz.fr,
</p>
<p>
    ne pas porter préjudice aux autres utilisateurs du site www.formaleaz.fr,
</p>
<p>
    fournir des informations exactes et véridiques et mettre à jour les
    informations qui le concernent, notamment à la suite de nouvelles
    expériences ou formations.
</p>
<p>
    <br/>
    L’attention de l’utilisateur est plus particulièrement attirée sur le fait
    qu’il engage sa responsabilité par l’utilisation qu’il fait du site
    www.formaleaz.fr. Il est ainsi juridiquement responsable des dommages de
    toute nature résultant de son utilisation du site et particulièrement de
    l’usage frauduleux des données disponibles sur celui-ci.
    <br/>
    <br/>
    La responsabilité de Formaleaz ne saurait être engagée du fait des données
    que l’utilisateur transmet sur le site www.formaleaz.fr (identifiants,
    adresse mél, mot de passe et autres données personnelles). L’utilisateur
    est notamment informé que la responsabilité de Formaleaz est exclue pour
    les dommages résultant de l’utilisation des données susvisées, de leur
    oubli, omission ou perte de la part de l’utilisateur ou de leur usage par
    un tiers non autorisé.
    <br/>
    <br/>
    Formaleaz se réserve la possibilité de supprimer ou modifier tout contenu
    ou tout élément d’information fournis par l’utilisateur, qui apparaîtrait
    en contradiction avec les présentes conditions générales d’utilisation et
    seraient notamment illégaux, inappropriés et/ou discriminatoires.
    <br/>
    L’attention de l’utilisateur est attirée sur la circonstance que tout
    agissement en violation de la législation applicable est susceptible de
    donner lieu à un signalement auprès des autorités compétentes.
    <br/>
</p>
<p>
    <strong><u>Engagements de Formaleaz</u></strong>
</p>
<p>
    Formaleaz s’engage à respecter les dispositions légales en vigueur
    relativement à l’informatique, aux fichiers et aux libertés (loi n° 78-17
    du 6 janvier 1978, modifiée).
    <br/>
    Formaleaz prendra toutes précautions utiles afin de garantir la
    confidentialité et la sécurité des informations personnelles que lui
    transmettent les utilisateurs du site www.formaleaz.fr
</p>
<p>
    <strong>Propriété intellectuelle</strong>
</p>
<p>
    Le site, son contenu et toutes les données et éléments le constituant sont
    des créations protégées par les dispositions du Code de la propriété
    intellectuelle, notamment celles relatives à la propriété littéraire et
    artistique, aux droits d’auteur, aux droits des marques et à la protection
    des bases de données. Formaleaz est titulaire de l’intégralité des droits
    de propriété intellectuelle et/ou a obtenu les licences et droits
    d’exploitation au titre des droits d’auteur, du droit des dessins et
    modèles, du droit des marques ou du droit des bases des données.
    <br/>
    <br/>
    Le site comme les logiciels, bases de données, images, textes,
    illustrations, informations, analyses, tableaux, graphismes, photographies,
    sons, animations, vidéos, logos, marques, signes distinctifs ou toutes
    autres données ou éléments le composant sont la propriété exclusive de
    Formaleaz ou, le cas échéant, des auteurs avec lesquels Formaleaz a conclu
    un accord d’utilisation.
    <br/>
    <br/>
    Ils ne peuvent, en conséquence, être reproduits, représentés ou diffusés
    sous quelque forme ou quelque support que ce soit sans l’autorisation
    préalable, expresse et écrite de Formaleaz. Pour obtenir cette
    autorisation, il convient de contacter FORMALEAZ , 350 Rue Arthur Brunet
    59220 DENAIN
    <br/>
    <br/>
    En l’absence d’autorisation donnée conformément aux dispositions du
    paragraphe précédent, Formaleaz se réserve le droit d’engager toutes
    poursuites judiciaires contre la ou les personnes contrevenantes sur le
    fondement des articles L. 335-2 et suivants du Code de la propriété
    intellectuelle.
    <br/>
    <br/>
    Formaleaz accorde à l’utilisateur un droit d’utilisation non exclusif et
    non transférable du site et des données et éléments qui le composent, le
    droit concédé étant compris pour un usage strictement privé et dans le
    cadre limitatif suivant : (i) droit de consulter en ligne les œuvres, les
    données et éléments disponibles sur le site ; (ii) droit de reproduire par
    voie d’impression les œuvres, données et éléments constituant le site.
    <br/>
    <br/>
    L’utilisateur reconnaît qu’il n’est autorisé à utiliser le contenu du site
    que dans les limites fixées par les présentes. Sans préjudice des
    dispositions figurant à l’alinéa précédent, l’attention de l’utilisateur
    est attirée sur le fait qu’il est expressément interdit de reproduire,
    représenter, diffuser, distribuer, télécharger, extraire, réutiliser,
    modifier, adapter, traduire les éléments et données du site dans le cadre
    d’une activité commerciale. Les atteintes à cette interdiction seront
    systématiquement portées par Formaleaz devant les juridictions compétentes.
    <br/>
    <br/>
    L’utilisateur s’interdit également d’importer des données ou éléments sur
    le site qui auraient pour effet de modifier la nature ou l’apparence de son
    contenu, sa présentation ou l’articulation des données et éléments qui le
    composent. La marque Formaleaz et, le cas échéant, tous les autres logos,
    noms ou signes distinctifs figurant sur le site sont des marques déposées
    et à ce titre protégées par les dispositions du Code de la propriété
    intellectuelle (article L. 712-1 et suivants).
    <br/>
    <br/>
    A défaut d’une autorisation préalable et expresse de Formaleaz ou de leur
    titulaire, il est strictement interdit à l’utilisateur d’en faire usage
    isolément ou en les associant à ses propres signes distinctifs, noms ou
    marques.
    <br/>
    <br/>
    Sont également soumis à autorisation : (i) la mise en place d’un lien
    hypertexte vers la page d’accueil du site www.formaleaz.fr ; (ii) le renvoi
    à des pages secondaires du site www.formaleaz.fr par le biais d’un lien
    profond. Pour obtenir cette autorisation, il convient de contacter le
    correspondant du Pôle numérique avec une demande motivée à l’adresse
    suivante : Formaleaz, 350 Rue Arthur Brunet 59220 DENAIN ,
    <br/>
    <br/>
    Lorsqu’il est proposé à l’utilisateur d’être redirigé par des liens
    hypertexte figurant sur le site www.formaleaz.fr vers des sites appartenant
    à des tiers, Formaleaz ne peut en aucun cas être tenue pour responsable des
    contenus, données ou éléments proposés par ceux-ci et le cas échéant, des
    éventuels préjudices dont pourrait se prévaloir l’utilisateur à l’occasion
    de l’utilisation de ces sites tiers.
    <br/>
    <br/>
    Dans tous les cas, si le contenu du site est utilisé en violation des
    dispositions qui précèdent ou de la législation en vigueur, Formaleaz
    prendra toutes mesures conservatoires ou définitives lui assurant le
    respect de ses droits et prérogatives.
    <br/>
</p>
<p>
    <strong>
        <u>Droits d'opposition, d'accès et de rectification de données</u>
    </strong>
    <br/>
    <br/>
    Conformément à la loi n° 78-17 du 6 janvier 1978 modifiée relative à
    l'informatique, aux fichiers et aux libertés et pour des motifs légitimes,
    vous bénéficiez d'un droit d'accès, d’opposition, de rectification et de
    suppression des données personnelles vous concernant et faisant l’objet
    d’un traitement, que vous pouvez exercer en vous adressant à
    l'administrateur du Site : FORMALEAZ , 350 Rue Arthur Brunet 59220 DENAIN.
    Votre demande doit préciser votre nom, prénom, adresse électronique et
    adresse postale et doit être accompagnée d'une copie de votre pièce
    d'identité<strong></strong>
</p>

</div>