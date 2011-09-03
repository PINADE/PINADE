<?php

if(preg_match("@^(|[46]\.)([-a-z0-9]+)\.pinade.*@", $_SERVER['SERVER_NAME'], $matches))
{
  $edt = $matches[2];
  switch($edt)
  {
    case "pool":
    case "test":
      break;

    case "ensisa":
    case "enscmu":

    case "lyon1-bio":
    case "lyon1-info":
    case "lyon1-iufm":
    case "lyon1-prepa":

    case "istil-gbm":
    case "istil-info":
    case "istil-mam":
    case "istil-mat":
    case "istil-si":
    case "istil-meca":

    case "esisar":

    case "ptours":
    case "ptours-da":
    case "ptours-di":
    case "ptours-dii":
    case "ptours-dee":
    case "ptours-dms":

    case "tours-dcem":
    case "tours-pharma":
    case "tours-ldroit":
    case "tours-mdroit":
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

