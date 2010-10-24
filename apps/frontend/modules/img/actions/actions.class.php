<?php

/**
 * edt actions.
 *
 * @package    edt
 * @subpackage img
 * @author     T. Helleboid <t.helleboid@iariss.fr>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class imgActions extends sfActions
{

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

  /**
    Display details aout the gif of the week
  */
  public function executeDetails(sfWebRequest $request)
  {
    $filiere = $request->getParameter('filiere');
    $promo = $request->getParameter('promo');
    
    $semaine = intval($request->getParameter('semaine', AdeTools::getSemaineNumber()));

    $adeImage = new AdeImage(
      array(array('filiere' => $filiere, 'promo' => $promo )),
      array('idPianoWeek' => $semaine)
    );

    $filepath = sfConfig::get('sf_web_dir').$adeImage->getWebPath();

    $this->filiere = $filiere;
    $this->promo = $promo;
    $this->semaine = $semaine;
    $this->img_filepath = $filepath;
    $this->ical_filepath = $adeImage->getIcalPath();
    $this->notice = $adeImage->getNotice();

    if(file_exists($this->img_filepath))
      $this->img_mtime = filemtime($this->img_filepath);
    else
      $this->img_mtime = 0;

    if(file_exists($this->ical_filepath))
      $this->ical_mtime = filemtime($this->ical_filepath);
    else
      $this->ical_mtime = 0;
    
  }

}
