<?php
include("config.inc.php");
header("Content-type: text/plain");

/* Get lt for login */
$login_page = file_get_contents("https://cas.uha.fr/cas/login");
$pattern = '@name="lt" value="([^"]+)" />@';
preg_match($pattern, $login_page, $matches);
$lt = $matches[1];

/* Get Cookie and link to emploidutemps */
$data_string = "username=theophile.helleboid%40uha.fr&password=balamurugan&lt=$lt";
$handle = curl_init("https://cas.uha.fr/cas/login?service=http%3A%2F%2Femploidutemps.uha.fr%2Fade%2Fstandard%2Fgui%2Finterface.jsp");
curl_setopt($handle, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); //, 'Content-length: ') 
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, $data_string /* $data */);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2.7) Gecko/20100701 Firefox/3.6.7");
curl_setopt($handle, CURLOPT_REFERER, "https://cas.uha.fr/cas/login");
curl_setopt($handle, CURLOPT_HEADER, true);
curl_setopt($handle, CURLOPT_WRITEHEADER, fopen("head.txt", "w+"));
$content = curl_exec($handle);
/* Get Cookie */
$pattern = '@Set-Cookie: CASTGC=([^;]+)@';
preg_match($pattern, $content, $matches);
$cookie = $matches[1];
/* Get ticket */
$pattern = '@window.location.href="([^"]+)@';
preg_match($pattern, $content, $matches);
$link_edt = $matches[1];
print_r($matches);


// curl_setopt($handle, CURLOPT_COOKIE, "CASTGC=TGC-414-zo5qVxTVBCxr1xEEDLhG4V7cPZmA2f5rX0YdlbHtu5aTMy1kZx");

$handle = curl_init($link_edt);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; fr; rv:1.9.2.7) Gecko/20100701 Firefox/3.6.7");
curl_setopt($handle, CURLOPT_REFERER, "https://cas.uha.fr/cas/login");
curl_setopt($handle, CURLOPT_HEADER, true);
curl_setopt($handle, CURLOPT_COOKIE, "CASTGC=$cookie");
curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
$content = curl_exec($handle);
/* Get ADE cookie  */
$pattern = '@Set-Cookie: JSESSIONID=([^;]+)@';
preg_match($pattern, $content, $matches);
$ade_cookie = $matches[1];
print_r($matches);

print $content;

