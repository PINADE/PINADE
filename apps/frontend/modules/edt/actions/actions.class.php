<?php

/**
 * edt actions.
 *
 * @package    edt
 * @subpackage edt
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class edtActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

  }

  public function executeIndexPromo(sfWebRequest $request)
  {
    $this->filiere = $request->getParameter('filiere');
  }
  
  public function executeImage(sfWebRequest $request)
  {
    $this->filiere = $request->getParameter('filiere');
    $this->promo = $request->getParameter('promo');
    $semaine = intval($request->getParameter('semaine', AdeTools::getSemaineNumber()));
    $this->semaine_suivante = $semaine + 1;
    // Pas de semaine négative !
    $this->semaine_precedente = max(0,$semaine - 1);

    $adeImage = new AdeImage(array(array($this->filiere, $this->promo )), array('idPianoWeek' => $semaine));

    $adeImage->updateImage();
    
    $this->image_path = $adeImage->getWebPath();

    // Timestamp du lundi, début de semaine
    $this->timestamp = AdeTools::getTimestamp($semaine);
  }

  public function executeError404(sfWebRequest $request)
  {

  }

  public function executeFaq(sfWebRequest $request)
  {
  }
}
