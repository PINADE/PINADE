Information sur l'image<br/>
<ul>
  <li>Filière :  <b><?php echo $filiere ?></li></b>
  <li>Promo :    <b><?php echo $promo ?></li></b>
  <li>Semaine :  <b><?php echo $semaine ?></li></b>
  <li>Filepath : <b <?php echo ($mtime == 0) ? 'style="color:red"' : '' ?>><?php echo $filepath ?></b></li>
  <li>Dernière modification : <b><?php echo strftime("%a %d %b %Y %H:%M:%S", $mtime) ?></b></li>
</ul>
