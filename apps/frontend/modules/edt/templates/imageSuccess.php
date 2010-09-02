<p class="center">
  <?php echo link_to('semaine précédente', "@image?filiere=$filiere&promo=$promo&semaine=$semaine_precedente") ?> - 
  <?php echo link_to('semaine actuelle', "@image?filiere=$filiere&promo=$promo&semaine=") ?> - 
  <?php echo link_to('semaine suivante', "@image?filiere=$filiere&promo=$promo&semaine=$semaine_suivante") ?>
</p>
<img src='<?php echo $image_path ?>' alt='emploi du temps <?php echo $filiere." ".$promo ?>'/>

