<?php

class updateIstilIdentifierTask extends updateLyon1IdentifierTask
{
  protected function configure()
  {
    $this->nom_edt = "istil";
    parent::configure();
  }
}
