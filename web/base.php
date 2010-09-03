<?php 
error_reporting(-1);
$ade_cookie = "662969F0B3EEA35A915D8E37B3D8D3A";

    $handle = curl_init("http://emploidutemps.uha.fr/ade/standard/gui/interface.jsp");
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2.7) Gecko/20100701 Firefox/3.6.7");
    curl_setopt($handle, CURLOPT_REFERER, "https://cas.uha.fr/cas/login");
    curl_setopt($handle, CURLOPT_COOKIE, "JSESSIONID=$ade_cookie");
 //   curl_setopt($handle, CURLOPT_HEADER, true);
    curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
    $content = curl_exec($handle);

echo curl_getinfo($handle, CURLINFO_EFFECTIVE_URL);
/*
if(strpos($content, "Location: https://cas.uha.fr") === false) {
  echo "OK";
  print $content;

} else
  echo "NOK";
*/

echo $content;

?>