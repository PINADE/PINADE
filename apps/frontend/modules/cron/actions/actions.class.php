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
    $filieres = sfConfig::get('sf_filieres');
    $semaine = AdeTools::getSemaineNumber();

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
          $adeImage = new AdeImage(
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
}