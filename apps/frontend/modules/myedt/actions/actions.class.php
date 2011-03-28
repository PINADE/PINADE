<?php

/**
 * myedt actions.
 *
 * @package    edt
 * @subpackage myedt
 * @author     Théophile Helleboid, Michael Muré <contact@iariss.fr>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myedtActions extends sfActions
{

  public function executeImport(sfWebRequest $request)
  {}

  public function executeCreateFromImport(sfWebRequest $request)
  {
    // projectId=19
    // idPianoWeek=31
    // idPianoDay=0,1,2,3,4
    // idTree=147,148,149,113,116,117,118
    $url = urldecode($request->getParameter('url'));
    $patterns = array(
      'projectId'   => "@projectId=([\d]+)&@",
      'idPianoWeek' => "@idPianoWeek=([\d]+)&@",
      'idPianoDay'  => "@idPianoDay=([\d,]+)&@",
      'idTree'      => "@idTree=([\d,]+)&@",
    );
    
    foreach($patterns as $id => $pattern)
    {
      if(preg_match($pattern, $url, $matches[$id]) == 0)
      {
        $request->setParameter('erreur', "Problème dans l'URL de l'image ($id incorrect/non trouvé)");
        $this->forward('myedt', 'import');
      }
    }

    $projectId = $matches['projectId'][1];
    $idPianoWeek = $matches['idPianoWeek'][1];
    $idPianoDay = $matches['idPianoDay'][1];
    $idTree = $matches['idTree'][1];
    $nom = $request->getParameter('nom');

    if($request->getParameter('nom') == "" || (preg_match("@^[0-9a-zA-Z\-_]+$@", $nom, $dummy) == 0))
    {
      $request->setParameter('erreur', "Nom vide ou avec des caractères invalides !");
      $this->forward('myedt', 'import');
    }


    $filiere = Doctrine_Core::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Filiere f')
      ->where('f.url = "perso"')
      ->andWhere('p.url = ?', array($nom))
      ->execute();

    if($filiere->count() > 0)
    {
      $request->setParameter('erreur', "Nom déjà pris, choisissez en un autre !");
      $this->forward('myedt', 'import');
    }


    $filiere = Doctrine_Core::getTable('Filiere')
      ->createQuery('f')
      ->where('f.url = "perso"')
      ->execute()->getFirst();

    if(!$filiere)
    {
      $request->setParameter('erreur', "Erreur de l'administrateur. La filière 'perso' n'existe pas !");
      $this->forward('myedt', 'import');
    }

    $promotion = new Promotion();
    $promotion->setProjectId($projectId);
    // $promotion->setIdPianoWeek($idPianoWeek);
    $promotion->setIdPianoDay($idPianoDay);
    $promotion->setIdTree($idTree);
    $promotion->setFiliereId($filiere->getId());
    $promotion->setNom($nom);
    $promotion->setUrl($nom);
    $promotion->save();

    $this->redirect('@image?filiere=perso&promo='.$request->getParameter('nom').'&semaine=');

   // https://www.emploisdutemps.uha.fr/ade/imageEt?&&&width=800&height=600&lunchName=REPAS&displayMode=1057855&showLoad=false&ttl=1283427991552&displayConfId=8

  }

}
