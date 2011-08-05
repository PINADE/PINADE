<?php
$nom_edt = (defined('NOM_EDT')) ? NOM_EDT : "";
$edt = Doctrine::getTable('Edt')
  ->createQuery('e')
  ->addWhere('e.nom = ?', $nom_edt)
  ->execute()
  ->getFirst();
if($edt)
  $liens_yml = $edt->getLiensUtiles();
else
{
  echo "<!-- edt $nom_edt non trouvé -->";
  return;
}

$yaml = new sfYamlParser();
try
{
  $liens = $yaml->parse($liens_yml);
}
catch (InvalidArgumentException $e)
{
  echo "<!-- Liens utiles mal formés en YAML -->";
  return;
}
if(!is_array($liens)) { echo "<!-- Liens utiles mal formés en tableaux -->"; return; }
?>
            <b>Liens utiles</b>
            <ul>
<?php
foreach($liens['liens'] as $key => $lien)
{
  echo "         <li id='lien-$key'>".link_to($lien['nom'], $lien['url'])."</li>";
}

?>
            </ul>

