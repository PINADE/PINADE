BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//edt.iariss.fr//Symfony1.4//
TZNAME:Paris\, Madrid


<?php

$lignes = $dom->getRawValue()->getElementsByTagName('tr'); // on recupere toute les lignes
$noms = array('date','nom', 'heure','duree', 'type', 'promo','prof','salle');


// EXTRACTION DES DONNEES DU DOMDOCUMENT
$stamp_id = rand(10,59);
$i=0;
foreach ($lignes as $ligne)
{
  // les deux premiers tr sont des titres, osef
  if(++$i<=2) continue;

  $content = $ligne->childNodes;
  $entree = array();
  for($j=0;$j<count($noms);$j++)
  {
          $entree[$noms[$j]] = $content->item($j)->nodeValue; // attribution des valeurs aux variables
  }
  $date = explode('/', $entree['date']);                // array(JJ, MM, AAAA)
  $nom = $entree['nom'];                                // string
  $heure = explode('h',substr($entree['heure'],0,5));   // array(HH, mm)
  $duree = explode('h',substr($entree['duree'],0,5));   // array(HH, mm)
  $type = $entree['type'];                             // string
  $promo = $entree['promo'];                            // string
  $prof = $entree['prof'];                              // string
  $salle = $entree['salle'];                            // string

  echo "BEGIN:VEVENT\n";
  echo "DESCRIPTION:$nom - $salle - $prof - $promo\n";
  echo "DTSTART:".$date[2].$date[1].$date[0]."T".$heure[0].$heure[1]."00Z\n";
  echo "DURATION:PT".intval($duree[0])."H".intval($duree[1])."M0S\n";
  echo 'LOCATION:'.$salle."\n";
  echo "SUMMARY:$nom - $salle - $prof - $promo - ".$entree['date']." - ".$entree['heure']." ".$entree['duree'].")\n";
  echo "END:VEVENT\n\n";      

}
/* */
?>
END:VCALENDAR
