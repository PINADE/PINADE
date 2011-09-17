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
      'id'              => new sfWidgetFormInputHidden(),
      'nom'             => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormInputText(),
      'ade_project_id'  => new sfWidgetFormInputText(),
      'liens_utiles'    => new sfWidgetFormTextarea(),
      'adeserver_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adeserver'), 'add_empty' => true)),
      'id_piano_day'    => new sfWidgetFormInputText(),
      'start_timestamp' => new sfWidgetFormInputText(),
      'width'           => new sfWidgetFormInputText(),
      'height'          => new sfWidgetFormInputText(),
      'display_mode'    => new sfWidgetFormInputText(),
      'display_conf_id' => new sfWidgetFormInputText(),
      'piwik_site_id'   => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nom'             => new sfValidatorString(array('max_length' => 255)),
      'description'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ade_project_id'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'liens_utiles'    => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'adeserver_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Adeserver'), 'required' => false)),
      'id_piano_day'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'start_timestamp' => new sfValidatorInteger(array('required' => false)),
      'width'           => new sfValidatorInteger(array('required' => false)),
      'height'          => new sfValidatorInteger(array('required' => false)),
      'display_mode'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'display_conf_id' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'piwik_site_id'   => new sfValidatorInteger(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
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
