<?php

/**
 * edt actions.
 *
 * @package    edt
 * @subpackage ical
 * @author     T. Helleboid <t.helleboid@iariss.fr>
 */
class icalActions extends sfActions
{

  /**
    Display the gif of the week
  */
  public function executeUpdate(sfWebRequest $request)
  {
    $filiere = $request->getParameter('filiere');
    $promo = $request->getParameter('promo');
    
    $semaine = intval($request->getParameter('semaine', AdeTools::getSemaineNumber()));

    $adeImage = new AdeImage(
      array(array('filiere' => $filiere, 'promo' => $promo )),
      array('idPianoWeek' => $semaine)
    );
    $adeImage->updateHtml();
    $adeImage->updateIcal();
    $this->path = $adeImage->getPath().'info.html';
  }
  /**
    Display the gif of the week
  */
  public function executeIcal(sfWebRequest $request)
  {
    $filiere = $request->getParameter('filiere');
    $promo = $request->getParameter('promo');
    
    $semaine = intval($request->getParameter('semaine', AdeTools::getSemaineNumber()));

    $adeImage = new AdeImage(
      array(array('filiere' => $filiere, 'promo' => $promo )),
      array('idPianoWeek' => $semaine)
    );
    $filepath = $adeImage->getPath().'ical.ics';
//    $this->setLayout(false);
    $this->getResponse()->setContentType('text/plain');

    // Set content and exit
    $this->getResponse()->setHttpHeader('Content-Length', filesize($filepath));
//    $this->getResponse()->setHttpHeader('Last-Modified', gmdate('D, d M Y H:i:s', filemtime($filepath)).' GMT');
    // The image can be cached by proxy and browser's cache, during at most 3600 seconds
//    $this->getResponse()->addCacheControlHttpHeader('public');
//    $this->getResponse()->addCacheControlHttpHeader('max-age', '3600');

    // Send content
    $this->getResponse()->setContent(file_get_contents($filepath));

    // Send only the content without the layout
    return sfView::NONE;
  }
}