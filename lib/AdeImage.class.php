<?php

/**
 * edt tools.
 *
 * @package    edt
 * @subpackage edt
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdeImage
{

  protected
    $promotion,
    $ade_cookie,
    $projectId,
    $semaine,
    $ade_browser,
    $error = "";

  public function __construct(Promotion $promotion = null, $semaine = null)
  {
    $this->ade_browser = new AdeBrowser();
    $this->promotion = $promotion;

    if($semaine == null)
      $this->semaine = AdeTools::getSemaineNumber();
    else
      $this->semaine = $semaine;
    
  }
  
  public function getUrl($week = NULL)
  {

    return sfConfig::get('sf_ade_url')."imageEt?".
      "identifier=".sfConfig::get('sf_ade_identifier').
      "&projectId=".$this->promotion->getProjectId().
      "&idPianoWeek=".$this->semaine.
      "&idPianoDay=".$this->promotion->getIdPianoDay().
      "&idTree=".$this->promotion->getIdTree().
      "&width=".$this->promotion->getWidth().
      "&height=".$this->promotion->getHeight().
      "&lunchName=REPAS".
      "&displayMode=".sfConfig::get('sf_ade_display_mode').
      "&showLoad=false".
      "&ttl=1283427991552".
      "&displayConfId=".sfConfig::get('sf_ade_display_conf_id');
  }


  /**
    Retourne les informations de la semaine, si elles existent
  */
  public function getNotice()
  {
    $path = $this->getPath().'/notice-'.$this->semaine.'.txt';
    if(file_exists($path))
      return file_get_contents($path);
    else
      return;
  }

  /**
    Retourne les informations de la semaine, si elles existent
  */
  public function setNotice($notice)
  {
    $path = $this->getPath().'/notice-'.$this->semaine.'.txt';
    return file_put_contents($path, $notice) ;
  }

  public function updateImage($force = false)
  {
    $path = $this->getPath();
    $filepath = $path.$this->getFilename();

    
    if(!file_exists($filepath))                 // Si le fichier n'existe pas, on met à jour
      $update = true;
    elseif(time() > filemtime($filepath) + 3*60*60) // Si le fichier a été modifié il y a plus de 3h, on met à jour
      $update = true;
    elseif(file_get_contents($filepath) == "") // Sinon, si le fichier est vide, idem
      $update = true;
    else                                      // Sinon, si on force si on décide comme ça
      $update = $force;

    if($update != true)
    {
      sfContext::getInstance()->getLogger()->info('Image déjà en cache : '.$filepath);
      $this->error = "already in cache";
      return;
    }

    // Refresh content if we have to
    $content = $this->ade_browser->getUrl($this->getUrl());

    // Create the directory if we need to
    if(!is_dir($path))
      mkdir($path);

    if(empty($content))     // Do NOT remove cache if the file is empty (there is likely a problem)
    {
      sfContext::getInstance()->getLogger()->info('Image vide lors du téléchargement ! Cache non réécrit');
      $this->error = "empty picture : ".$this->getUrl();
    }
    else
    {
      // L'image n'est pas vide, est-elle vraiment une image ?
      $tempname = tempnam($this->getPath(), "edt-");
      file_put_contents($tempname, $content);

      if (getimagesize($tempname)== false)
      {
        sfContext::getInstance()->getLogger()->info('le contenu n\'est pas une image. Pas de remplacement !');
        $this->error = "not a picture : ".$this->getUrl();
      }
      else
      { // it seems OK, we can write it
        file_put_contents($filepath, $content);
      }
      // Suppression du fichier temporaire
      unlink($tempname);
    }

  }

  public function getPath()
  {
    return str_replace(',','-',sfConfig::get('sf_web_dir').'/images/edt/'.$this->promotion->getIdTree().'/');
  }

  protected function getFilename()
  {
    return str_replace(',','-',$this->semaine).'.gif';
  }

  public function getWebPath()
  {
    return '/images/edt/'.str_replace(',','-',$this->promotion->getIdTree()).'/'.str_replace(',','-',$this->semaine).'.gif';
  }
  public function getInfoPath()
  {
    return $this->getPath().'info.html';
  }

  public function getIcalPath()
  {
    return $this->getPath().'ical.ics';
  }



  public function updateHtml()
  {

    // Select Project
    $this->ade_browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/interface.jsp', 'projectId='.sfConfig::get('sf_ade_project_id').'&x=41&y=9');
    // Mandatory (because of ADE) and select the colmuns
    $this->ade_browser->getUrl(sfConfig::get('sf_ade_url').'custom/modules/plannings/plannings.jsp?c6T=0&c6M=0&c6J=0&aSize=0&aNe=0&c6F=0&c6E=0&c6C=0&displayType=0&c7A2=0&c7A1=0&aMx=0&roTz=0&roTy=0&c5A2=0&showTabRooms=1&c5A1=0&c5T=0&c5M=0&c5J=0&roUrl=0&c5F=0&c5E=0&c5C=0&iA2=0&iA1=0&reTz=0&reTy=0&showLoad=0&roSt=0&showTabCategory8=0&showTabCategory7=0&showTabCategory6=0&showTabCategory5=0&changeOptions=1&c8Cz=0&c8Cy=0&c8Cx=0&c7Url=0&c8Ct=0&c6Cz=0&c6Cy=0&c6Cx=0&aUrl=0&c6Ct=0&c8Ci=0&showTreeCategory1=1&reSt=0&c6Ci=0&iT=0&iM=0&iJ=0&iF=0&iE=0&iC=0&c7Tz=0&c7Ty=0&showTabDate=1&c5Tz=0&c5Ty=0&c8Zp=0&c6Zp=0&showPianoDays=1&iTz=0&iTy=0&c7St=0&c8Url=0&roCz=0&c5St=0&roCy=0&roCx=0&roCt=0&showTabTrainees=1&roCi=0&displayConfId=17&aTz=0&aTy=1&showTabActivity=1&display=1&iSt=0&showTabStage=0&reCz=0&reCy=0&reCx=0&c8A2=0&c8A1=0&reCt=0&reT=0&c6A2=0&c6A1=0&reM=0&reCi=0&reJ=0&reF=0&reE=0&reC=0&aSl=0&roZp=0&showTabResources=0&showTabInstructors=1&showTabWeek=0&y=&x=&reZp=0&c7Cz=0&c7Cy=0&c7Cx=0&c7Ct=0&c5Cz=0&c5Cy=0&c5Cx=0&showTabDuration=1&c5Ct=0&showTabDay=0&roT=0&c7Ci=0&roM=0&c5Ci=0&roJ=0&c5Url=0&roF=0&roE=0&iCz=0&roC=0&roA2=0&iCy=0&roA1=0&iCx=0&iCt=0&showPianoWeeks=1&c8Tz=0&c8Ty=0&iCi=0&c6Tz=0&c8T=0&c6Ty=0&showTab=1&c8M=0&c8J=0&aCz=0&aCy=0&c7Zp=0&aCx=0&c8F=0&c8E=0&c8C=0&reA2=0&reA1=0&c5Zp=0&c8St=0&c7T=0&c6St=0&c7M=0&aN=0&c7J=0&reUrl=0&isClickable=1&c7F=0&iZp=0&c7E=0&showTabHour=1&iUrl=0&c7C=0&aC=0&c6Url=0');
    // Select groups of students
    $this->ade_browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/tree.jsp?category=trainee&expand=false&forceLoad=false&reload=false&scroll=0');

    $reset = "true";
    foreach(explode(",",$this->promotion->getBranchId()) as $branchId)
    {
      // Select a group
      $this->ade_browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/tree.jsp?branchId='.$branchId.'&reset='.$reset.'&forceLoad=false&scroll=0');
      $reset = "false";
    }

    $reset = "true";
    foreach(explode(",",$this->promotion->getSelectBranchId()) as $selectBranchId)
    {
      // "Click" on a branch
      $this->ade_browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/tree.jsp?selectBranchId='.$selectBranchId.'&reset='.$reset.'&forceLoad=false&scroll=0');
      $reset = "false";
    }

    $reset = "true";
    foreach(explode(",",$this->promotion->getSelectId()) as $selectId)
    {
      // "Click" on a group
      $this->ade_browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/tree.jsp?selectId='.$selectId.'&reset='.$reset.'&forceLoad=false&scroll=0');
      $reset = "false";
    }

    $reset = "true";
    for($i = 1; $i < 44; $i++)
    {
      // select weeks
      $this->ade_browser->getUrl(sfConfig::get('sf_ade_url').'custom/modules/plannings/info.jsp?order=slot&week='.$i.'&reset='.$reset);
      $reset = "false";
    }
    // Get the page with the link to the image
    $imagemap = $this->ade_browser->getUrl(sfConfig::get('sf_ade_url').'custom/modules/plannings/info.jsp?light=true&order=slot');
    file_put_contents($this->getInfoPath(), $imagemap);
  }

  public function updateIcal()
  {
    $filepath = $this->getInfoPath();
//    if(!file_exists($filepath))
//    {
//      $this->updateHtml();
//      throw new sfException('Pas de fichier "'.$filepath.'" ');
//    }

    $this->html_info = file_get_contents($filepath);
    
    $this->html_info = str_replace('<BODY>','', $this->html_info);
    $this->html_info = str_replace('&amp;','&', $this->html_info);
    $this->html_info = str_replace('&','&amp;', $this->html_info);
    $dom = new DOMDocument(); // creation d'un objet DOM pour lire le html 
    if(!$dom->loadHTML($this->html_info))
      throw new sfException('HTML non chargé');
    
    $ical = "BEGIN:VCALENDAR
PRODID:-//edt.iariss.fr//Symfony1.4 iariss.fr//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-WR-CALNAME:edt.iariss.fr - ".$this->promotion." - ".$this->promotion->getFiliere()."
X-WR-TIMEZONE:Europe/Paris
BEGIN:VTIMEZONE
TZID:Europe/Paris
X-LIC-LOCATION:Europe/Paris
BEGIN:DAYLIGHT
TZOFFSETFROM:+0000
TZOFFSETTO:+0200
TZNAME:CEST
DTSTART:19700329T020000
RRULE:FREQ=YEARLY;BYMONTH=3;BYDAY=-1SU
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETFROM:+0200
TZOFFSETTO:+0100
TZNAME:CET
DTSTART:19701025T030000
RRULE:FREQ=YEARLY;BYMONTH=10;BYDAY=-1SU
END:STANDARD
END:VTIMEZONE\n\n";
    
    $lignes = $dom->getElementsByTagName('tr'); // on recupere toute les lignes
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

      $ical .= "BEGIN:VEVENT\n";
      $ical .= "SUMMARY:$nom - $salle - $prof - $promo\n";
      $ical .= "DTSTART:".$date[2].$date[1].$date[0]."T".$heure[0].$heure[1]."00\n";
      $ical .= "DURATION:PT".intval($duree[0])."H".intval($duree[1])."M0S\n";
      $ical .= 'LOCATION:'.$salle."\n";
      $ical .= "DESCRIPTION:$nom - $salle - $prof - $promo - ".$entree['date']." - ".$entree['heure']." (".$entree['duree'].")\n";
      $ical .= "UID:".$date[2].$date[1].$date[0]."T".$heure[0].$heure[1]."01-$prof$salle$type".$this->promotion."-".$this->promotion->getFiliere()."@edt.iariss.fr\n";
      $ical .= "END:VEVENT\n\n";      

    }


    $ical .= "END:VCALENDAR";

    file_put_contents($this->getIcalPath(), $ical);

  }

  public function getError()
  {
    return $this->error;
  }

}


