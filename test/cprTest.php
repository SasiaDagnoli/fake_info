<?php

require_once 'src/FakeInfo.php';

use PHPUnit\Framework\TestCase;

class cprTest extends TestCase 
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

    public function testCprDateDay(){
        $maxNumer = 31;
        $result = substr($this->fakeInfo->getCpr(), 0, 2);
        $this->assertLessThanOrEqual($maxNumer, $result, "The expected result is lower than {$maxNumer}");
    }

    public function testCprDateMonth(){
        $maxNumer = 12;
        $result = substr($this->fakeInfo->getCpr(), 2, 2);
        $this->assertLessThanOrEqual($maxNumer, $result, "The expected result is lower than {$maxNumer}");
    }

    public function testCprDateYear(){
        $maxNumer = 99;
        $result = substr($this->fakeInfo->getCpr(), 4, 2);
        $this->assertLessThanOrEqual($maxNumer, $result, "The expected result is lower than {$maxNumer}");
    }

   /*  public function testCprLastValueIsEven(){
        $expectedResult = 0;
        $result = ((int) substr($this->fakeInfo->getCpr(), 9, 1)) % 2;
        $this->assertSame($expectedResult, $result, "The expected result is last number is even");
    } */

}