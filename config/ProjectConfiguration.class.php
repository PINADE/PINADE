<?php
setlocale(LC_ALL, 'fr_FR.utf8');
date_default_timezone_set('Europe/Paris');


require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfADEConfigPlugin');
  }
}
