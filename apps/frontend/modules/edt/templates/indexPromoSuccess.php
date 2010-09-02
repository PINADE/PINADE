<?php include_partial('title', array('filiere' => $filiere)) ?>

<h1>
  <?php include_slot('title') ?>
</h1>

<h2>
  Selectionnez votre promotion:
</h2>

<ul>
  <li><?php echo link_to('1A', $filiere.'/1a') ?></li>
  <li><?php echo link_to('2A', $filiere.'/2a') ?></li>
  <li><?php echo link_to('3A', $filiere.'/3a') ?></li>
</ul>
