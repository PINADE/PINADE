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
    $semaine = $request->getParameter('semaine');
    $this->semaine_suivante = AdeTools::getSemaineNumber($semaine + 1);
    $this->semaine_precedente = AdeTools::getSemaineNumber($semaine -1);

    $adeImage = new AdeImage(array(array($this->filiere, $this->promo )));

    $adeImage->saveAdeImage();
    
    $this->image_path = $adeImage->getWebPath();
  }
}
