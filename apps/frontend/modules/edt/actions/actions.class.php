<?php

/**
 * edt actions.
 *
 * @package    edt
 * @subpackage edt
 * @author     T. Helleboid <t.helleboid@iariss.fr>, M.Muré <m.mure@iariss.fr>
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
    // default=<categorie>/<promo>
    $default = intval($request->getCookie('default'));
    if(! empty($default))
    {
      $promotion = Doctrine_Core::getTable('Promotion')->find($default);;

      // On vérifie si la promo existe bien, pour éviter les farces
      // et les redirections infinies (cookie mis à "/" par exemple
      if($promotion->count())
        $this->redirect("@image?categorie=".$promotion->getCategorie()->getUrl()."&promo=".$promotion->getUrl()."&semaine=");
    }

    // Si on n'a pas redirigé, pas de cookie ou cookie erroné, on affiche la liste des catégories
    $this->categories = Doctrine_Core::getTable('Categorie')
      ->createQuery('c')
      ->leftJoin('c.Promotions p')
      ->orderBy('p.weight ASC')
      ->execute();
  }

  public function executeIndexPromo(sfWebRequest $request)
  {
    $this->categorie = Doctrine_Core::getTable('Categorie')
      ->createQuery('c')
      ->leftJoin('c.Promotions p')
      ->andwhere('c.url = ?', array($request->getParameter('categorie')))
      ->orderBy('p.weight ASC')
      ->execute()
      ->getFirst();

    // Si la catégorie n'existe pas, c'est une page "statique". On forward vers le pages/show
    if(!$this->categorie)
    {
      $request->setParameter('url', $request->getParameter('categorie'));
      $this->forward('pages', 'show');
    }

  }
  
  public function executeImage(sfWebRequest $request)
  {
    $this->promotion = Doctrine_Core::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Categorie c')
      ->andwhere('p.url = ? AND c.url = ?', array($request->getParameter('promo'),  $request->getParameter('categorie')))
      ->execute()
      ->getFirst();
    $this->forward404Unless($this->promotion);

    $this->categorie = $this->promotion->getCategorie();

    $this->semaine = $this->promotion->getAdeWeekNumber($request->getParameter('semaine'));
    $this->semaine_suivante = $this->semaine + 1;
    // Pas de semaine négative !
    $this->semaine_precedente = max(0, $this->semaine - 1);


    $adeImage = new AdeImage($this->promotion, $this->semaine);

    $this->image_path = sfConfig::get('sf_web_dir').$adeImage->getWebPath();
    if(file_exists($this->image_path)) // L'image existe, elle se mettra à jour lors de sa propre requête
      $this->image_mtime = filemtime($this->image_path);
    else
    {
      $adeImage->updateImage();
      if(file_exists($this->image_path))
        $this->image_mtime = filemtime($this->image_path);
      else
        $this->forward404("L'image ".$this->image_path." n'existe pas. Échec probable du téléchargement");
      
    }
    $this->diff_day = (time() - $this->image_mtime)/(60*60*24);

    // SI l'image a plus de 1 jour, on ne cache pas pour éviter d'afficher le message "image non à jour"
    if($this->diff_day > 1)
      sfConfig::set('sf_cache', false);

    // Timestamp du lundi, début de semaine
    $this->timestamp = $this->promotion->getTimestamp($this->semaine);
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
