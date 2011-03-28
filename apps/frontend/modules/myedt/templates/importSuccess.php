<form action="<?php echo url_for('myedt/CreateFromImport') ?>" method="post">
  <?php if(($erreur = $sf_request->getParameter('erreur'))): ?>
    <div class="erreur"><?php echo $erreur ?></div>
  <?php endif ?>

  <label for="url">URL de l'image :</label>
  <input type="text" name="url" style="width:100%" id="url" value="<?php echo $sf_request->getParameter('url') ?>"/><br/>
  
  <label for="nom">Nom de l'emploi du temps :</label>
  <input type="text" name="nom" id="nom"  value="<?php echo $sf_request->getParameter('nom') ?>"/><br/>
  <input type="submit" value="Importer l'image !" />


</form>


