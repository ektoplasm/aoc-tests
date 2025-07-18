<?php

namespace Src\Days;

final class DayTwo extends Day
{

  public function run(?string $input): void
  {
    try {
      $this->setup($input);

      # Part One
      printf('Safe Reports: %d' . PHP_EOL, $this->analyzeReports(false));

      # Part Two
      printf('Safe Reports with Problem Dampener: %d' . PHP_EOL, $this->analyzeReports(true));
    } catch (\Exception $exception) {
      echo "Error: " . $exception->getMessage() . "\n";
    }
  }

  public function isLineIncreasing(array $line): bool
  {
    $isIncreasing = true;

    foreach ($line as $index => $value) {
      if (array_key_exists($index + 1, $line)) {
        if ($value >= $line[$index + 1]) {
          $isIncreasing = false;
          break;
        }
      }
    }

    return $isIncreasing;
  }

  public function isLineDecreasing(array $line): bool
  {
    $isDecreasing = true;

    foreach ($line as $index => $value) {
      if (array_key_exists($index + 1, $line)) {
        if ($value <= $line[$index + 1]) {
          $isDecreasing = false;
          break;
        }
      }
    }

    return $isDecreasing;
  }

  public function countStepsBetweenValues(int $value1, int $value2): int
  {
    $valuesToCompare = [$value1, $value2];

    sort($valuesToCompare);

    return abs($valuesToCompare[0] - $valuesToCompare[1]);
  }

  public function checkStepsBetweenValues(array $line, int $min = 1, int $max = 3): bool
  {
    $steps = 0;

    foreach ($line as $index => $value) {
      if (array_key_exists($index + 1, $line)) {
        $currentValue = (int) $value;
        $nextValue = (int) $line[$index + 1];

        $count = $this->countStepsBetweenValues($currentValue, $nextValue);

        $steps = $count > $steps ? $count : $steps;
      }
    }

    return $steps >= $min && $steps <= $max;
  }

  public function checkifLineIsSafe(string $line): bool
  {
    $lineValues = explode(" ", $line);

    return $this->checkStepsBetweenValues($lineValues, 1, 3) &&
      $this->validateIfLineHasSingleDirection($line);
  }

  public function detectBadLevels(string $line, $minSteps = 1, $maxSteps = 3): array
  {
    $lineValues = explode(" ", $line);
    $badLevels = [];

    foreach ($lineValues as $index => $value) {
      preg_match_all("/$value/", $line, $matches);
      if (count($matches[0]) > 1) {
        $badLevels[] = $matches[0][0];
        break;
      }

      if (array_key_exists($index + 1, $lineValues)) {
        $count = $this->countStepsBetweenValues((int) $value, (int) $lineValues[$index + 1]);

        if ($count < $minSteps || $count > $maxSteps) {
          $badLevels[] = $value;
        }
      }
    }

    return array_unique($badLevels, SORT_NUMERIC);
  }

  public function filterReports(array $reports, $safeOnly = true): array
  {
    return array_filter($reports, function ($line) use ($safeOnly): bool {
      return $safeOnly ? $this->checkifLineIsSafe($line) : !$this->checkifLineIsSafe($line);
    });
  }

  private function removeSingleLevel(string $line, int $index): string
  {
    $lineValues = explode(" ", $line);

    unset($lineValues[$index]);

    $newLine = implode(" ", $lineValues);
    $newLine = trim(preg_replace('/\s+/', ' ', $newLine));

    return $newLine;
  }

  private function countLineValues(string $line): int
  {
    $lineValues = explode(" ", $line);
    return count($lineValues);
  }

  public function validateIfLineHasSingleDirection(string $line): bool
  {
    $isDecreasing = $this->isLineDecreasing(explode(' ', $line));
    $isIncreasing = $this->isLineIncreasing(explode(' ', $line));

    return $isDecreasing xor $isIncreasing;
  }

  public function analyzeReports(?bool $withDampener = false): int
  {
    if (empty($this->inputData))
      throw new \InvalidArgumentException("Input data is empty.");

    $lines = explode("\n", trim($this->inputData));

    $allReports = array_filter($lines, fn($line) => !empty(trim($line)));

    if (empty($allReports))
      throw new \InvalidArgumentException("Input data is malformed.");

    $safeReports = $this->filterReports($allReports);

    if (!$withDampener) return count(array_unique($safeReports));

    $unsafeReports = $this->filterReports($allReports, false);

    $sanitizedReports = [];

    foreach ($unsafeReports as $line) {

      $totalLineValues = $this->countLineValues($line);

      for ($valueIndex = 0; $valueIndex < $totalLineValues; $valueIndex++) {

        $newLine = $this->removeSingleLevel($line, $valueIndex);
        if ($this->checkifLineIsSafe($newLine)) {
          $sanitizedReports[] = $line;
          break;
        }
      }
    }

    $totalSafeReports = array_unique([...$safeReports, ...$sanitizedReports]);

    return count($totalSafeReports);
  }
}
