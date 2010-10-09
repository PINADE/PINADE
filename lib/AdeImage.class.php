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
    $ade_cookie,
    $projectId,
    $idPianoWeek,
    $idPianoDay,
    $idTree, 
    $width = "1024",
    $height = "768",
    $displayMode = "1057855",
    $displayConfId = "8",
    $url,
    $ade_browser;

  public function __construct($trees = null, $options = array())
  {
    $this->ade_browser = new AdeBrowser();

    if(is_array($trees))
      $this->initialize($trees, $options);
  }
  
  public function initialize($trees, $options = array())
  {
    $filieres = sfConfig::get('sf_filieres');
    if(!is_array($trees))
      throw new sfException('$trees must be an array');

    foreach($trees as $tree)
    {
      if(isset($filieres[$tree['filiere']]))
      {
        if(isset($filieres[$tree['filiere']]['promotions'][$tree['promo']]))
          $id_tree[] = $filieres[$tree['filiere']]['promotions'][$tree['promo']]['trees'];
        else
          throw new sfError404Exception('La promo '.$tree['promo'].' de la filière '.$tree['filiere'].' n\'existe pas');
      }
      else throw new sfError404Exception('La filière '.$tree['filiere'].' n\'existe pas');
    }
    if(count($id_tree) == 0) throw new sfException('$id_tree is empty !');
    
    $options = array_merge(array(
      'projectId' => sfConfig::get('sf_ade_project_id'),
      'idPianoWeek' => AdeTools::getSemaineNumber(),
      'idPianoDay' => '0,1,2,3,4',
      'idTree' => implode(',', $id_tree),
      'width' => '800',
      'height' => '600',
      'displayMode' => '1057855',
      'displayConfId' => '8',
    ), $options);

    $this->projectId = $options['projectId'];
    $this->idPianoWeek = $options['idPianoWeek'];
    $this->idPianoDay = $options['idPianoDay'];
    $this->idTree = $options['idTree'];
    $this->width = $options['width'];
    $this->height = $options['height'];
    $this->displayMode = $options['displayMode'];
    $this->displayConfId = $options['displayConfId'];

    $this->url = "http://www.emploidutemps.uha.fr/ade/imageEt?".
      "identifier=".sfConfig::get('sf_ade_identifier').
      "&projectId=".$this->projectId.
      "&idPianoWeek=".$this->idPianoWeek.
      "&idPianoDay=".$this->idPianoDay.
      "&idTree=".$this->idTree.
      "&width=".$this->width.
      "&height=".$this->height.
      "&lunchName=REPAS".
      "&displayMode=".$this->displayMode.
      "&showLoad=false".
      "&ttl=1283427991552".
      "&displayConfId=".$this->displayConfId;
  }
  
  public function getImage()
  {
    $this->content = AdeTools::getAdeImage($this->ade_cookie, $this->url);
  }

  public function updateImage($force = false)
  {
    $path = $this->getPath();
    $filepath = $path.$this->getFilename();

    
    if(!file_exists($filepath))                 // Si le fichier n'existe pas, on met à jour
      $update = true;
    elseif(file_get_contents($filepath) == "") // Sinon, si le fichier est vide, idem
      $update = true;
    elseif(time() > filemtime($filepath) + 6*60*60) // Si le fichier a été modifié il y a plus de 6h, on met à jour
      $update = true;
    else                                      // Sinon, si on force si on décide comme ça
      $update = $force;

    if($update != true)
    {
      sfContext::getInstance()->getLogger()->info('Image déjà en cache : '.$filepath);
      return;
    }

    // Refresh content if we have to
    $content = $this->ade_browser->getUrl($this->url);

    // Create the directory if we need to
    if(!is_dir($path))
      mkdir($path);

    // Check if the image is type of 'image/gif' (PHP 5.3 min)
    $finfo = new finfo(FILEINFO_MIME);
    if(empty($content))
    {   // Do NOT remove cache if the file is empty (there is likely a problem)
      sfContext::getInstance()->getLogger()->info($erreur = 'Image vide lors du téléchargement ! Cache non réécrit');

    }
    elseif (strpos($finfo->buffer($content), 'image/gif') === false)
    {
      sfContext::getInstance()->getLogger()->info($erreur = 'le contenu n\'est pas une image. Pas de remplacement !');
    }
    else // it seems OK, we can write it
    {
      file_put_contents($filepath, $content);
      return 0;
    }
    // There is a problem, we send a mail !
    
    $message = $this->getMailer()->compose(
      array('informatique@iariss.fr' => 'Informatique IARISS'),
      array('informatique@iariss.fr' => 'Informatique IARISS',
        'presidence@iariss.fr' => 'Présidence IARISS'),
      'Image de edt.iariss.fr non mise à jour',
  <<<EOF
  Bonjour,

  L'emploi du temps a essayé de télécharger {$this->url} mais a échoué.
  {$erreur}

  Si vous ne savez pas qui contacter, vous pouvez joindre Théophile : t.helleboid@iariss.fr
EOF
    );
    $this->getMailer()->send($message);
  }

  protected function getPath()
  {
    return str_replace(',','-',sfConfig::get('sf_web_dir').'/images/edt/'.$this->idTree.'/');
  }

  protected function getFilename()
  {
    return str_replace(',','-',$this->idPianoWeek).'.gif';
  }

  public function getWebPath()
  {
    return '/images/edt/'.str_replace(',','-',$this->idTree).'/'.str_replace(',','-',$this->idPianoWeek).'.gif';
  }
  public function setIdTree()
  {
    // Sélectionner un id :
    //  http://www.emploidutemps.uha.fr/ade/standard/gui/tree.jsp?selectId=269&reset=false&forceLoad=false&scroll=0
    // http://www.emploidutemps.uha.fr/ade/standard/gui/tree.jsp?selectId=191&reset=true&forceLoad=false&scroll=57
/*    $reset = 'true';
    foreach(explode(',', $this->idTree) as $id_tree)
    {
      $this->ade_browser->getUrl('http://www.emploidutemps.uha.fr/ade/standard/gui/tree.jsp?'.
         'selectId='.$id_tree
        .'&reset='.$reset
        .'&forceLoad=false&scroll=0');
      // On ne reset plus pour ne pas perdre les premiers sélectionnés
      $reset = 'false';
    }
*/

    foreach(array(
      'http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/plannings.jsp', // Obligatoire 
      'http://www.emploidutemps.uha.fr/ade/standard/gui/tree.jsp?category=trainee&expand=false&forceLoad=false&reload=false&scroll=0',
      'http://www.emploidutemps.uha.fr/ade/standard/gui/tree.jsp?selectBranchId=199&reset=false&forceLoad=false&scroll=0',
      ) as $url)
    {
      $this->ade_browser->getUrl($url);
    }

  }

  public function setIdWeek()
  {
   // Sélectionner une semaine :
    // http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/imagemap.jsp?reset=true&week=3&width=1274&height=143
    // http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/bounds.jsp?week=2&reset=true
    $reset = 'true';
    foreach(explode(',', $this->idPianoWeek) as $id_piano_week)
    {
//      $this->ade_browser->getUrl('http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/imagemap.jsp?'.
      $this->ade_browser->getUrl('http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/bounds.jsp?'.
          'reset='.$reset
        .'&week='.$id_piano_week
        .'&width='.$this->width
        .'&height='.$this->height);
      $reset = 'false';
    }
  }

  public function setIdDay()
  {
    // Sélectionner un seul jour :
    //  http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/pianoDays.jsp?day=2&reset=true&forceLoad=false
    $reset = 'true';
    foreach(explode(',', $this->idPianoDay) as $id_piano_day)
    {
      $this->ade_browser->getUrl('http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/pianoDays.jsp?'.
          'day='.$id_piano_day
         .'&reset='.$reset
         .'&forceLoad=false');
      // On ne reset plus pour ne pas perdre les premiers sélectionnés
      $reset = 'false';
    }
  }

  public function setProjectId()
  {
    $this->ade_browser->getUrl('http://www.emploidutemps.uha.fr/ade/standard/gui/interface.jsp', 'projectId='.$this->projectId.'&x=41&y=9');
  }
  
  public function getHtmlInfo()
  {
  }
  public function parseHtmlInfo()
  {
//    $adeImage->setProjectId();
//    $adeImage->setIdTree();

//*    $adeImage->setIdWeek();
//*    $adeImage->setIdDay();

//    $this->html_info = $this->ade_browser->getUrl('http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/info.jsp?light=true&order=slot');

    $this->html_info = file_get_contents(sfConfig::get('sf_web_dir').'/info2.html');
    
    // replace & by &amp; and remove <BODY> line (there is 2 <BODY ...>)
    $this->html_info = str_replace('&', '&amp;', $this->html_info);
    $this->html_info = str_replace('<BODY>', '', $this->html_info);

    $dom = new domDocument; 
    $string = "";

    /*** load the html into the object ***/ 
    if(!$dom->loadHTML($this->html_info))
      throw new sfException('HTML non chargé');

    /*** discard white space ***/ 
    $dom->preserveWhiteSpace = false; 

    /*** the table by its tag name ***/ 
    $tables = $dom->getElementsByTagName('table'); 

    /*** get all rows from the table ***/ 
    $rows = $tables->item(0)->getElementsByTagName('tr'); 

    /*** loop over the table rows ***/ 
    foreach ($rows as $row) 
    { 
        /*** get each column by tag name ***/ 
        $cols = $row->getElementsByTagName('td'); 
        /*** echo the values ***/ 
        foreach($cols as $col)
        {
          $string .= $col->nodeValue.',';
        }
        $string .= "\n";
    }
    return $string;
  }
}


