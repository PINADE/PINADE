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
    //$this->forward('default', 'module');
  }

  public function executeIndexPromo(sfWebRequest $request)
  {
    $this->filiere = $request->getParameter('filiere');
  }
  
  public function executeImage(sfWebRequest $request)
  {
    $this->filiere = $request->getParameter('filiere');
    $this->promo = $request->getParameter('promo');

    $adeImage = new AdeImage(28, 2, "0,1,2,3,4,5", "134,132,133", "800", "600", 1057855, 8);

    $adeImage->getImage();
    $adeImage->saveAdeImage();
  }
}
