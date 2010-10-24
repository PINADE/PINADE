Information sur l'image<br/>
<ul>
  <li>Filière :  <b><?php echo $filiere ?></li></b>
  <li>Promo :    <b><?php echo $promo ?></li></b>
  <li>Semaine :  <b><?php echo $semaine ?></li></b>
  <li>Img Filepath : <b <?php echo ($img_mtime == 0) ? 'style="color:red"' : '' ?>><?php echo $img_filepath ?></b><br/>
    Dernière modification : <b><?php echo strftime("%a %d %b %Y %H:%M:%S", $img_mtime) ?></b></li>
  <li>Ical Filepath : <b <?php echo ($ical_mtime == 0) ? 'style="color:red"' : '' ?>><?php echo $ical_filepath ?></b><br/>
    Dernière modification : <b><?php echo strftime("%a %d %b %Y %H:%M:%S", $ical_mtime) ?></b></li>
  <li>Notice : <div style="border:1px solid black;padding:5px"><b><?php echo (!empty($notice)) ? nl2br($notice) : "Pas de notice" ?></b></div></li>
  <li>Cookie default : <b><?echo $cookie ?></b></li>
</ul>
