<?php

/**
 * edt actions.
 *
 * @package    edt
 * @subpackage cron
 * @author     IARISS <contact@iariss.fr> T. Helleboid, M. Muré
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class noticeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->promotion = Doctrine_Core::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Categorie c')
      ->where('p.url = ? AND c.url = ?', array($request->getParameter('promo'),  $request->getParameter('categorie')))
      ->execute()
      ->getFirst();
    $this->forward404Unless($this->promotion);

    $this->categorie = $this->promotion->getCategorie();

    $semaine = $this->promotion->getAdeWeekNumber($request->getParameter('semaine'));

    $this->semaine = $semaine;
    $this->semaine_suivante = $semaine + 1;
    // Pas de semaine négative !
    $this->semaine_precedente = max(0,$semaine - 1);


    $this->adeImage = new AdeImage($this->promotion, $this->semaine);

    $this->image_path = sfConfig::get('sf_web_dir').$this->adeImage->getWebPath();
    if(file_exists($this->image_path))
      $this->image_mtime = filemtime($this->image_path);
    else
      $this->adeImage->updateImage();

    $this->diff_day = (time() - $this->image_mtime)/(60*60*24);

    // Timestamp du lundi, début de semaine
    $this->timestamp = $this->promotion->getTimestamp($this->semaine);
    // Notice
    $this->notice = $this->promotion->getWeekMessage($this->semaine);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->promotion = Doctrine_Core::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Categorie c')
      ->where('p.url = ? AND c.url = ?', array($request->getParameter('promo'),  $request->getParameter('categorie')))
      ->execute()
      ->getFirst();
    $this->forward404Unless($this->promotion);

    $semaine = $this->promotion->getAdeWeekNumber($request->getParameter('semaine'));
    $this->semaine = $semaine;

    // Notice
    $this->notice = $this->promotion->getWeekMessage($this->semaine);


    $this->timestamp = $this->promotion->getTimestamp($this->semaine);

  }
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $promotion = Doctrine_Core::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Categorie c')
      ->where('p.url = ? AND c.url = ?', array($request->getParameter('promo'),  $request->getParameter('categorie')))
      ->execute()
      ->getFirst();
    $this->forward404Unless($promotion);

    $semaine = $promotion->getAdeWeekNumber($request->getParameter('semaine'));
    $texte   = $request->getParameter('message');

    if($message = $promotion->getWeekMessage($semaine)) {
      // Un message existe déjà, on le met à jour
      if(strlen($texte) > 0)
      {
	$message->setTexte($texte);
	$message->save();
      }
      else
      {
	$message->delete();
      }
    }
    elseif(strlen($texte) > 0) // on ne crée le message que s'il y a du texte
    {
      // On crée le message dans la base :
      $message = new Message();
      $message->setTexte($request->getParameter('message'));
      $message->setPromotionId($promotion->getId());
      $message->setSemaine($semaine);
      $message->save();
    }

    $this->redirect("@notice?action=show&promo=".$promotion->getUrl()."&categorie=".$promotion->getCategorie()->getUrl()."&semaine=$semaine");
  }


}
