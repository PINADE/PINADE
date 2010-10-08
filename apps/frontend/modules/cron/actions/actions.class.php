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

    if (!($request->getParameter('debug') == '1' || in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))))
    {
      $this->redirect('@homepage');
    }
    
    $filieres = sfConfig::get('sf_filieres');
    $semaine = AdeTools::getSemaineNumber();
    $adeImage = new AdeImage();

    $message = "";
    // Pour la semaine en cours et la suivante
    foreach(array($semaine, $semaine +1) as $semaine)
    {
      // Pour chaque filière de chaque semaine
      foreach($filieres as $id_f => $filiere)
      {
        // Et pour chaque promo de chaque filiere de chaque semaine
        foreach($filiere['promotions'] as $id_p => $promotion)
        {
          // On crée une image ADE, qu'on met à jour en forçant l'update
          $adeImage->initialize(
            array(array('filiere' => $id_f, 'promo' => $id_p )),
            array('idPianoWeek' => $semaine)
          );
          $adeImage->updateImage(true);
          $message .= '- '.$filiere['nom'].', '.$promotion['nom'].", semaine $semaine mis à jour\n";
        }
      }
    }
    $this->message = $message;
  }
  /**
    Change ade_identifier in the settings.yml
    Be careful : it's extremly dangerous !

    The identifier changes every monday, at 00h00
  */
  public function executeIdentifier(sfWebRequest $request)
  {
    if (!($request->getParameter('debug') == '1' || in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))))
    {
      $this->redirect('@homepage');
    }

    $browser = new AdeBrowser();

    // Emulates query for display an arbitrary image
    // Select Project
    $browser->getUrl('http://www.emploidutemps.uha.fr/ade/standard/gui/interface.jsp', 'projectId='.sfConfig::get('sf_ade_project_id').'&x=41&y=9');
    // Mandatory (because of ADE)
    $browser->getUrl('http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/plannings.jsp');
    // Select groups of students
    $browser->getUrl('http://www.emploidutemps.uha.fr/ade/standard/gui/tree.jsp?category=trainee&expand=false&forceLoad=false&reload=false&scroll=0');
    // Select a group (ENSISA Lumiere)
    $browser->getUrl('http://www.emploidutemps.uha.fr/ade/standard/gui/tree.jsp?branchId=199&reset=true&forceLoad=false&scroll=0');
    // Select a group (FIP)
    $browser->getUrl('http://www.emploidutemps.uha.fr/ade/standard/gui/tree.jsp?branchId=190&reset=false&forceLoad=false&scroll=0');
    // "Click" on a group (1A FIP)
    $browser->getUrl('http://www.emploidutemps.uha.fr/ade/standard/gui/tree.jsp?selectBranchId=16&reset=true&forceLoad=false&scroll=0');
    // Get the page with the link to the image
    $imagemap = $browser->getUrl('http://www.emploidutemps.uha.fr/ade/custom/modules/plannings/imagemap.jsp?width=1306&height=315');

    // Get the identifier 
    preg_match("@identifier=([0-9a-f]{32})@", $imagemap, $matches);
    if(count($matches)) // If the identifier is found
    {
      $identifier = $matches[1];
      $this->identifier = $identifier;

      // Open the settings.yml, change the identifier, and rewrite it
      // Be careful : the number of spaces before ade_identifier is important
      $ade_config = file_get_contents(sfConfig::get('sf_app_config_dir').'/settings.yml');
      $ade_config = preg_replace(
        '@\s+ade_identifier:\s+\'[0-9a-f]{32}\'@',
        "\n    ade_identifier:  '".$identifier."'",
        $ade_config);
      file_put_contents(sfConfig::get('sf_app_config_dir').'/settings.yml', $ade_config);
    }
    else
    {
      $this->identifier = "Identifier not found !";
    }
  }
}
