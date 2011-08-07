<?php

/**
 * Promotion filter form base class.
 *
 * @package    edt
 * @subpackage filter
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePromotionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'url'              => new sfWidgetFormFilterInput(),
      'nom'              => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'categorie_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categorie'), 'add_empty' => true)),
      'weight'           => new sfWidgetFormFilterInput(),
      'in_menu'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'id_tree'          => new sfWidgetFormFilterInput(),
      'branch_id'        => new sfWidgetFormFilterInput(),
      'select_branch_id' => new sfWidgetFormFilterInput(),
      'select_id'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'url'              => new sfValidatorPass(array('required' => false)),
      'nom'              => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'categorie_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categorie'), 'column' => 'id')),
      'weight'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'in_menu'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'id_tree'          => new sfValidatorPass(array('required' => false)),
      'branch_id'        => new sfValidatorPass(array('required' => false)),
      'select_branch_id' => new sfValidatorPass(array('required' => false)),
      'select_id'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('promotion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Promotion';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'url'              => 'Text',
      'nom'              => 'Text',
      'description'      => 'Text',
      'categorie_id'     => 'ForeignKey',
      'weight'           => 'Number',
      'in_menu'          => 'Boolean',
      'id_tree'          => 'Text',
      'branch_id'        => 'Text',
      'select_branch_id' => 'Text',
      'select_id'        => 'Text',
    );
  }
}
