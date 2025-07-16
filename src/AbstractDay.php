<?php

namespace Src;

abstract class Day {
  abstract public function setup(?string $input);
  abstract public function run(?string $input);
}