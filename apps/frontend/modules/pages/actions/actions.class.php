<?php

/**
 * pages actions.
 *
 * @package    edt
 * @subpackage pages
 * @author     Théophile Helleboid
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pagesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->page = Doctrine::getTable('Page')
      ->createQuery('p')
      ->where('p.url = ?', array($request->getParameter('url')))
      ->execute()
      ->getFirst();


    $this->forward404Unless( $this->page, sprintf('Object page does not exist with this url (%s).', $request->getParameter('url')));

  }
}
