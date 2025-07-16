#!/usr/bin/php
<?php

namespace Src;

require __DIR__ . '/../vendor/autoload.php';

if ($argc < 2 || $argc > 3) exit(1);

$className = sprintf('Src\%s', $argv[1]);
$inputFile = sprintf(__DIR__ . '/../assets/%s/input.txt', $argv[1]) ;

if(class_exists($className) && file_exists($inputFile)) {
  $dayInstance = new \ReflectionClass($className)->newInstance();
  $inputData = file_get_contents($inputFile);
  $dayInstance->run($inputData);
  exit(1);
}

echo "Class not found: " . $argv[1] . "\n";
exit(1);