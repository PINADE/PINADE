<?php

class optipngTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'pinade';
    $this->name             = 'optipng';
    $this->briefDescription = 'update the identifier for an Adeserver';
    $this->detailedDescription = "";

    $this->addArgument('edt', sfCommandArgument::REQUIRED, 'Indique l\'emploi du temps à optimiser');

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

    $this->logSection('optipng', "Optimisation des fichiers GIFs");

    foreach($promotions as $promotion)
    {
      $this->logSection('optipng', "Promotion $promotion");

      $path = $promotion->getPath();
      if(!is_dir($path)) continue;
      chdir($path);
      $files = scandir($path);
      foreach($files as $file)
      {
        // Si le fichier n'est pas un dossier ou ne finit pas par ".gif", on le passe
        if(is_dir($file) || strpos($file, ".gif") === false) continue;
        $pngfile = preg_replace('@\.gif$@', '.png', $file);

        // On supprime le fichier PNG
        if(file_exists($pngfile))
          unlink($pngfile);

        // On optimise le fichier GIF
        exec("optipng -o99 ".escapeshellarg($file), $output, $return_var);

        if($return_var == 0)
          $this->logSection('optipng', $file." optimisé");
        else
          $this->logSection('optipng', 'Problème avec '.$file.' : '.print_r($output,1));
      }
    }
  }
}