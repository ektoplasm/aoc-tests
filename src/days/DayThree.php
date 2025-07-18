<?php

namespace Src\Days;

final class DayThree extends Day
{

  public function run(?string $input): void
  {
    try {
      $this->setup($input);

      # Part One
      printf('The sum of the results of the multiplications is: %d' . PHP_EOL, $this->sumAllMulOperations());
    } catch (\Exception $exception) {
      echo "Error: " . $exception->getMessage() . "\n";
    }
  }

  public function sumAllMulOperations(): int
  {
    if (empty($this->inputData))
      throw new \InvalidArgumentException("Input data is empty.");

    $totalSum = 0;

    preg_match_all('/mul\((\d+),(\d+)\)/', $this->inputData, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
      if (count($match) !== 3 && !is_numeric($match[1]) && !is_numeric($match[2])) {
        throw new \InvalidArgumentException("Malformed multiplication operation found.");
      }

      $result = $match[1] * $match[2];
      $totalSum += $result;
    }

    return $totalSum;
  }
}
