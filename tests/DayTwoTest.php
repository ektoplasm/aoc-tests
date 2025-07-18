<?php

namespace Tests;

use Src\Days\DayTwo;
use PHPUnit\Framework\TestCase;

final class DayTwoTest extends TestCase
{

  private DayTwo $dayTwoInstance;
  private string $reports = "";

  protected function setUp(): void
  {
    $this->dayTwoInstance = new DayTwo();

    $this->reports = implode("\n", [
      '7 6 4 2 1',
      '1 2 7 8 9',
      '9 7 6 2 1',
      '1 3 2 4 5',
      '8 6 4 4 1',
      '1 3 6 7 9',
    ]);

    $this->dayTwoInstance->setup($this->reports);
  }

  public function testAnalyzeReports_ShouldThrowException_IfInputIsNull(): void
  {
    $this->expectException(\TypeError::class);

    $this->dayTwoInstance->setup(null);
    $this->dayTwoInstance->analyzeReports(false);
  }

  public function testAnalyzeReports_ShouldThrowException_IfInputIsEmpty(): void
  {
    $this->expectException(\InvalidArgumentException::class);

    $this->dayTwoInstance->setup("");
    $this->dayTwoInstance->analyzeReports(false);
  }

  public function testAnalyzeReports_ShouldReturnTheCorrectNumberOfSafeReports(): void
  {
    $this->assertEquals(2, $this->dayTwoInstance->analyzeReports(false));
  }

  public function testAnalyzeReportsWithActiveDampenerOption_ShouldReturnTheCorrectNumberOfSafeReports(): void
  {
    $this->dayTwoInstance->setup(implode("\n", [
      '34 34 41 43 45 46 48 51',
      '15 19 21 24 25 26 29 30',
      "82 82 81 83 84",
      "39 39 41 43 44 46 49",
      '7 6 4 2 1',
      '1 2 7 8 9',
      '9 7 6 2 1',
      '1 3 2 4 5',
      '8 6 4 4 1',
      '1 3 6 7 9',
      '22 22 22 24 26 33',
      '44 48 49 51 52 53 55 55',
      '36 36 33 32 31'
    ]));

    $this->assertEquals(7, $this->dayTwoInstance->analyzeReports(true));
  }

  public function testIsLineDecreasing_ShouldReturnTrueAndFalseAndFalseAndFalse(): void
  {
    $this->assertTrue($this->dayTwoInstance->isLineDecreasing(explode(' ', '7 6 4 2 1')));
    $this->assertFalse($this->dayTwoInstance->isLineDecreasing(explode(' ', '1 2 7 8 9')));
    $this->assertFalse($this->dayTwoInstance->isLineDecreasing(explode(' ', '8 6 4 4 1')));
    $this->assertFalse($this->dayTwoInstance->isLineDecreasing(explode(' ', '1 3 2 4 5')));
  }
  public function testIsLineIncreasing_ShouldReturnTrueAndTrueAndFalse(): void
  {
    $this->assertTrue($this->dayTwoInstance->isLineIncreasing(explode(' ', '1 3 6 7 9')));
    $this->assertTrue($this->dayTwoInstance->isLineIncreasing(explode(' ', '1 2 7 8 9')));
    $this->assertFalse($this->dayTwoInstance->isLineIncreasing(explode(' ', '1 3 2 4 5')));
  }
  public function testCheckStepsBetweenValues_ShouldReturnTrueAndFalseAndTrue(): void
  {
    $this->assertTrue($this->dayTwoInstance->checkStepsBetweenValues(explode(' ', '1 3 6 7 9'), 1, 3));
    $this->assertFalse($this->dayTwoInstance->checkStepsBetweenValues(explode(' ', '1 2 7 8 9'), 1, 3));
    $this->assertTrue($this->dayTwoInstance->checkStepsBetweenValues(explode(' ', '8 6 4 4 1'), 1, 3));
  }

  public function testCheckifLineIsSafe_ShouldReturnError(): void
  {
    $this->assertFalse($this->dayTwoInstance->checkifLineIsSafe('23 20 23 25 28 30 27 31'));
    $this->assertFalse($this->dayTwoInstance->checkifLineIsSafe('77 73 71 69 66 63 62 58'));
  }

  public function testValidateIfLineHasSingleDirection_ShouldReturnError(): void
  {
    $this->assertFalse($this->dayTwoInstance->validateIfLineHasSingleDirection('23 20 23 25 28 30 27 31'));
    $this->assertFalse($this->dayTwoInstance->validateIfLineHasSingleDirection('1 3 2 4 5'));
  }

  public function testValidateIfLineHasSingleDirection_ShouldReturnTrue(): void
  {
    $this->assertTrue($this->dayTwoInstance->validateIfLineHasSingleDirection('1 2 7 8 9'));
    $this->assertTrue($this->dayTwoInstance->validateIfLineHasSingleDirection('1 3 6 7 9'));
  }
}
