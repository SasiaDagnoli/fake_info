<?php

require_once 'src/FakeInfo.php';

use PHPUnit\Framework\TestCase;

class cprNameGenderTest extends TestCase 
{

    public function setUp(): void {
		$this->fakeInfo = new FakeInfo();
	}

    public function tearDown(): void {
		unset($this->fakeinfo);
	}

    public function testGenderIsFemaleOrMale(){
        $gender = $this->fakeInfo->getFullNameAndGender()["gender"];
        $expectedResult = array('female', 'male');
        $this->assertContains($gender, $expectedResult, "The expected result is male or female");
    }
/* 
    public function testCprLastValueIsEvenWhenGenderIsFemale(){
        $expectedResult = 0;
        $result = ((int) substr($this->fakeInfo->getCpr(), 9, 1)) % 2;
        $this->assertSame($expectedResult, $result, "The expected result is the last number is even");
    }

    public function testCprLastValueIsOddWhenGenderIsMale(){
        $expectedResult = 1;
        $result = ((int) substr($this->fakeInfo->getCpr(), 9, 1)) % 2;
        $this->assertSame($expectedResult, $result, 'The expected result is last number is odd');
    } */

}