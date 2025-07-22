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

      # Part Two
      printf('The sum of the results of the multiplications based on the program instructions is: %d' . PHP_EOL, $this->sumAllMulOperationsBasedOnProgramInstructions());
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
      if (count($match) !== 3) {
        throw new \InvalidArgumentException("Malformed mathematical operation found.");
      }

      if (!is_numeric($match[1]) || !is_numeric($match[2])) {
        throw new \InvalidArgumentException("Malformed multiplication operation found.");
      }

      $result = $match[1] * $match[2];
      $totalSum += $result;
    }

    return $totalSum;
  }

  public function sumAllMulOperationsBasedOnProgramInstructions(): int
  {
    if (empty($this->inputData))
      throw new \InvalidArgumentException("Input data is empty.");

    $enableOperation = true;

    $totalSum = 0;

    preg_match_all('/do\(\)|don\'t\(\)|mul\((\d+),(\d+)\)/', $this->inputData, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
      if (count($match) == 1 && $match[0] == 'do()') {
        $enableOperation = true;
      }

      if (count($match) == 1 && $match[0] == 'don\'t()') {
        $enableOperation = false;
      }

      if ($enableOperation) {

        if (count($match) !== 3 || (!is_numeric($match[1]) || !is_numeric($match[2]))) {
          // throw new \InvalidArgumentException("Malformed multiplication operation found.");
          continue;
        }

        $result = $match[1] * $match[2];
        $totalSum += $result;
      }
    }

    return $totalSum;
  }
}
