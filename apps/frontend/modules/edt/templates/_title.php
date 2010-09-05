<?php
slot('title');
if(isset($filiere))
{
  switch($filiere)
  {
    case "info":
      echo "Informatique";
      break;
    case "meca":
      echo "Mécanique";
      break;
    case "text":
      echo "Textile";
      break;
    case "auto":
      echo "Automatique";
      break;
    case "prod":
      echo "Système de production";
      break;
  }
}
  if(isset($promo)) echo ' - '.strtoupper($promo);

  if(isset($erreur)) echo $erreur;
  
end_slot();
?>
