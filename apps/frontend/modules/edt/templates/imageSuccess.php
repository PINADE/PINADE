<?php include_partial('title', array('filiere' => $filiere, 'promo' => $promo)) ?>

<h1>
  <?php include_slot('title') ?>
</h1>
<h2>
  Semaine du <b><?php echo strftime("%A %e %B %G", $timestamp) ?></b> au <b><?php echo  strftime("%A %e %B %G", intval($timestamp) + 5*24*60*60 - 1) ?></b>
</h2>
<p class="center">
  <?php echo link_to(image_tag('divers/precedent.png', 'alt=<<')
, "@image?filiere=$filiere&promo=$promo&semaine=$semaine_precedente") ?>
  <?php echo link_to('semaine actuelle', "@image?filiere=$filiere&promo=$promo&semaine=") ?>
  <?php echo link_to(image_tag('divers/suivant.png', 'alt=>>'), "@image?filiere=$filiere&promo=$promo&semaine=$semaine_suivante") ?>
</p>
<img src='<?php echo $image_path ?>' alt='emploi du temps <?php echo $filiere." ".$promo ?>'/>

