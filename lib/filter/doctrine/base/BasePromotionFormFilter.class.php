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
      'filiere_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Filiere'), 'add_empty' => true)),
      'weight'           => new sfWidgetFormFilterInput(),
      'in_menu'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'project_id'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tree'          => new sfWidgetFormFilterInput(),
      'branch_id'        => new sfWidgetFormFilterInput(),
      'select_branch_id' => new sfWidgetFormFilterInput(),
      'select_id'        => new sfWidgetFormFilterInput(),
      'id_piano_day'     => new sfWidgetFormFilterInput(),
      'width'            => new sfWidgetFormFilterInput(),
      'height'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'url'              => new sfValidatorPass(array('required' => false)),
      'nom'              => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'filiere_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Filiere'), 'column' => 'id')),
      'weight'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'in_menu'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'project_id'       => new sfValidatorPass(array('required' => false)),
      'id_tree'          => new sfValidatorPass(array('required' => false)),
      'branch_id'        => new sfValidatorPass(array('required' => false)),
      'select_branch_id' => new sfValidatorPass(array('required' => false)),
      'select_id'        => new sfValidatorPass(array('required' => false)),
      'id_piano_day'     => new sfValidatorPass(array('required' => false)),
      'width'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'filiere_id'       => 'ForeignKey',
      'weight'           => 'Number',
      'in_menu'          => 'Boolean',
      'project_id'       => 'Text',
      'id_tree'          => 'Text',
      'branch_id'        => 'Text',
      'select_branch_id' => 'Text',
      'select_id'        => 'Text',
      'id_piano_day'     => 'Text',
      'width'            => 'Number',
      'height'           => 'Number',
    );
  }
}
