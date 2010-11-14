<?php

/**
 * edt actions.
 *
 * @package    edt
 * @subpackage offline
 * @author     T. Helleboid <t.helleboid@iariss.fr>
 * see : http://diveintohtml5.org/offline.html
 */
class offlineActions extends sfActions
{
 /**
  * Executes manifest action
  *
  * @param sfRequest $request A request object
  */
  public function executeManifest(sfWebRequest $request)
  {
    $cookie = $request->getCookie('offline');
    $this->forward404Unless(($cookie == "enabled"));

    $filiere = $request->getParameter('filiere');
    $promo = $request->getParameter('promo');
    $semaine = intval($request->getParameter('semaine', AdeTools::getSemaineNumber()));

    // Check if it exists really
    $adeImage = new AdeImage(
      array(array('filiere' => $filiere, 'promo' => $promo )),
      array('idPianoWeek' => $semaine)
    );

    // Disable layout, it's a plain text file
    $this->setLayout(false);
    $this->getResponse()->setContentType('text/cache-manifest');

    $this->filiere = $filiere;
    $this->promo = $promo;
    $this->semaine = $semaine;
    $this->adeImage = $adeImage;

    $this->filieres = array_keys(sfConfig::get('sf_filieres'));
    $this->stylesheets = print_r($this->getResponse()->getStylesheets(),1);

  }

  public function executeEnable(sfWebRequest $request)
  {
    $this->getResponse()->setCookie('offline', 'enabled', '1 year');
    $this->getUser()->setFlash('info', 'Cookie enregistré');
    $this->redirect('/?offline=on');
  }
  /**
    Disable the offline cookie 
  */
  public function executeDisable(sfWebRequest $request)
  {
    $this->getResponse()->setCookie('offline', '', 'yesterday');
    $this->getUser()->setFlash('info', 'Cookie offline effacé');
    $this->redirect('/?offline=off');
  }
}
