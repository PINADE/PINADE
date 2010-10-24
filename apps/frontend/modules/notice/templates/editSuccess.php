<h2>Visualisation de la note <?php echo $promo.'/'.$filiere.'/'.$semaine ?></h2>

<form method="post" action="<?php echo url_for("@notice?action=update&promo=$promo&filiere=$filiere&semaine=$semaine") ?>">
<label for="notice">Note&nbsp;:<br/>
<textarea id="notice" name="notice" cols='50' rows='5'><?php echo $notice ?></textarea><br/>
<input type="submit" value="Enregistrer" name="submit" /> - 
<?php echo link_to('Annuler', "@notice?action=show&promo=$promo&filiere=$filiere&semaine=$semaine") ?>
</form>
