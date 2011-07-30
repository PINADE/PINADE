<?php
/**
 * edt tools.
 *
 * @package    tools
 * @subpackage AdeBrowser
 * @author     T. Helleboid <t.helleboid@iariss.fr>, M.Muré <m.mure@iariss.fr>
 */

class AdeBrowser
{
  protected
    $ade_cookie,
    $cas_cookie,
    $ade_ticket,
    $curl_handle,
    $content;

  public function getUrl($url, $post_fields = null)
  {
    // If an sfAdeException is
    try {
      return $this->ProcessUrl($url, $post_fields);
    }
    catch(sfAdeException $e)
    {
      sfContext::getInstance()->getLogger()->info('Mauvais cookie ("'.$e->getMessage().'"). Tentative de renouvellement');
      $this->getAuthentication();

      return $this->ProcessUrl($url, $post_fields);

    }
  }

  protected function ProcessUrl($url, $post_fields)
  {
    $log_message = time().' Get link : "'.$url.'"';
    if(strlen($post_fields))
      $log_message .= " POST : \"$post_fields\"";

    sfContext::getInstance()->getLogger()->info($log_message);
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2.7) Gecko/20100701 Firefox/3.6.7 contact@iariss.fr");
    curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);

    // Use a file to stock the cookies
    // Do not allow to modify cookies here, because it does not work if you do
    curl_setopt($handle, CURLOPT_COOKIEFILE, sfConfig::get('app_ade_cookiefile'));


    if(strlen($post_fields))
    {
      curl_setopt($handle, CURLOPT_POST, true);
      curl_setopt($handle, CURLOPT_POSTFIELDS, $post_fields);
    }

    $this->content = curl_exec($handle);
    $this->curl_handle = $handle;

    if(curl_getinfo($handle, CURLINFO_EFFECTIVE_URL) != $url)
    {
      // Le cookie n'est pas trouvé
      throw new sfAdeException("Problème d'authentification ADE (redirection)");
    }

    if(strpos($this->content, "Deconnected") !== false)
    {
      // Le cookie n'est pas trouvé
      throw new sfAdeException("Problème d'authentification ADE (Deconnected)");
    }

    return $this->content;
  }

  protected function getAuthentication()
  {
    sfContext::getInstance()->getLogger()->info('get ADE Cookie');

    /* Get lt for login */
    $login_page = file_get_contents("https://cas.uha.fr/cas/login");
    $pattern = '@name="lt" value="([^"]+)" />@';
    preg_match($pattern, $login_page, $matches);
    $lt = $matches[1];

    // base 64 : sfConfig::get('app_ade_url')

    /* Get CAS Cookie and link to emploidutemps.uha.fr */
    $data_string = base64_decode(sfConfig::get('app_cas_login'))."&lt=$lt";
    $handle = curl_init("https://cas.uha.fr/cas/login?service=http://www.emploisdutemps.uha.fr:80/ade/standard/gui/interface.jsp");
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

    $content = curl_exec($handle);

    /* Get ticket */
    $pattern = '@window.location.href="([^"]+)@';
    preg_match($pattern, $content, $matches);
    $link_edt = $matches[1];

    sfContext::getInstance()->getLogger()->info('edt link : "'.$link_edt.'" ');

    if(empty($link_edt))
      throw new sfException('Pas de lien ade ('.$link_edt.')');

    // then, the ADE cookie
    sfContext::getInstance()->getLogger()->info('get Ade Cookie');

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
    $content = curl_exec($handle);
    curl_close($handle); // cURL write cookies in the Cookies Jar file

    sfContext::getInstance()->getLogger()->info(file_get_contents(sfConfig::get('app_ade_cookiefile')));
  }
  

}