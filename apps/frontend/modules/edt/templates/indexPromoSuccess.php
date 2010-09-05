<?php include_partial('title', array('filiere' => $filiere)) ?>

<h1>
  <?php include_slot('title') ?>
</h1>

<h2>
  Selectionnez votre promotion:
</h2>

<ul>
  <li><?php echo link_to('1A', '@image?filiere='.$filiere.'&promo=1a&semaine=') ?></li>
  <li><?php echo link_to('2A', '@image?filiere='.$filiere.'&promo=2a&semaine=') ?></li>
  <li><?php echo link_to('3A', '@image?filiere='.$filiere.'&promo=3a&semaine=') ?></li>
</ul>
