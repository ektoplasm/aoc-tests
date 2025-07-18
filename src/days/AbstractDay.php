<?php

namespace Src\Days;

abstract class Day
{

  protected string $inputData = "";

  public function setup(?string $input)
  {
    $this->inputData = $input;
  }

  abstract public function run(?string $input);
}
