<?php

if(preg_match("@^([-a-z0-9]+)\.pinade.*@", $_SERVER['SERVER_NAME'], $matches))
{
  $edt = $matches[1];
  switch($edt)
  {
    case "pool":
      break;
    case "ensisa":
//    case "enscmu":
    case "lyon1-bio":
    case "lyon1-info":
    case "lyon1-iufm":
      define('NOM_EDT', $edt);
      break;
    default:
      header('Location: http://www.pinade.org/');
      die();
      break;
  }
}
else
{
  header('Location: http://www.pinade.org/');
  die();
}

