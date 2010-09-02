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
    $projectId = "27",
    $idPianoWeek,
    $idPianoDay,
    $idTree, 
    $width = "1024",
    $height = "768",
    $displayMode = "1057855",
    $displayConfId = "8",
    $url,
    $content;

  public function __construct($projectId, $idPianoWeek, $idPianoDay, $idTree, $width = "800", $height = "600", $displayMode = "1057855", $displayConfId = "8")
  {
    $this->ade_cookie = AdeTools::getAdeCookie();
    
    $this->projectId = $projectId;
    $this->idPianoWeek = $idPianoWeek;
    $this->idPianoDay = $idPianoDay;
    $this->idTree = $idTree;
    $this->width = $width;
    $this->height = $height;
    $this->displayMode = $displayMode;
    $this->displayConfId = $displayConfId;

    $this->url = "http://www.emploidutemps.uha.fr/ade/imageEt?".
      "identifier=3df5af70498bff8bc4facf408da524dc".
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

  public function saveAdeImage()
  {
    file_put_contents(sfConfig::get('sf_web_dir')."/images/edt/image.gif", $this->content);
  }
}


