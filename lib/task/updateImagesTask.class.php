<?php

class updateImagesTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->name             = "images";
    $this->namespace        = 'pinade';
    $this->briefDescription = 'update the identifier for an Adeserver';
    $this->detailedDescription = "";
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


    $promotions = Doctrine::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Categorie c')
      ->leftJoin('c.Edt edt')
      ->addWhere('edt.nom = ?', $arguments["edt"])
      ->execute();

    foreach($promotions as $promotion)
    {
      $semaine_actuelle = $promotion->getAdeWeekNumber();
      // Pour la semaine en cours et la suivante
      foreach(array($semaine_actuelle, $semaine_actuelle +1) as $semaine)
      {
        // On crée une image ADE, qu'on met à jour en forçant l'update
        $adeImage = new AdeImage($promotion, $semaine);
        if($adeImage->updateImage(true))
          $this->logSection('image', $promotion->getCategorie().', '.$promotion.", semaine $semaine mis à jour");
        else
          $this->logSection('image', 'Echec de la mise à jour de '.$promotion->getCategorie().', '.$promotion.", semaine $semaine");

      }
    }
  }

}
