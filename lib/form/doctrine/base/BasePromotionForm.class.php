<?php

/**
 * Promotion form base class.
 *
 * @method Promotion getObject() Returns the current form's model object
 *
 * @package    edt
 * @subpackage form
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePromotionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'url'              => new sfWidgetFormInputText(),
      'nom'              => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormTextarea(),
      'filiere_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Filiere'), 'add_empty' => false)),
      'id_tree'          => new sfWidgetFormInputText(),
      'branch_id'        => new sfWidgetFormInputText(),
      'select_branch_id' => new sfWidgetFormInputText(),
      'select_id'        => new sfWidgetFormInputText(),
      'id_piano_day'     => new sfWidgetFormInputText(),
      'width'            => new sfWidgetFormInputText(),
      'height'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'url'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nom'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'      => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'filiere_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Filiere'))),
      'id_tree'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'branch_id'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'select_branch_id' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'select_id'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id_piano_day'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'width'            => new sfValidatorInteger(array('required' => false)),
      'height'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('promotion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Promotion';
  }

}
