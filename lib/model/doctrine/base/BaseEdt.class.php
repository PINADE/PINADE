<?php

/**
 * BaseEdt
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nom
 * @property string $description
 * @property string $identifier
 * @property string $ade_project_id
 * @property string $ade_url
 * @property string $login
 * @property string $liens_utiles
 * @property Doctrine_Collection $Categories
 * 
 * @method string              getNom()            Returns the current record's "nom" value
 * @method string              getDescription()    Returns the current record's "description" value
 * @method string              getIdentifier()     Returns the current record's "identifier" value
 * @method string              getAdeProjectId()   Returns the current record's "ade_project_id" value
 * @method string              getAdeUrl()         Returns the current record's "ade_url" value
 * @method string              getLogin()          Returns the current record's "login" value
 * @method string              getLiensUtiles()    Returns the current record's "liens_utiles" value
 * @method Doctrine_Collection getCategories()     Returns the current record's "Categories" collection
 * @method Edt                 setNom()            Sets the current record's "nom" value
 * @method Edt                 setDescription()    Sets the current record's "description" value
 * @method Edt                 setIdentifier()     Sets the current record's "identifier" value
 * @method Edt                 setAdeProjectId()   Sets the current record's "ade_project_id" value
 * @method Edt                 setAdeUrl()         Sets the current record's "ade_url" value
 * @method Edt                 setLogin()          Sets the current record's "login" value
 * @method Edt                 setLiensUtiles()    Sets the current record's "liens_utiles" value
 * @method Edt                 setCategories()     Sets the current record's "Categories" collection
 * 
 * @package    edt
 * @subpackage model
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEdt extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('edt');
        $this->hasColumn('nom', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('identifier', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('ade_project_id', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('ade_url', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('login', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('liens_utiles', 'string', 4000, array(
             'type' => 'string',
             'length' => 4000,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Categorie as Categories', array(
             'local' => 'id',
             'foreign' => 'edt_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}