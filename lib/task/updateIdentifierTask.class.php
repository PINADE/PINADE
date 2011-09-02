<?php

abstract class updateIdentifierTask extends sfBaseTask
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
    $this->briefDescription = 'update the identifier for an Adeserver';
    $this->detailedDescription = "";

  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    $this->createConfiguration('frontend', 'dev');
    sfContext::createInstance($this->configuration);

    if(empty($this->ade_server_name))
      throw new sfException("ade_server_name can NOT be empty. Please configure the task !");

    $this->ade_server = Doctrine::getTable('Adeserver')
      ->createQuery('a')
      ->addWhere('a.nom = ?', $this->ade_server_name)
      ->execute()
      ->getFirst();

    if(!$this->ade_server)
      throw new Exception("Adeserver ".$this->ade_server_name." non trouvé !");


    $this->getAuthentication();
    $identifier = $this->getIdentifier();
    $this->updateIdentifier($identifier);
  }

  protected function getAuthentication()
  {
    throw new sfException("Vous devez personnaliser la méthode getAuthentification()");
  }

  protected function getIdentifier()
  {
    $this->logSection('identifier', "start Identifier");
    $browser = new AdeBrowser();

    try {
      $this->logSection('identifier', $this->ade_server->getAdeUrl().'standard/projects.jsp');
      $browser->getUrl($this->ade_server->getAdeUrl().'standard/projects.jsp');
   }
   catch(sfAdeRedirectionException $e)
   {
      $this->logSection('identifier', "Redirection détectée : ".$e );
   }

    $this->logSection('identifier', "POST projectId : ".$this->ade_server->getLoginAdeProjectId());
    // Emulates query for display an arbitrary image
    // Select Project with a POST
    $browser->getUrl($this->ade_server->getAdeUrl().'standard/gui/interface.jsp', 'projectId='.$this->ade_server->getLoginAdeProjectId().'&x=41&y=9');

    foreach($this->urls as $url)
    {
      $this->logSection('identifier', $this->ade_server->getAdeUrl().$url);
      $browser->getUrl($this->ade_server->getAdeUrl().$url);
    }

    $this->logSection('identifier', "Get the page with the image");
    // Get the page with the link to the image
    $imagemap = $browser->getUrl($this->ade_server->getAdeUrl().'custom/modules/plannings/imagemap.jsp?width=1306&height=315');

    // Get the identifier 
    preg_match("@identifier=([0-9a-f]{32})@", $imagemap, $matches);
    if(count($matches)) // If the identifier is found
    {
      $identifier = $matches[1];
      $this->logSection('identifier', "identifier trouvé : '$identifier'");
      return $identifier;
    }
    else
    {
      $this->logSection('identifier', "PINADE a tenté d'obtenir un nouvel identifier ADE mais a échoué."
        ." Les images ne seront plus mises à jour.");
      $this->logSection('identifier', "Pour réparer le code source, rendez-vous dans ".__FILE__);
      throw new sfAdeException("Identifier non trouvé !");
    }
  }

  protected function updateIdentifier($identifier)
  {
    $this->logSection('update', "Update the ADE Identifier : '$identifier'");

    if(empty($identifier))
      throw new sfException("identifier is empty !");

    $this->ade_server->setIdentifier($identifier);
    $this->ade_server->save();
    $this->logSection('update', "Identifier updated successfully : '$identifier'");
  }
}
