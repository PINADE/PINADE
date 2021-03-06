<?php

/**
 * CategorieTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CategorieTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CategorieTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Categorie');
    }
    public function createQuery($alias = '')
    {
      if(defined('NOM_EDT'))
        return parent::createQuery($alias)
          ->leftJoin($alias.'.Edt e')
          ->where('e.nom = ?', NOM_EDT);
      else
        return parent::createQuery($alias);
    }
}