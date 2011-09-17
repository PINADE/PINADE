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

  public function executeSitemap(sfWebRequest $request)
  {
    $this->categories = Doctrine::getTable('Categorie')
      ->createQuery('c')
      ->leftJoin('c.Promotions p')
      ->execute();
    $this->getResponse()->setContentType('application/xml');
    $this->setLayout(false);
  }

  public function executeRobotstxt(sfWebRequest $request)
  {
    $this->setLayout(false);
    $this->getResponse()->setContentType('text/plain');
  }

  public function executeMessage(sfWebRequest $request)
  {
    $this->feedback = ($request->getParameter("sent") == "1") ? "Votre message a bien été envoyé" : "";
  }

  public function executeMessageprocess(sfWebRequest $request)
  {
    $email = $request->getParameter('email');
    $name  = $request->getParameter('name');
    $subject  = $request->getParameter('subject');
    $content = $request->getParameter('content');
    $cookie = print_r($_COOKIE, 1);
    $server = $_SERVER['SERVER_NAME'];
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    $date = strftime("%c");
    $ip = $_SERVER['REMOTE_ADDR'];
    $hostname = gethostbyaddr($ip);


    $message = $this->getMailer()->compose(
      array("norepy@pinade.org" => $nom),
      sfConfig::get('app_email_to'),
      "[PINADE] $server : $subject",
      <<<EOF
Message de {$server}
Nom : {$name} ({$email})
Sujet : {$subject}
Date : {$date}
Message :
{$content}

Cookie : {$cookie}
User-Agent : {$_SERVER['HTTP_USER_AGENT']}
IP : {$hostname} ({$ip})
-- 
PINADE - {$_SERVER['SERVER_NAME']}
EOF
    );

    $this->getMailer()->send($message);

    $this->redirect('@message?sent=1');
  }

}
