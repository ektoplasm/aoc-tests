<?php
namespace Tests;

use Src\DayOne;
use PHPUnit\Framework\TestCase;

final class DayOneTest extends TestCase {

  var DayOne $dayOneInstance;

  public function __construct() {
    parent::__construct();

    $this->dayOneInstance = new DayOne();
  }

  public function testSumTotalDistance_ShouldThrowException_IfInputIsNonexistent(): void {
    $this->expectException(\InvalidArgumentException::class);
    
    $this->dayOneInstance->sumTotalDistance();
  }
}