<?php

namespace Src\Days;

final class DayOne extends Day
{
  public function run(?string $input)
  {
    try {
      $this->setup($input);

      # Part One
      printf('Total distance: %d' . PHP_EOL, $this->sumUpTotalDistance());

      # Part Two
      printf('Similarity score: %d' . PHP_EOL, $this->getSimilarityScore());
    } catch (\Exception $exception) {
      echo "Error: " . $exception->getMessage() . "\n";
    }
  }

  public function buildLists(): array
  {

    if (empty($this->inputData))
      throw new \InvalidArgumentException("Input data is empty.");

    $lines = explode("\n", trim($this->inputData));

    $validLines = array_filter($lines, fn($line) => !empty(trim($line)));

    if (empty($validLines))
      throw new \InvalidArgumentException("Input data is malformed.");

    $leftList = [];
    $rightList = [];

    foreach ($validLines as $line) {
      if (preg_match('/^(\d{1,})(\s+)(\d{1,})$/', $line, $matches)) {
        $leftList[] = (int) $matches[1];
        $rightList[] = (int) $matches[3];
      }
    }

    if (empty($leftList) || empty($rightList) || count($leftList) != count($rightList))
      throw new \InvalidArgumentException("Input data is malformed.");

    return [
      'leftList' => $leftList,
      'rightList' => $rightList
    ];
  }

  public function sumUpTotalDistance(): int
  {

    $totalDistance = 0;

    $lists = $this->buildLists();
    $leftList = $lists['leftList'];
    $rightList = $lists['rightList'];

    sort($leftList);
    sort($rightList);

    foreach ($leftList as $index => $leftValue) {
      $totalDistance += abs($leftValue - $rightList[$index]);
    }

    return $totalDistance;
  }

  public function getSimilarityScore(): int
  {

    $lists = $this->buildLists();
    $leftList = $lists['leftList'];
    $rightList = $lists['rightList'];
    $similarityScore = 0;

    foreach ($leftList as $leftValue) {
      $filteredValues = array_filter($rightList, fn($rightValue) => $rightValue == $leftValue);
      $similarityScore += count($filteredValues) * $leftValue;
    }

    return $similarityScore;
  }
}
