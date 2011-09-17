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
    $content,
    $cookies_init,
    $cookie_file;

  public function __construct(Adeserver $_ade_server)
  {
    $cookies_init = false;
    $ade_server = $_ade_server;
    $this->cookie_file = $ade_server->getCookieFile();
  }

  public function getUrl($url, $post_fields = null)
  {
    if(!$this->cookies_init)
      $this->initCookiesFile();

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
    curl_setopt($handle, CURLOPT_COOKIEFILE, $this->cookie_file);


    if(strlen($post_fields))
    {
      curl_setopt($handle, CURLOPT_POST, true);
      curl_setopt($handle, CURLOPT_POSTFIELDS, $post_fields);
    }

    $this->content = curl_exec($handle);
    $this->curl_handle = $handle;

    if(curl_getinfo($handle, CURLINFO_EFFECTIVE_URL) != $url)
    {
      // On est redirigé, on a probablement été déconnecté
      throw new sfAdeRedirectionException("Problème d'authentification ADE (redirection). Url originale : $url\nRedirection : ".curl_getinfo($handle, CURLINFO_EFFECTIVE_URL));
    }

    if(strpos($this->content, "Deconnected") !== false)
    {
      throw new sfAdeException("Problème d'authentification ADE (Deconnected) : mauvais projectId ?");
    }

    return $this->content;
  }  

  // Rend le fichier accessible en rw pour user + groupe, r pour others
  // ie en CLI + Apache
  protected function initCookiesFile()
  {
    if(!file_exists($this->cookie_file))
      touch($this->cookie_file);

    @chmod($this->cookie_file, 0664);

    $this->cookies_init = true;
  }
}
