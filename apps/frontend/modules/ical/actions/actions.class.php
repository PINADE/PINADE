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
    Display the iCal
  */
  public function executeIcal(sfWebRequest $request)
  {
    $this->promotion = Doctrine_Core::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Categorie c')
      ->andwhere('p.url = ? AND c.url = ?', array($request->getParameter('promo'),  $request->getParameter('categorie')))
      ->execute()
      ->getFirst();
    $this->forward404Unless($this->promotion, "Pas de promotion trouvée");


    $filepath = $this->promotion->getIcalPath();

    $this->getResponse()->setContentType('text/calendar');

    // Set infos about the iCal file
    $this->getResponse()->setHttpHeader('Content-Length', filesize($filepath));
    $this->getResponse()->setHttpHeader('Last-Modified', gmdate('D, d M Y H:i:s', filemtime($filepath)).' GMT');

    // Send content
    $this->getResponse()->setContent(file_get_contents($filepath));

    // Send only the content without the layout
    return sfView::NONE;
  }
}
