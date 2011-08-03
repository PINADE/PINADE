<?php
if(defined('NOM_EDT')) {
  if($edt = Doctrine::getTable('Edt')->createQuery('e')->addwhere('e.nom = ?', NOM_EDT)->execute()->getFirst())
  {
    echo $edt;
  } else { echo "Edt Inconnu"; }
}
else
{
  echo "Pool PINADE";
}
?>