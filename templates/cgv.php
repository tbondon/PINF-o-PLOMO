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
  <strong>Objet et champ d'application</strong>
</p>
<p>
  Suite à la commande d'une formation le Client accepte sans réserve les
  présentes conditions générales de vente qui prévalent sur tout autre
  document de l'acheteur, en particulier ses conditions générales d'achat.
</p>
<p>
  <strong>Documents contractuels</strong>
</p>
<p>
  A la demande du Client, FORMALEAZ lui fait parvenir en double exemplaire
  une convention de formation professionnelle continue telle que prévue par
  la loi. Le client engage FORMALEAZ lui en retournant dans les plus brefs
  délais un exemplaire signé et portant son cachet commercial.
</p>
<p>
  Pour les formations, une facture de la totalité de la prestation est
  adressée dès la prise de la commande.
</p>
<p>
  Une inscription est définitivement validée lorsque le présent document
  signé sur les 2 pages et un chèque d'acompte de 100% sont reçus par nos
  services.
</p>
<p>
  Le Service planning de FORMALEAZ convient avec le Service Formation du
  Client des lieu, dates et horaires des séances de formation. A l’issue de
  cette formation, une attestation de présence est adressée au Service
  Formation du Client.
</p>
<p>
  <strong>Prix, facturation et règlement</strong>
</p>
<p>
  Tous nos prix sont indiqués hors taxes. Ils sont à majorer de la TVA au
  taux en vigueur. Toute formation commencée est due en totalité. Sauf
  mention contraire, ils comprennent les frais de déplacement et de bouche du
  formateur.
</p>
<p>
  L’acceptation de la société FORMALEAZ étant conditionnée par le règlement
  intégral de la facture avant le début de la prestation, la société se
  réserve expressément le droit de ne pas délivrer la prestation au client
  tant que la totalité de la prestation n’aura pas été réglée dans les
  conditions prévues ci-dessous.
</p>
<p>
  Les factures sont payables, sans escompte et à l'ordre de la société
  FORMALEAZ à réception de facture avant le début de la prestation.
</p>
<p>
  En cas de non-paiement intégral d'une facture venue à échéance, après mise
  en demeure restée sans effet dans les 8 jours ouvrables, FORMALEAZ se
  réserve la faculté de suspendre toute formation en cours et /ou à venir.
</p>
<p>
  <strong>Règlement par un OPCA</strong>
</p>
<p>
  En cas de règlement de la prestation pris en charge par l’Organisme
  Paritaire Collecteur Agréé dont il dépend, il appartient au Client de :
</p>
<p>
  - faire une demande de prise en charge avant le début de la formation et de
  s'assurer l'acceptation desa demande;
</p>
<p>
  - indiquer explicitement sur la convention et de joindre à FORMALEAZ une
  copie de l’accord de prise en charge ;
</p>
<p>
  - s'assurer de la bonne fin du paiement par l'organisme qu'il aura désigné.
</p>
<p>
  En cas de paiement partiel du montant de la formation par l'OPCA, le solde
  sera facturé au Client. Si FORMALEAZ n'a pas reçu la prise en charge de
  l'OPCA au 1er jour de la formation, le Client sera facturé de l'intégralité
  du coût de la formation.
</p>
<p>
  Le cas échéant, le remboursement des avoirs par FORMALEAZ est effectué sur
  demande écrite du Client accompagné d'un relevé d'identité bancaire
  original.
</p>
<p>
  <strong>Pénalités de retard</strong>
</p>
<p>
  En cas de retard de paiement, seront exigibles, conformément à l'article L
  441-6 du code de commerce, une indemnité calculée sur la base de trois fois
  le taux de l'intérêt légal en vigueur ainsi qu'une indemnité forfaitaire
  pour frais de recouvrement de 40 euros.
</p>
<p>
  Ces pénalités sont exigibles de plein droit, dès réception de l’avis
  informant le Client qu’elles ont été portées à son débit.
</p>
<p>
  <strong>Refus de commande</strong>
</p>
<p>
  Dans le cas où un Client s’inscrirait à une formation FORMALEAZ, sans avoir
  procédé au paiement des formations précédentes, FORMALEAZ pourra refuser
  d’honorer la commande et lui refuser sa participation à la formation, sans
  que le Client puisse prétendre à une quelconque indemnité, pour quelque
  raison que ce soit.
</p>
<p>
  <strong>
    Conditions d’annulation et de report de l’action de formation
  </strong>
</p>
<p>
  Toute annulation par le Client doit être communiquée par écrit. Pour toute
  annulation, fût-ce en cas de force majeure :
</p>
<p>
  - si une annulation intervient avant le début de la prestation et que
  l'action de formation est reportée dans un délai de 12 mois à compter de la
  date de la commande, la totalité du règlement du client sera portée au
  crédit du Client sous forme d'avoir imputable sur une formation future. Si
  aucun report n'a été effectué dans ce délai de 12 mois le règlement restera
  acquis à FORMALEAZ à titre d'indemnité forfaitaire.
</p>
<p>
  - si une annulation intervient pendant la formation, le règlement reste
  acquis à FORMALEAZ à titre d'indemnité forfaitaire.
</p>
<p>
  En cas de subrogation, le Client s’engage à payer les montants non pris en
  charge par l’OPCA.
</p>
<p>
  <strong>
    Conditions d’annulation et de report d’une séance de formation
  </strong>
</p>
<p>
  Le Client peut annuler une séance de formation dans la mesure où cette
  annulation survient au moins quatre jours ouvrés avant le jour et l’heure
  prévus. Toute annulation d’une séance doit être communiquée par e-mail à
  l’adresse contact@formaleaz.fr. La séance peut ensuite être reportée selon
  le planning du formateur.
</p>
<p>
  <strong>Informatique et libertés</strong>
</p>
<p>
  Les informations à caractère personnel qui sont communiquées par le Client
  à FORMALEAZ en application et dans l’exécution des formations pourront être
  communiquées aux partenaires contractuels de FORMALEAZ pour les seuls
  besoins desdits stages. Le Client peut exercer son droit d’accès, de
  rectification et d’opposition conformément aux dispositions de la loi du 6
  janvier 1978.
</p>
<p>
  <strong>Renonciation</strong>
</p>
<p>
  Le fait, pour FORMALEAZ de ne pas se prévaloir à un moment donné de l'une
  quelconque des clauses présentes ne peut valoir renonciation à se prévaloir
  ultérieurement de ces mêmes clauses.
</p>
<p>
  <strong>Obligation de non sollicitation de personnel</strong>
</p>
<p>
  Le Client s'engage à ne pas débaucher ou embaucher le personnel de
  FORMALEAZ ayant participé à l'exécution du contrat, pendant toute la durée
  de celui-ci et pendant les deux années civiles qui suivront la cessation
  des relations contractuelles. En cas de non respect de la présente
  obligation, le Client devra verser à FORMALEAZ à titre de clause pénale une
  indemnité égale à douze fois le dernier salaire, charges patronales en sus,
  du salarié indûment débauché.
</p>
<p>
  <strong>Loi applicable</strong>
</p>
<p>
  La loi française est applicable en ce qui concerne ces Conditions Générales
  de Ventes et les relations contractuelles entre FORMALEAZ et ses Clients.
</p>
<p>
  <strong>Attribution de compétence</strong>
</p>
<p>
  Tous litiges qui ne pourraient être réglés à l’amiable seront de la
  COMPETENCE EXCLUSIVE DU TRIBUNAL DE COMMERCE DE VALENCIENNES, quel que soit
  le siège ou la résidence du Client, nonobstant pluralité de défendeurs ou
  appel en garantie. Cette clause attributive de compétence ne s’appliquera
  pas au cas de litige avec un Client non professionnel pour lequel les
  règles légales de compétence matérielle et géographique s’appliqueront. La
  présente clause est stipulée dans l'intérêt de FORMALEAZ qui se réserve le
  droit d'y renoncer si bon lui semble.
</p>
<p>
  <strong>Election de domicile</strong>
</p>
<p>
  L'élection de domicile est faite par FORMALEAZ à son siège social au 350
  Rue Arthur Brunet 59220 DENAIN
</p>
</div>