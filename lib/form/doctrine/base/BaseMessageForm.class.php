<?php

/**
 * Message form base class.
 *
 * @method Message getObject() Returns the current form's model object
 *
 * @package    edt
 * @subpackage form
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMessageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'texte'        => new sfWidgetFormTextarea(),
      'promotion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Promotion'), 'add_empty' => false)),
      'semaine'      => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'texte'        => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'promotion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Promotion'))),
      'semaine'      => new sfValidatorInteger(),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('message[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Message';
  }

}
