<?php

namespace Tests;

use Src\Days\DayThree;
use PHPUnit\Framework\TestCase;

final class DayThreeTest extends TestCase
{

  private DayThree $dayThreeInstance;

  protected function setUp(): void
  {
    $this->dayThreeInstance = new DayThree();

    $this->dayThreeInstance->setup("xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))");
  }

  public function testSumAllMulOperations_ShouldThrowException_IfInputIsNull(): void
  {
    $this->expectException(\TypeError::class);

    $this->dayThreeInstance->setup(null);
  }

  public function testSumAllMulOperations_ShouldThrowException_IfInputIsEmpty(): void
  {
    $this->expectException(\InvalidArgumentException::class);

    $this->dayThreeInstance->setup("");
  }

  public function testSumAllMulOperations_ShouldThrowException_IfInputIsMalformed(): void
  {
    $this->expectException(\InvalidArgumentException::class);
    $this->dayThreeInstance->setup("xmul(p,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))");
    $this->assertEquals(161, $this->dayThreeInstance->sumAllMulOperations());
  }

  public function testSumAllMulOperations_ShouldReturnTheCorrectValue(): void
  {
    $this->assertEquals(161, $this->dayThreeInstance->sumAllMulOperations());
  }
}
