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

  public function __construct()
  {
    $this->initCookiesFile();
  }

  public function getUrl($url, $post_fields = null)
  {
    return $this->ProcessUrl($url, $post_fields);
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
    curl_setopt($handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2.7) Gecko/20100701 Firefox/3.6.7 pinade.org ".sfConfig::get('app_email_from'));
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
      throw new sfAdeException("Problème d'authentification ADE (redirection). Url originale : $url\nRedirection : ".curl_getinfo($handle, CURLINFO_EFFECTIVE_URL));
    }

    if(strpos($this->content, "Deconnected") !== false)
    {
      // Le cookie n'est pas trouvé
      throw new sfAdeException("Problème d'authentification ADE (Deconnected) : mauvais projectId ?");
    }

    return $this->content;
  }  

  // Rend le fichier accessible en rw pour tout le monde
  // ie en CLI + Apache
  protected function initCookiesFile()
  {
    if(!file_exists($file = sfConfig::get('app_ade_cookiefile')))
      touch($file);

    @chmod($file, 0666);
  }
}
