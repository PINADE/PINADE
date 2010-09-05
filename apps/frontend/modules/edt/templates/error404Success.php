<?php include_partial('title', array('erreur' => "Page non trouvée")) ?>

<h1>
  <?php include_slot('title') ?>
</h1>

<p>
  Vous avez tenté d'acceder à une page qui n'existe pas. Essayez les liens dans le menu, à gauche.
</p>

<p>
  <?php echo link_to("Revenir à la page d'accueil", '/') ?>
</p>
