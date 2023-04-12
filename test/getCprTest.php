<?php

require_once 'src/FakeInfo.php';

use PHPUnit\Framework\TestCase;

class getCprTest extends TestCase 
{

    public function setUp(): void {
		$this->fakeInfo = new FakeInfo();
	}

    public function tearDown(): void {
		unset($this->fakeinfo);
	}

    public function testIsString(){
        $result = $this->fakeInfo->getCpr();
        $this->assertIsString($result, 'The expected result is a string');
    }

    public function testCprHasLength10(){
        $expectedLength = 10;
        $result = $this->fakeInfo->getCpr();
        $this->assertEquals($expectedLength, strlen($result), "The expected result is length of {$expectedLength}");
    }

    public function testCprOnlyContainsDigits(){
        $regularExpresion = '/^[0-9]*$/';
        $result = $this->fakeInfo->getCpr();
        $this->assertMatchesRegularExpression($regularExpresion, $result, "The expected result only contains digits");
    }

    public function testCprDateDayIsGreaterOrEqual1(){
        $lowestNumber = 1;
        $result = substr($this->fakeInfo->getCpr(), 0, 2);
        $this->assertGreaterThanOrEqual($lowestNumber, $result, "The expected result is greater than {$lowestNumber}");
    }

    public function testCprDateDayIsUnder31(){
        $maxNumer = 31;
        $result = substr($this->fakeInfo->getCpr(), 0, 2);
        $this->assertLessThanOrEqual($maxNumer, $result, "The expected result is lower than {$maxNumer}");
    }

    public function testCprDateMonthIsGreaterOrEqual1(){
        $lowestNumber = 1;
        $result = substr($this->fakeInfo->getCpr(), 2, 2);
        $this->assertGreaterThanOrEqual($lowestNumber, $result, "The expected result is greater than {$lowestNumber}");
    }

    public function testCprDateMonthIsUnder12(){
        $maxNumer = 12;
        $result = substr($this->fakeInfo->getCpr(), 2, 2);
        $this->assertLessThanOrEqual($maxNumer, $result, "The expected result is lower than {$maxNumer}");
    }

    public function testCprDateYearIsUnder99(){
        $maxNumer = 99;
        $result = substr($this->fakeInfo->getCpr(), 4, 2);
        $this->assertLessThanOrEqual($maxNumer, $result, "The expected result is lower than {$maxNumer}");
    }

    public function testCprLastDigitIsNotZero(){
        $regex = '/[1-9]/';
        $result = substr($this->fakeInfo->getCpr(), 9);
        $this->assertMatchesRegularExpression($regex, $result, 'Expected result to be a number between 1 and 9');
    }

}