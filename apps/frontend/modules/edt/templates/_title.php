<?php
slot('title');
  switch($filiere) {
    case "info":
      echo "Informatique - ";
      break;
    case "meca":
      echo "Mécanique - ";
      break;
    case "text":
      echo "Textile - ";
      break;
    case "auto":
      echo "Automatique - ";
      break;
    case "prod":
      echo "Système de production - ";
      break;
  }
end_slot();
?>