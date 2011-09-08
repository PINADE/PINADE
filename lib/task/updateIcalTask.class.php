<?php

class updateIcalTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->name             = "ical";
    $this->namespace        = 'pinade';
    $this->briefDescription = 'update the iCals for an Adeserver';
    $this->detailedDescription = "";
    $this->addArgument('adeserver', sfCommandArgument::REQUIRED, 'Indique le serveur à utiliser');
    $this->addArgument('edt', sfCommandArgument::REQUIRED, 'Indique l\'emploi du temps à mettre à jour');

  }

  protected function execute($arguments = array(), $options = array())
  {
    define("NOM_EDT", $arguments["edt"]);

    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    $this->createConfiguration('frontend', 'dev');
    sfContext::createInstance($this->configuration);

    $this->ade_server = Doctrine::getTable('Adeserver')
      ->createQuery('a')
      ->addWhere('a.nom = ?', $arguments["adeserver"])
      ->execute()
      ->getFirst();

    if(!$this->ade_server)
      throw new Exception("Adeserver ".$this->ade_server_name." non trouvé !");


    $promotions = Doctrine::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Categorie c')
      ->leftJoin('c.Edt edt')
      ->addWhere('edt.nom = ?', $arguments["edt"])
      ->execute();

    $ade_browser = new AdeBrowser($this->ade_server);

    foreach($promotions as $promotion)
    {
      $promotion->updateHtml($ade_browser);
      $promotion->updateIcal($ade_browser);
    }
  }

}
