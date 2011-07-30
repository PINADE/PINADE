<?php

class updateUhaIdentifierTask extends updateIdentifierTask
{
  protected function configure()
  {
    parent::configure();

    // Configuration de la tâche
    // name  : doit être unique dans l'application
    // urls  : la séquence à enchaîner pour dérouler et cliquer sur un emploi du temps
    // nom_edt : nom de l'Edt dans la BDD

    $this->name             = 'identifier-uha';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [pinade:identifier-uha|INFO] task updates the ADE Identifier for the UHA.
Call it with:

  [php symfony pinade:identifier-uha|INFO]
EOF;

    $this->urls = array(
      'custom/modules/plannings/plannings.jsp', // Mandatory (because of ADE)
      'standard/gui/tree.jsp?category=trainee&expand=false&forceLoad=false&reload=false&scroll=0', // Select groups of students
      'standard/gui/tree.jsp?branchId=199&reset=true&forceLoad=false&scroll=0', // Select a group (ENSISA Lumiere)
      'standard/gui/tree.jsp?branchId=203&reset=false&forceLoad=false&scroll=0', // Select a group (Ingénieurs)
      'standard/gui/tree.jsp?branchId=143&reset=false&forceLoad=false&scroll=0', // Select a group (3A)
      'standard/gui/tree.jsp?selectBranchId=145&reset=true&forceLoad=false&scroll=0', // "Click" on a group (3A Info S5)
    );

    $this->nom_edt = "ensisa";
  }



  protected function getAuthentication()
  {
    $this->logSection('auth', 'start Authentification');

    /* Get lt for login */
    $this->logSection('auth', 'get "lt" parameter from cas.uha.fr ');
    $login_page = file_get_contents("https://cas.uha.fr/cas/login");
    $pattern = '@name="lt" value="([^"]+)" />@';
    preg_match($pattern, $login_page, $matches);
    $lt = $matches[1];

    $this->logSection('auth', "lt parameter got : $lt");

    /* Get CAS Cookie and link to emploidutemps.uha.fr */
    $data_string = base64_decode($this->edt->getLogin())."&lt=$lt";
    $handle = curl_init($url = "https://cas.uha.fr/cas/login?service=http://www.emploisdutemps.uha.fr:80/ade/standard/gui/interface.jsp");
    curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); 
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $data_string /* $data */);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); /* curl does not like the ss cert. of uha.fr */
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2.7) Gecko/20100701 Firefox/3.6.7 contact@iariss.fr");
    curl_setopt($handle, CURLOPT_REFERER, "https://cas.uha.fr/cas/login");
    curl_setopt($handle, CURLOPT_HEADER, true);

    // Use a file to stock the cookies
    // You do not need old cookies when you start a new authentification
    curl_setopt($handle, CURLOPT_COOKIEJAR, sfConfig::get('app_ade_cookiefile'));

    $this->logSection('auth', "get link for emploisdutemps.uha.fr");
    $content = curl_exec($handle);

    /* Get ticket */
    $pattern = '@window.location.href="([^"]+)@';
    preg_match($pattern, $content, $matches);
    $link_edt = $matches[1];

    $this->logSection('auth', 'got edt link : "'.$link_edt.'" ');

    if(empty($link_edt))
      throw new sfException('Pas de lien ade ('.$link_edt.')');

    // then, the ADE cookie
    $this->logSection('auth', 'get Ade Cookie');

    $handle = curl_init($link_edt);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2.7) Gecko/20100701 Firefox/3.6.7 contact@iariss.fr");
    curl_setopt($handle, CURLOPT_REFERER, "https://cas.uha.fr/cas/login");
    curl_setopt($handle, CURLOPT_HEADER, true);

    // Use a file to stock the cookies
    curl_setopt($handle, CURLOPT_COOKIEJAR,  sfConfig::get('app_ade_cookiefile'));
    curl_setopt($handle, CURLOPT_COOKIEFILE, sfConfig::get('app_ade_cookiefile'));

    curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);

    $this->logSection('auth', "Get $link_edt");
    $content = curl_exec($handle);
    curl_close($handle); // cURL write cookies in the Cookies Jar file

    $this->logSection('auth', "Fichier des cookies :\n".file_get_contents(sfConfig::get('app_ade_cookiefile')));
  }

}
