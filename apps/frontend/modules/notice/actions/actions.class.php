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
    $semaine = $request->getParameter('semaine', AdeTools::getSemaineNumber());
    $filiere = $request->getParameter('filiere');
    $promo = $request->getParameter('promo');

    $adeImage = new AdeImage(
            array(array('filiere' => $filiere, 'promo' =>  $promo)),
            array('idPianoWeek' => $semaine)
    );

    $this->notice = $adeImage->getNotice();
    $this->promo = $promo;
    $this->filiere = $filiere;
    $this->semaine = $semaine;
    $this->image_path = $adeImage->getWebPath();
    // Timestamp du lundi, début de semaine
    $this->timestamp = AdeTools::getTimestamp($this->semaine);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $semaine = $request->getParameter('semaine', AdeTools::getSemaineNumber());
    $filiere = $request->getParameter('filiere');
    $promo = $request->getParameter('promo');

    $adeImage = new AdeImage(
            array(array('filiere' => $filiere, 'promo' =>  $promo)),
            array('idPianoWeek' => $semaine)
    );

    $this->notice = $adeImage->getNotice();
    $this->promo = $promo;
    $this->filiere = $filiere;
    $this->semaine = $semaine;
    $this->image_path = $adeImage->getWebPath();

  }
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $semaine = $request->getParameter('semaine', AdeTools::getSemaineNumber());
    $filiere = $request->getParameter('filiere');
    $promo = $request->getParameter('promo');

    $adeImage = new AdeImage(
            array(array('filiere' => $filiere, 'promo' =>  $promo)),
            array('idPianoWeek' => $semaine)
    );
    $adeImage->setNotice($request->getParameter('notice'));
    $this->redirect('notice/show?promo='.$promo.'&filiere='.$filiere.'&semaine='.$semaine);
  }


}
