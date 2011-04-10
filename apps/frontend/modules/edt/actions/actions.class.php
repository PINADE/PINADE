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
    // On récupère le cookie et on redirige s'il existe
    // default=<filiere>/<promo>
    $default = $request->getCookie('default');
    if(! empty($default))
    {
      $array = explode('-', $default);
      if(count($array) == 2)
      {
        $filiere = $array[0];
        $promo = $array[1];
        $promotion = Doctrine_Core::getTable('Promotion')
              ->createQuery('p')
              ->leftJoin('p.Filiere f')
              ->where('p.url = ? AND f.url = ?', array($promo, $filiere))
              ->execute();

        // On vérifie si la promo existe bien, pour éviter les farces
        // et les redirections infinies (cookie mis à "/" par exemple
        if($promotion->count())
          $this->redirect("@image?filiere=$filiere&promo=$promo&semaine=");
      }
    }
    // Si on n'a pas redirigé, pas de cookie ou cookie erroné, on affiche la liste des filières
    $this->filieres = Doctrine_Core::getTable('Filiere')
      ->createQuery('f')
      ->execute();
  }

  public function executeIndexPromo(sfWebRequest $request)
  {
    $this->filiere = Doctrine_Core::getTable('Filiere')
      ->createQuery('f')
      ->leftJoin('f.Promotions p')
      ->where('f.url = ?', array($request->getParameter('filiere')))
      ->orderBy('p.weight ASC')
      ->execute()
      ->getFirst();

    $this->forward404Unless( $this->filiere, sprintf('Object filiere does not exist (%s).', $request->getParameter('filiere')));

  }
  
  public function executeImage(sfWebRequest $request)
  {
    $this->promotion = Doctrine_Core::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Filiere f')
      ->where('p.url = ? AND f.url = ?', array($request->getParameter('promo'),  $request->getParameter('filiere')))
      ->execute()
      ->getFirst();
    $this->forward404Unless($this->promotion);

    $this->filiere = $this->promotion->getFiliere();

    $semaine = intval($request->getParameter('semaine', AdeTools::getSemaineNumber()));

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
    $this->timestamp = AdeTools::getTimestamp($this->semaine);
    // Notice
    $this->notice = $this->promotion->getWeekMessage($this->semaine);
  }

  public function executeError404(sfWebRequest $request)
  {

  }

  public function executeFaq(sfWebRequest $request)
  {
  }

}
