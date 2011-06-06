<?php

/**
 * Promotion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    edt
 * @subpackage model
 * @author     Théophile Helleboid, Michael Muré
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Promotion extends BasePromotion
{
  public function __toString()
  {
    return $this->getNom();
  }

  public function getWeekMessage($week)
  {
    return Doctrine::getTable('Message')
      ->createQuery('m')
      ->where('m.promotion_id = ?', array($this->getId()))
      ->andWhere('m.semaine = ?', array($week))
      ->execute()
      ->getFirst();
  }

  /**
   * Retourne le numéro ADE de la semaine :
   * - celui passé en paramètre s'il existe
   * - celui de la semaine courante sinon
   */
  public function getAdeWeekNumber($number = null)
  {
    if($number !== null)
      return $number;

    //$Epoch_UHA = 1283119200 - (2*24 + 6)*60*60;
    return floor((time()- $this->getStartTimestamp())/(60*60*24*7));
  }

  /**
   * Retourne le timestamp correspondant à la semaine ADE
   */
  public function getTimestamp($semaineADE)
  {
    return $this->getStartTimestamp() + $semaineADE * (60*60*24*7);
  }
}
