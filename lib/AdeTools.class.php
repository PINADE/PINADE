<?php

class AdeTools
{


  public static function getSemaineNumber($offset = 0)
  {
    // 2 jours et 6 heures avant le lundi, 0h (vendredi, 18h), on affiche la semaine suivante
    // à appliquer si offset == 0 ?
    if($offset == 0)
      $Epoch_UHA = 1283119200 - (2*24 + 6)*60*60;
    else
      $Epoch_UHA = 1283119200;

    return floor((time()- $Epoch_UHA)/(60*60*24*7)) + $offset;
  }
  
  public static function getTimestamp($semaineADE)
  {
    $Epoch_UHA = 1283119200;
    
    return $Epoch_UHA + $semaineADE * (60*60*24*7);
  }
  
}
