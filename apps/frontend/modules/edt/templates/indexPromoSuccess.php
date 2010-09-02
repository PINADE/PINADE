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

<p>
  Selectionnez votre promotion:
  <ul>
    <li><?php echo link_to('1A', $filiere.'/1A') ?></li>
    <li><?php echo link_to('2A', $filiere.'/2A') ?></li>
    <li><?php echo link_to('3A', $filiere.'/3A') ?></li>
  </ul>

</p>
