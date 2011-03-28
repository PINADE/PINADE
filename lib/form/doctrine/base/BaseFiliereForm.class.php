<?php

/**
 * Filiere form base class.
 *
 * @method Filiere getObject() Returns the current form's model object
 *
 * @package    edt
 * @subpackage form
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFiliereForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'url'         => new sfWidgetFormInputText(),
      'nom'         => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'logo'        => new sfWidgetFormInputText(),
      'weight'      => new sfWidgetFormInputText(),
      'in_menu'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nom'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'logo'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'weight'      => new sfValidatorInteger(array('required' => false)),
      'in_menu'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('filiere[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Filiere';
  }

}
