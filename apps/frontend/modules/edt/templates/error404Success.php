<?php include_partial('title', array('erreur' => "Page non trouvée")) ?>

<h1>
  <?php include_slot('title') ?>
</h1>

<p>
  Vous avez tenté d'accéder à une page qui n'existe pas. Essayez les liens dans le menu, à gauche, ou <a href="javascript:history.back()">revenez sur vos pas</a>.
</p>

<p>
  <?php echo link_to("Revenir à la page d'accueil", '/') ?>
</p>

<?php include_partial('global/adsense_lb') ?>
