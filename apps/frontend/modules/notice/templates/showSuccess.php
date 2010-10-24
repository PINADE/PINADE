<h1>
  Visualisation de la note <?php echo $promo.'/'.$filiere.'/'.$semaine ?>
</h1>

<?php echo link_to('Éditer la note', "notice/edit?promo=$promo&filiere=$filiere&semaine=$semaine") ?>

<?php if(! empty($notice)): ?>
  <div id="notice"><?php echo $notice ?></div>
<?php endif ?>

<h2>
  Semaine du <b><?php echo strftime("%e %B %G", $timestamp + 2*60*60) ?></b> au <b><?php echo  strftime("%e %B %G", intval($timestamp) + 5*24*60*60 - 1 ) ?></b>
</h2>
<p class="center">
  <?php echo link_to(image_tag('divers/precedent.png', 'alt="<<"')
, "notice/show?filiere=$filiere&promo=$promo&semaine=".max(0,$semaine-1)) ?>
  <?php echo link_to('semaine actuelle', "@image?filiere=$filiere&promo=$promo&semaine=$semaine") ?>
  <?php echo link_to(image_tag('divers/suivant.png', 'alt=">>"'), "notice/show?filiere=$filiere&promo=$promo&semaine=".($semaine + 1)) ?>
</p>
<img src='<?php echo url_for("@image_img?filiere=$filiere&promo=$promo&semaine=$semaine") ?>/img.gif' alt='emploi du temps <?php echo $filiere." ".$promo ?>'/>

<!-- raccourci clavier gauche/droite -->
<script type="text/javascript">
document.onkeydown=function(e){
  if(e.which == 37)
  {
    document.location = '<?php echo url_for("notice/show?filiere=$filiere&promo=$promo&semaine=".max(0,$semaine-1)) ?>';
  }
  else if(e.which == 39)
  {
    document.location = '<?php echo url_for("notice/show?filiere=$filiere&promo=$promo&semaine=".max(0,$semaine+1)) ?>';
  }
}
</script>
