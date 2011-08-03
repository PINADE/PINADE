<?php

/**
 * Edt form base class.
 *
 * @method Edt getObject() Returns the current form's model object
 *
 * @package    edt
 * @subpackage form
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEdtForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'nom'            => new sfWidgetFormInputText(),
      'description'    => new sfWidgetFormInputText(),
      'ade_project_id' => new sfWidgetFormInputText(),
      'liens_utiles'   => new sfWidgetFormTextarea(),
      'adeserver_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adeserver'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nom'            => new sfValidatorString(array('max_length' => 255)),
      'description'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ade_project_id' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'liens_utiles'   => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'adeserver_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adeserver'), 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Edt', 'column' => array('nom')))
    );

    $this->widgetSchema->setNameFormat('edt[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Edt';
  }

}
