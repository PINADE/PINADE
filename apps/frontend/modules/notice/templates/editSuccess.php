<?php include_partial('edt/title', array('filiere' => $promotion->getFiliere(), 'promotion' => $promotion)) ?>


<h1 id="title"><?php include_slot('title') ?></h1>

<h2 id="semaine">
  Semaine du <b><?php echo strftime("%e %B %G", $timestamp + 2*60*60) ?></b> au <b><?php echo  strftime("%e %B %G", intval($timestamp) + 5*24*60*60 - 1 ) ?></b>
</h2>


  <form method="post" action="<?php echo url_for("@notice?action=update&promo=".$promotion->getUrl()."&filiere=".$promotion->getFiliere()->getUrl()."&semaine=$semaine") ?>">
<label for="message">Note&nbsp;:<br/>
<textarea id="message" name="message" cols='50' rows='5'><?php echo $notice ?></textarea><br/>
<input type="submit" value="Enregistrer" name="submit" /> - 
<?php echo link_to('Annuler', "@notice?action=show&promo=".$promotion->getUrl()."&filiere=".$promotion->getFiliere()->getUrl()."&semaine=$semaine") ?>
</form>
