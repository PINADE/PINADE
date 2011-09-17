Information sur la promotion<br/>
<ul>
  <li>Adeserver : <b><?php echo $promotion->getCategorie()->getEdt()->getAdeserver() ?></b></li>
  <li>Edt :       <b><?php echo $promotion->getCategorie()->getEdt() ?></b></li>
  <li>Catégorie : <b><?php echo $promotion->getCategorie() ?></li></b>
  <li>Promo :     <b><?php echo $promotion ?></li></b>
  <li>Start Timespamp : <b><?php echo strftime("%a %d %b %Y %H:%M:%S", $promotion->getCategorie()->getEdt()->getStartTimestamp()) ?></b></li>
  <li>Cookie default : <b><?php echo (!empty($cookie)) ? $cookie : "<i>Pas de cookie</i>" ?></b></li>
</ul>

<table class="table-details">
  <thead>
    <tr><th>Semaine</th><th>URL ADE</th><th>Dernière modification</th><th>Notice</th>
  </thead>
  <tbody>

<?php foreach($images as $semaine => $image): ?>
<?php
  $notice = $promotion->getWeekMessage($semaine);
  if(file_exists($filepath = sfConfig::get('sf_web_dir').$image->getWebPath()))
    $img_mtime = filemtime($filepath);
  else
    $img_mtime = 0;
?>
    <tr>
      <td><?php echo link_to(strftime("%a %d %b %Y", $image->getTimestamp()), "@image?categorie=".$promotion->getCategorie()->getUrl()."&promo=".$promotion->getUrl()."&semaine=$semaine") ?></td>
      <td><?php echo link_to("semaine ".$semaine, $image->getUrl()) ?></td>
      <td>
        <?php if($img_mtime == 0): ?>
          <i>Pas d'image</i>
        <?php else: ?>
          <a href="<?php echo $image->getWebPath() ?>"><?php echo strftime("%a %d %b %Y %H:%M:%S", $img_mtime) ?></a>
        <?php endif ?>
      </td>
      <td>
        <a href="<?php echo url_for('notice', array(
          'action'      => "show",
          'categorie'   => $promotion->getCategorie()->getUrl(),
          'promo'       => $promotion->getUrl(),
          'semaine'     => $semaine,
        )) ?>">
          <?php echo (!empty($notice)) ? ''.nl2br(html_entity_decode($notice)).'' : "<i>Pas de notice</i>" ?></td>
        </a>
    </tr>

<?php endforeach ?>
  </tbody>

</table>
