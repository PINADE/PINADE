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
    $filieres = sfConfig::get('sf_filieres');
    $this->filiere = $request->getParameter('filiere');
    if(isset($filieres[$this->filiere]['nom']))
      $this->nom_filiere = $filieres[$this->filiere]['nom'];
    else
      throw new sfError404Exception('La filière '.$this->filiere.' n\'existe pas');
  }
  
  public function executeImage(sfWebRequest $request)
  {
    $filieres = sfConfig::get('sf_filieres');
    $this->filiere = $request->getParameter('filiere');
    $this->promo = $request->getParameter('promo');
    
    $this->nom_filiere = $filieres[$this->filiere]['nom'];
    $this->nom_promo = $filieres[$this->filiere]['promotions'][$this->promo]['nom'];

    $semaine = intval($request->getParameter('semaine', AdeTools::getSemaineNumber()));

    $this->semaine = $semaine;
    $this->semaine_suivante = $semaine + 1;
    // Pas de semaine négative !
    $this->semaine_precedente = max(0,$semaine - 1);


    $this->adeImage = new AdeImage(
      array(array('filiere' => $this->filiere, 'promo' => $this->promo )),
      array('idPianoWeek' => $semaine)
    );

    $this->image_path = $this->adeImage->getWebPath();

    // Timestamp du lundi, début de semaine
    $this->timestamp = AdeTools::getTimestamp($this->semaine);
  }

  /**
    Display the gif of the week
  */
  public function executeImg(sfWebRequest $request)
  {
    $filiere = $request->getParameter('filiere');
    $promo = $request->getParameter('promo');
    
    $semaine = intval($request->getParameter('semaine', AdeTools::getSemaineNumber()));

    $adeImage = new AdeImage(
      array(array('filiere' => $filiere, 'promo' => $promo )),
      array('idPianoWeek' => $semaine)
    );
    $adeImage->updateImage();

    $filepath = sfConfig::get('sf_web_dir').$adeImage->getWebPath();

    // Set content and exit
    $this->getResponse()->setContentType('image/gif');
    $this->getResponse()->setHttpHeader('Content-Length', filesize($filepath));
    $this->getResponse()->setHttpHeader('Last-Modified', gmdate('D, d M Y H:i:s', filemtime($filepath)).' GMT');
    // The image can be cached by proxy and browser's cache, during at most 3600 seconds
    $this->getResponse()->addCacheControlHttpHeader('public');
    $this->getResponse()->addCacheControlHttpHeader('max-age', '3600');
    // Debug info
    if(strlen($adeImage->getError()))
      $this->getResponse()->setHttpHeader('X-Edt-error', $adeImage->getError());
    // Send content
    $this->getResponse()->setContent(file_get_contents($filepath));

    // Send only the content without the layout
    return sfView::NONE;
    
    // If you want to debug, comment the previous line and uncomment the following
    // $this->setTemplate('index');
  }

  public function executeError404(sfWebRequest $request)
  {

  }

  public function executeFaq(sfWebRequest $request)
  {
  }
}
