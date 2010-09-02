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
    $displayConfId = "8";

  public function __construct($projectId, $idPianoWeek, $idPianoDay, $idTree, $width = "1024", $height = "768", $displayMode = "1057855", $displayConfId = "8")
  {
    $this->ade_image = AdeTools::getAdeCookie();
  }
  


  public function saveAdeImage()
  {
    $this->
  }
}


