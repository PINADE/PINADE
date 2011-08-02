<?php

class updateIstilSiIdentifierTask extends updateLyon1IdentifierTask
{
  protected function configure()
  {
    $this->nom_edt = "istil-si";
    parent::configure();
  }
}
