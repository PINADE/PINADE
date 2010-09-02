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
    $content;

  public function __construct($projectId, $idPianoWeek, $idPianoDay, $idTree, $width = "1024", $height = "768", $displayMode = "1057855", $displayConfId = "8")
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
  }
  
  public function getImage()
  {
    $this->content = AdeTools::getAdeImage(
      $this->ade_cookie,
      $this->projectId,
      $this->idPianoWeek,
      $this->idPianoDay,
      $this->idTree,
      $this->width,
      $this->height,
      $this->displayMode,
      $this->displayConfId);
  }

  public function saveAdeImage()
  {
    $this->
  }
}


