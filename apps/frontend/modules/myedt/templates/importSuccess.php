<?php include_partial('global/title', array('erreur' => "Importer votre agenda")) ?>

<h1><?php include_slot('title') ?></h1>

<?php echo image_tag('pinade-02.png', "alt='capture ADE Expert' width='535' height='414' style='float:right'") ?>

<h2>Mode d'emploi</h2>
<ol>
  <li>Connectez-vous sur <?php echo link_to("emploisdutemps.uha.fr", "https://www.emploisdutemps.uha.fr/") ?></li>
  <li>Sélectionnez votre composante (ENSISA, FST, ENSCMu, etc.)</li>
  <li>Affichez votre emploi du temps (vous pouvez sélectionner autant de cours que vous le souhaitez, ou juste réduire à votre groupe de TP, TD, etc.)</li>
  <li>Faites un clic droit <b>sur l'image de votre emploi du temps</b> et sélectionnez « Copier l'adresse de l'image »</li>
  <li>Cliquez dans le champs « URL de l'image » ci-dessus et collez l'adresse (Ctrl+V)</li>
  <li>Nommez votre emploi du temps (ne peut comporter que des chiffres, lettres non accentuées, - et _)</li>
</ol>

<br style="clear:both" />
<form action="<?php echo url_for('myedt/CreateFromImport') ?>" method="post">
  <?php if(($erreur = $sf_request->getParameter('erreur'))): ?>
    <div class="erreur"><?php echo $erreur ?></div>
  <?php endif ?>

  <label for="url"><b>URL de l'image :</b></label>
  <input type="text" name="url" style="width:100%" id="url" value="<?php echo $sf_request->getParameter('url') ?>" placeholder="https://www.emploisdutemps.uha.fr/ade/imageEt?identifier=474a99cb3003b98bb57140b12f65b16e&amp;projectId=19&amp;idPianoWeek=28&amp;idPianoDay=0,1,2,3,4&amp;idTree=271,177,178,179,180,181,182,183,184&amp;width=800&amp;height=600&amp;lunchName=REPAS&amp;displayMode=1057855&amp;showLoad=false&amp;ttl=1283427991552&amp;displayConfId=8"/><br/>
  
  <label for="nom">Nom de l'emploi du temps :</label>
  <input type="text" name="nom" id="nom"  value="<?php echo $sf_request->getParameter('nom') ?>"/><br/>
  <label for="description">Description (facultative)</label> :<br/>
  <textarea id="description" name="description"  style="width:90%; height:3em" placeholder="Cours de MIAGE 1, groupe TD 1, TP2"><?php echo $sf_request->getParameter('description') ?></textarea><br/>

  <label for="categorie-id">Catégorie :</label>
  <select name="categorie_id" id="categorie-id">
<?php foreach($categories as $categorie): ?>
    <option value="<?php echo $categorie->getId() ?>"
    <?php echo ($categorie_id == $categorie->getId()) ? "selected='selected'" : "" ?>
    ><?php echo $categorie ?></option>

<?php endforeach ?>
  </select>
  <br/>

  <input type="submit" value="Importer l'image !" />


</form>


