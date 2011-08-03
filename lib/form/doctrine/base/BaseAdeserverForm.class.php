<?php

/**
 * Adeserver form base class.
 *
 * @method Adeserver getObject() Returns the current form's model object
 *
 * @package    edt
 * @subpackage form
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdeserverForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'nom'                  => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormTextarea(),
      'identifier'           => new sfWidgetFormInputText(),
      'ade_url'              => new sfWidgetFormInputText(),
      'login'                => new sfWidgetFormInputText(),
      'login_ade_project_id' => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nom'                  => new sfValidatorString(array('max_length' => 255)),
      'description'          => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'identifier'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ade_url'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'login'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'login_ade_project_id' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Adeserver', 'column' => array('nom')))
    );

    $this->widgetSchema->setNameFormat('adeserver[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adeserver';
  }

}
