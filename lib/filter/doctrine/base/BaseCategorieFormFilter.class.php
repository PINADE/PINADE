<?php

/**
 * Categorie filter form base class.
 *
 * @package    edt
 * @subpackage filter
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategorieFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'url'         => new sfWidgetFormFilterInput(),
      'nom'         => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'logo'        => new sfWidgetFormFilterInput(),
      'weight'      => new sfWidgetFormFilterInput(),
      'in_menu'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'edt_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Edt'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'url'         => new sfValidatorPass(array('required' => false)),
      'nom'         => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'logo'        => new sfValidatorPass(array('required' => false)),
      'weight'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'in_menu'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'edt_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Edt'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('categorie_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Categorie';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'url'         => 'Text',
      'nom'         => 'Text',
      'description' => 'Text',
      'logo'        => 'Text',
      'weight'      => 'Number',
      'in_menu'     => 'Boolean',
      'edt_id'      => 'ForeignKey',
    );
  }
}
