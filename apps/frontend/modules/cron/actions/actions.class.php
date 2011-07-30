<?php

/**
 * edt actions.
 *
 * @package    edt
 * @subpackage cron
 * @author     IARISS <contact@iariss.fr> T. Helleboid, M. Muré
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cronActions extends sfActions
{
  public function executeAll(sfWebRequest $request)
  {

    if (!($request->getParameter('debug') == '1'
      || in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))
      || gethostbyaddr($_SERVER['REMOTE_ADDR']) == "iariss")
    )
    {
      $this->redirect('@homepage');
    }
    
    $promotions = Doctrine_Core::getTable('Promotion')
      ->createQuery('f')
      ->execute();

    $message = "";
    // Pour chaque promo
    foreach($promotions as $promotion)
    {
      $semaine_actuelle = $promotion->getAdeWeekNumber();
      // Pour la semaine en cours et la suivante
      foreach(array($semaine_actuelle, $semaine_actuelle +1) as $semaine)
      {
        // On crée une image ADE, qu'on met à jour en forçant l'update
        $adeImage = new AdeImage($promotion, $semaine);
        $adeImage->updateImage(true);
        $message .= '- '.$promotion->getCategorie().', '.$promotion.", semaine $semaine mis à jour\n";
      }
    }
    $this->message = $message;
  }

  public function executeIcal(sfWebRequest $request)
  {

    if (!($request->getParameter('debug') == '1'
      || in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))
      || gethostbyaddr($_SERVER['REMOTE_ADDR']) == "iariss")
    )
    {
      $this->redirect('@homepage');
    }
    
    $promotions = Doctrine_Core::getTable('Promotion')
      ->createQuery('p')
      ->where("p.branch_id != ''")
      ->execute();


    $message = "";

    // Pour chaque promo  de chaque semaine
    foreach($promotions as $promotion)
    {
      // On crée une image ADE, qu'on met à jour en forçant l'update
      $adeImage = new AdeImage($promotion, $promotion->getAdeWeekNumber());

      $adeImage->updateHtml();
      $adeImage->updateIcal();
      $message .= '- '.$promotion->getCategorie().', '.$promotion." mis à jour\n";
    }

    $this->message = $message;
    $this->setTemplate('all');
  }

  /**
    Change ade_identifier in the settings.yml
    Be careful : it's extremly dangerous !

    The identifier changes every monday, at 00h00
  */
  public function executeIdentifier(sfWebRequest $request)
  {
    if (!($request->getParameter('debug') == '1'
      || in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))
      || gethostbyaddr($_SERVER['REMOTE_ADDR']) == "iariss")
    )
    {
      $this->redirect('@homepage');
    }


  }

  protected function clearCache()
  {
    //Clear cache
    $cache = new sfFileCache(array('cache_dir' => sfConfig::get('sf_app_cache_dir')));
    $cache->clean();
  }
}
