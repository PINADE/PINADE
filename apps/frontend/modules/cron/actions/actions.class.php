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

    $semaine = AdeTools::getSemaineNumber();

    $message = "";
    // Pour la semaine en cours et la suivante
    foreach(array($semaine, $semaine +1) as $semaine)
    {
      // Pour chaque promo de chaque filiere de chaque semaine
      foreach($promotions as $promotion)
      {
        // On crée une image ADE, qu'on met à jour en forçant l'update
        $adeImage = new AdeImage($promotion, $semaine);
        $adeImage->updateImage(true);
        $message .= '- '.$promotion->getFiliere().', '.$promotion.", semaine $semaine mis à jour\n";
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
      ->createQuery('f')
      ->execute();

    $semaine = AdeTools::getSemaineNumber();

    $message = "";

    // Pour chaque promo de chaque filiere de chaque semaine
    foreach($promotions as $promotion)
    {
      // On crée une image ADE, qu'on met à jour en forçant l'update
      $adeImage = new AdeImage($promotion, $semaine);

      $adeImage->updateHtml();
      $adeImage->updateIcal();
      $message .= '- '.$promotion->getFiliere().', '.$promotion." mis à jour\n";
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

    $browser = new AdeBrowser();

    // Emulates query for display an arbitrary image
    // Select Project
    $browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/interface.jsp', 'projectId='.sfConfig::get('sf_ade_project_id').'&x=41&y=9');
    // Mandatory (because of ADE)
    $browser->getUrl(sfConfig::get('sf_ade_url').'custom/modules/plannings/plannings.jsp');
    // Select groups of students
    $browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/tree.jsp?category=trainee&expand=false&forceLoad=false&reload=false&scroll=0');
    // Select a group (ENSISA Lumiere)
    $browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/tree.jsp?branchId=199&reset=true&forceLoad=false&scroll=0');
    // Select a group (FIP)
    $browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/tree.jsp?branchId=190&reset=false&forceLoad=false&scroll=0');
    // "Click" on a group (1A FIP)
    $browser->getUrl(sfConfig::get('sf_ade_url').'standard/gui/tree.jsp?selectBranchId=16&reset=true&forceLoad=false&scroll=0');
    // Get the page with the link to the image
    $imagemap = $browser->getUrl(sfConfig::get('sf_ade_url').'custom/modules/plannings/imagemap.jsp?width=1306&height=315');

    // Get the identifier 
    preg_match("@identifier=([0-9a-f]{32})@", $imagemap, $matches);
    if(count($matches)) // If the identifier is found
    {
      $identifier = $matches[1];
      $this->identifier = $identifier;

      // Open the settings.yml, change the identifier, and rewrite it
      // Be careful : the number of spaces before ade_identifier is important
      $config_file = sfConfig::get('sf_plugins_dir').'/sfADEConfigPlugin/config/settings.yml';
      $ade_config = file_get_contents($config_file);
      $ade_config = preg_replace(
        '@\s+ade_identifier:\s+\'[0-9a-f]{32}\'@',
        "\n    ade_identifier:  '".$identifier."'",
        $ade_config);
      file_put_contents($config_file, $ade_config);

      // We clear the cache !
      $this->clearCache();
    }
    else
    {
      $this->identifier = "Identifier not found !";
      $this->imagemap = $imagemap;
      $this->getMailer()->composeAndSend(
        sfConfig::get('sf_email_from'),
        sfConfig::get('sf_email_to'),
        $_SERVER['SERVER_NAME'].' : identifier ADE non trouvé',
        $_SERVER['SERVER_NAME']." a tenté d'obtenir un nouvel identifier ADE mais a échoué. Les images ne seront plus mises à jour.
Pour réparer le code source, rendez-vous dans ".__FILE__."
Merci d'avance,
Amicalement
-- 
L'emploi du temps IARISS - ".$_SERVER['SERVER_NAME']
      );
    }
  }

  protected function clearCache()
  {
    //Clear cache
    $cache = new sfFileCache(array('cache_dir' => sfConfig::get('sf_app_cache_dir')));
    $cache->clean();
  }
}
