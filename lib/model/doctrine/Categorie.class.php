<?php

/**
 * Categorie
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    edt
 * @subpackage model
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Categorie extends BaseCategorie
{
  public function __toString()
  {
    return $this->getNom();
  }
}
