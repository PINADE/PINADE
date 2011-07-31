<?php

class updateLyon1BioIdentifierTask extends updateLyon1IdentifierTask
{
  protected function configure()
  {
    $this->nom_edt = "lyon1-bio";
    parent::configure();
  }
}
