Information sur l'image<br/>
<ul>
  <li>Filière :  <b><?php echo $filiere ?></li></b>
  <li>Promo :    <b><?php echo $promotion ?></li></b>
  <li>Semaine :  <b><?php echo $semaine ?></li></b>
  <li>URL :  <b style="overflow:auto; display:block"><?php echo link_to($url, $url) ?></li></b>
  <li>Img Filepath : <b <?php echo ($img_mtime == 0) ? 'style="color:red"' : '' ?>><?php echo $img_filepath ?></b><br/>
    Dernière modification : <b><?php echo strftime("%a %d %b %Y %H:%M:%S", $img_mtime) ?></b></li>
  <li>Ical Filepath : <b <?php echo ($ical_mtime == 0) ? 'style="color:red"' : '' ?>><?php echo $ical_filepath ?></b><br/>
    Dernière modification : <b><?php echo strftime("%a %d %b %Y %H:%M:%S", $ical_mtime) ?></b></li>
  <li>Notice : <?php echo (!empty($notice)) ? '<div style="border:1px solid black;padding:5px">'.nl2br(html_entity_decode($notice)).'</div>' : "<b><i>Pas de notice</i></b>" ?></li>
  <li>Cookie default : <b><?php echo (!empty($cookie)) ? $cookie : "<i>Pas de cookie</i>" ?></b></li>
</ul>
