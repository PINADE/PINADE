<?php

/**
 * cookie actions.
 *
 * @package    edt
 * @subpackage cookie
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cookieActions extends sfActions
{
  /**
   *  Set and reset default cookie 
   */
  public function executeSet(sfWebRequest $request)
  {
    switch($request->getParameter('key'))
    {
      case 'default':
        $this->setDefault($request);
        break;
      case 'css':
        $this->setStylesheet($request);
        break;
    }
    // TODO : redirection referer sinon homepage
    $this->redirect($request->getReferer('@homepage'));
  }

  public function executeReset(sfWebRequest $request)
  {
    // Expires yesterday ! => expires now
    $this->getResponse()->setCookie($request->getParameter('key'), '', 'yesterday');
    $this->getUser()->setFlash('info', 'Cookie effacé');

    // TODO redirection referer sinon homepage
    $this->redirect($request->getReferer('@homepage'));
  }

  protected function setDefault(sfWebRequest $request)
  {
    $this->getResponse()->setCookie('default', $request->getParameter('value'), '1 year');
    $this->getUser()->setFlash('info', 'Cookie enregistré');
  }

  protected function setStylesheet(sfWebRequest $request)
  {
    $this->getResponse()->setCookie('css', $request->getParameter('value'), '1 year');
    $this->getUser()->setFlash('info', 'Cookie enregistré');
  }

  

}
