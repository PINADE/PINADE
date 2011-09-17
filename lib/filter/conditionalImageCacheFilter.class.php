<?php

class conditionalImageCacheFilter extends sfFilter
{
  public function execute($filterChain)
  {
    $context = $this->getContext();
    $request = $context->getRequest();

    $promotion = Doctrine_Core::getTable('Promotion')
      ->createQuery('p')
      ->leftJoin('p.Categorie c')
      ->andwhere('p.url = ? AND c.url = ?', array($request->getParameter('promo'),  $request->getParameter('categorie')))
      ->execute()
      ->getFirst();

    if(!$promotion)
      return $filterChain->execute();

    $semaine = $promotion->getAdeWeekNumber($request->getParameter('semaine'));
    $adeImage = new AdeImage($promotion, $semaine);

    // On ne cache que si l'image est présente en PNG
    if (
      sfConfig::get('app_optimize_image', false)
      && $context->getViewCacheManager()
      && strpos($adeImage->getOptimizedFilename(), "png") !== false)
    {
      $context->getViewCacheManager()->addCache("img", "img", array('lifeTime' => 7200));
    }
 
    // Execute next filter
    $filterChain->execute();
  }
}