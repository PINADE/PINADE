<?php include_partial('title', array('nom_filiere' => $nom_filiere, 'nom_promo' => $nom_promo)) ?>


<h1>
  <?php include_slot('title') ?>
</h1>
<h2>
  Semaine du <b><?php echo strftime("%e %B %G", $timestamp + 2*60*60) ?></b> au <b><?php echo  strftime("%e %B %G", intval($timestamp) + 5*24*60*60 - 1 ) ?></b>
</h2>
<p class="center">
  <?php echo link_to(image_tag('divers/precedent.png', 'alt="<<"')
, "@image?filiere=$filiere&promo=$promo&semaine=$semaine_precedente") ?>
  <?php echo link_to('semaine actuelle', "@image?filiere=$filiere&promo=$promo&semaine=") ?>
  <?php echo link_to(image_tag('divers/suivant.png', 'alt=">>"'), "@image?filiere=$filiere&promo=$promo&semaine=$semaine_suivante") ?>
</p>
<img src='<?php echo url_for("@image_img?filiere=$filiere&promo=$promo&semaine=$semaine") ?>/img.gif' alt='emploi du temps <?php echo $filiere." ".$promo ?>'/>

<!-- raccourci clavier gauche/droite -->
<script type="text/javascript">
document.onkeydown=function(e){
  if(e.which == 37)
  {
    document.location = '<?php echo url_for("@image?filiere=$filiere&promo=$promo&semaine=".max(0,$semaine-1)) ?>';
  }
  else if(e.which == 39)
  {
    document.location = '<?php echo url_for("@image?filiere=$filiere&promo=$promo&semaine=".max(0,$semaine+1)) ?>';
  }
}
</script>

<?php if(! empty($notice)): ?>
  <div id="notice"><?php echo nl2br($notice) ?></div>
<?php endif ?>

<?php if($sf_request->getCookie('default') == $filiere.'/'.$promo): ?>
  <?php echo link_to('Effacer cette page comme page d\'accueil', "@cookie_reset?filiere=$filiere&promo=$promo&semaine=$semaine") ?>
<?php else: ?>
  <?php echo link_to('Enregistrer cette page comme page d\'accueil', "@cookie_set?filiere=$filiere&promo=$promo&semaine=$semaine") ?><br/>
<?php endif ?>

