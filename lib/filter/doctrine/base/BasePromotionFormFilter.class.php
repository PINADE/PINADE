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
      'url'          => new sfWidgetFormFilterInput(),
      'nom'          => new sfWidgetFormFilterInput(),
      'description'  => new sfWidgetFormFilterInput(),
      'filiere_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Filiere'), 'add_empty' => true)),
      'id_tree'      => new sfWidgetFormFilterInput(),
      'id_piano_day' => new sfWidgetFormFilterInput(),
      'width'        => new sfWidgetFormFilterInput(),
      'height'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'url'          => new sfValidatorPass(array('required' => false)),
      'nom'          => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'filiere_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Filiere'), 'column' => 'id')),
      'id_tree'      => new sfValidatorPass(array('required' => false)),
      'id_piano_day' => new sfValidatorPass(array('required' => false)),
      'width'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
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
      'id'           => 'Number',
      'url'          => 'Text',
      'nom'          => 'Text',
      'description'  => 'Text',
      'filiere_id'   => 'ForeignKey',
      'id_tree'      => 'Text',
      'id_piano_day' => 'Text',
      'width'        => 'Number',
      'height'       => 'Number',
    );
  }
}
