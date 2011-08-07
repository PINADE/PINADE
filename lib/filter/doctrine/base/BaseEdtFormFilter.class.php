<?php

/**
 * Edt filter form base class.
 *
 * @package    edt
 * @subpackage filter
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEdtFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nom'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'     => new sfWidgetFormFilterInput(),
      'ade_project_id'  => new sfWidgetFormFilterInput(),
      'liens_utiles'    => new sfWidgetFormFilterInput(),
      'adeserver_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Adeserver'), 'add_empty' => true)),
      'id_piano_day'    => new sfWidgetFormFilterInput(),
      'start_timestamp' => new sfWidgetFormFilterInput(),
      'width'           => new sfWidgetFormFilterInput(),
      'height'          => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nom'             => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'ade_project_id'  => new sfValidatorPass(array('required' => false)),
      'liens_utiles'    => new sfValidatorPass(array('required' => false)),
      'adeserver_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Adeserver'), 'column' => 'id')),
      'id_piano_day'    => new sfValidatorPass(array('required' => false)),
      'start_timestamp' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'width'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'height'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('edt_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Edt';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'nom'             => 'Text',
      'description'     => 'Text',
      'ade_project_id'  => 'Text',
      'liens_utiles'    => 'Text',
      'adeserver_id'    => 'ForeignKey',
      'id_piano_day'    => 'Text',
      'start_timestamp' => 'Number',
      'width'           => 'Number',
      'height'          => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
