<?php

namespace Tests;

use Src\Days\DayOne;
use PHPUnit\Framework\TestCase;

final class DayOneTest extends TestCase
{

  private DayOne $dayOneInstance;
  private $distances = [];

  protected function setUp(): void
  {
    $this->dayOneInstance = new DayOne();
    $this->distances = [
      '3   4',
      '4   3',
      '2   5',
      '1   3',
      '3   9',
      '3   3'
    ];
  }

  public function testBuildLists_ShouldThrowException_IfInputIsNull(): void
  {
    $this->expectException(\TypeError::class);

    $this->dayOneInstance->setup(null);
    $this->dayOneInstance->buildLists();
  }

  public function testBuildLists_ShouldThrowException_IfInputIsEmpty(): void
  {
    $this->expectException(\InvalidArgumentException::class);

    $this->dayOneInstance->setup("");
    $this->dayOneInstance->buildLists();
  }

  public function testBuildLists_ShouldReturnTheCorrectLists(): void
  {

    $distances = implode("\n", $this->distances);

    $this->dayOneInstance->setup($distances);

    $this->assertEquals(
      [
        'leftList' => [3, 4, 2, 1, 3, 3],
        'rightList' => [4, 3, 5, 3, 9, 3]
      ],
      $this->dayOneInstance->buildLists()
    );
  }

  public function testSumUpTotalDistance_ShouldThrowException_IfInputIsNonexistent(): void
  {
    $this->expectException(\InvalidArgumentException::class);

    $this->dayOneInstance->sumUpTotalDistance();
  }

  public function testSumUpTotalDistance_ShouldReturnTheCorrectDistance(): void
  {

    $distances = implode("\n", $this->distances);

    $this->dayOneInstance->setup($distances);

    $this->assertEquals(11, $this->dayOneInstance->sumUpTotalDistance());
  }

  public function testGetSimilarityScore_ShouldReturnTheCorrectScore(): void
  {

    $distances = implode("\n", $this->distances);

    $this->dayOneInstance->setup($distances);

    $this->assertEquals(31, $this->dayOneInstance->getSimilarityScore());
  }
}
