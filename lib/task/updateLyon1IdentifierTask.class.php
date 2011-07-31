<?php

abstract class updateLyon1IdentifierTask extends updateIdentifierTask
{
  protected function configure()
  {
    // Configuration de la tâche
    // urls  : la séquence à enchaîner pour dérouler et cliquer sur un emploi du temps
    // nom_edt : nom de l'Edt dans la BDD
    $this->urls = array(
      'custom/modules/plannings/plannings.jsp', // Mandatory (because of ADE)
      'standard/gui/tree.jsp?category=trainee&expand=false&forceLoad=false&reload=false&scroll=0', // Select groups of students
      'standard/gui/tree.jsp?branchId=4339&reset=true&forceLoad=false&scroll=0', // Select a group (AUP-DU-DAEU-DEUST)
      'standard/gui/tree.jsp?branchId=6037&reset=false&forceLoad=false&scroll=0', // Select a group (AUP)
      'standard/gui/tree.jsp?selectId=9617&reset=true&forceLoad=false&scroll=0', // "Click" on a group (3A Info S5)
    );
    parent::configure();

  }



  protected function getAuthentication()
  {
    $this->logSection('auth', 'start Authentification');
    /* Get CAS Cookie and link to adeweb.univ-lyon1.fr */
    $data_string = base64_decode($this->edt->getLogin())."&x=33&y=10";
    $handle = curl_init($url = "http://adeweb.univ-lyon1.fr/ade/standard/gui/interface.jsp?top=top");
    curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); 
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); /* curl does not like the ss cert. of uha.fr */
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2.7) Gecko/20100701 Firefox/3.6.7 chtitux@chtitux.org");
    curl_setopt($handle, CURLOPT_REFERER, "http://adeweb.univ-lyon1.fr/ade/standard/index.jsp");
    curl_setopt($handle, CURLOPT_HEADER, true);
    curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);

    // Use a file to stock the cookies
    // You do not need old cookies when you start a new authentification
    curl_setopt($handle, CURLOPT_COOKIEJAR, sfConfig::get('app_ade_cookiefile'));

    $this->logSection('auth', "Get $url");
    $content = curl_exec($handle);
    curl_close($handle); // cURL write cookies in the Cookies Jar file

    $this->logSection('auth', "Fichier des cookies :\n".file_get_contents(sfConfig::get('app_ade_cookiefile')));
  }

}
