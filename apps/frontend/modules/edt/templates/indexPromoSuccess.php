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

<h2>
  Selectionnez votre promotion:
</h2>

<ul>
  <li><?php echo link_to('1A', $filiere.'/1a') ?></li>
  <li><?php echo link_to('2A', $filiere.'/2a') ?></li>
  <li><?php echo link_to('3A', $filiere.'/3a') ?></li>
</ul>
