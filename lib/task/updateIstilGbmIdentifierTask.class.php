<?php

class updateIstilGbmIdentifierTask extends updateLyon1IdentifierTask
{
  protected function configure()
  {
    $this->nom_edt = "istil-gbm";
    parent::configure();
  }
}
