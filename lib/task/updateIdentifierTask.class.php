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
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    $this->createConfiguration('frontend', 'dev');
    sfContext::createInstance($this->configuration);

    if(empty($this->nom_edt))
      throw new sfException("nom_edt can NOT be empty. Please configure the task !");

    // Get the ENSISA edt
    $this->edt = Doctrine_Query::create()
      ->from('Edt e')
      ->where('e.nom = ?', $this->nom_edt)
      ->limit(1)
      ->execute()->getFirst();
    
    if(!$this->edt)
      throw new sfException("Edt '".$this->nom_edt."' non trouvé");

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

    // Emulates query for display an arbitrary image
    // Select Project with a POST
    $browser->getUrl($this->edt->getAdeUrl().'standard/gui/interface.jsp', 'projectId='.$this->edt->getAdeProjectId().'&x=41&y=9');

    foreach($this->urls as $url)
    {
      $this->logSection('identifier', $this->edt->getAdeUrl().$url);
      $browser->getUrl($this->edt->getAdeUrl().$url);
    }

    $this->logSection('identifier', "Get the page with the image");
    // Get the page with the link to the image
    $imagemap = $browser->getUrl($this->edt->getAdeUrl().'custom/modules/plannings/imagemap.jsp?width=1306&height=315');

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

    $this->edt->setIdentifier($identifier);
    $this->edt->save();
    $this->logSection('update', "Identifier updated successfully : '$identifier'");
  }
}
