<?php

/**
 * edt tools.
 *
 * @package    edt
 * @subpackage edt
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdeImage
{

  protected
    $ade_cookie,
    $projectId = "27",
    $idPianoWeek,
    $idPianoDay,
    $idTree, 
    $width = "1024",
    $height = "768",
    $displayMode = "1057855",
    $displayConfId = "8",
    $url,
    $content;

  public function __construct($trees, $options = array())
  {
//    $this->ade_cookie = AdeTools::getAdeCookie();

    $config_tree = sfConfig::get('sf_id_tree');
    sfContext::getInstance()->getLogger()->info(print_r($config_tree,1));
    if(!is_array($trees))
      throw new sfException('$trees must be an array');

    foreach($trees as $tree)
    {
      if(isset($config_tree[$tree[0]]))
      {
        if(isset($config_tree[$tree[0]][$tree[1]]))
          $id_tree[] = $config_tree[$tree[0]][$tree[1]];
        else
          throw new sfException('La promo '.$tree[1].' de la filière '.$tree[0].' n\'existe pas');
      }
      else throw new sfException('La filière '.$tree[0].' n\'existe pas');
    }
    if(count($id_tree) == 0) throw new sfException('$id_tree is empty !');
    
    $options = array_merge(array(
      'projectId' => '27',
      'idPianoWeek' => '2',
      'idPianoDay' => '0,1,2,3,4',
      'idTree' => implode(',', $id_tree),
      'width' => '800',
      'height' => '600',
      'displayMode' => '1057855',
      'displayConfId' => '8',
    ), $options);

    $this->projectId = $options['projectId'];
    $this->idPianoWeek = $options['idPianoWeek'];
    $this->idPianoDay = $options['idPianoDay'];
    $this->idTree = $options['idTree'];
    $this->width = $options['width'];
    $this->height = $options['height'];
    $this->displayMode = $options['displayMode'];
    $this->displayConfId = $options['displayConfId'];

    $this->url = "http://www.emploidutemps.uha.fr/ade/imageEt?".
      "identifier=3df5af70498bff8bc4facf408da524dc".
      "&projectId=".$this->projectId.
      "&idPianoWeek=".$this->idPianoWeek.
      "&idPianoDay=".$this->idPianoDay.
      "&idTree=".$this->idTree.
      "&width=".$this->width.
      "&height=".$this->height.
      "&lunchName=REPAS".
      "&displayMode=".$this->displayMode.
      "&showLoad=false".
      "&ttl=1283427991552".
      "&displayConfId=".$this->displayConfId;
  }
  
  public function getImage()
  {
    $this->content = AdeTools::getAdeImage($this->ade_cookie, $this->url);
  }

  public function updateImage()
  {
    if(file_exists($path.$this->getFilename()))
    {
      $filestat = stat($path.$this->getFilename());
      // Si le fichier a été modifié il y a moins de 2h, on zappe
      if($filestat['mtime'] + 2*60*60 > time())
      {
        sfContext::getInstance()->getLogger()->info('Image déjà en cache : '.$url);
        return;
      }
    }

    if(empty($this->content))
      $this->content = AdeTools::getAdeImage($this->ade_cookie, $this->url);

    if(!is_dir($path = $this->getPath()))
      mkdir($path);
    
    file_put_contents($path.$this->getFilename(), $this->content);
  }

  protected function getPath()
  {
    return str_replace(',','-',sfConfig::get('sf_web_dir').'/images/edt/'.$this->idTree.'/');
  }

  protected function getFilename()
  {
    return str_replace(',','-',$this->idPianoWeek).'.gif';
  }

  public function getWebPath()
  {
    return '/images/edt/'.str_replace(',','-',$this->idTree).'/'.str_replace(',','-',$this->idPianoWeek).'.gif';
  }
}


