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

    /**
    * @group female
    */
    public function testGenderIsFemale(){
        $gender = $this->fakeInfo->getFullNameAndGender()["gender"];
        $expectedResult = 'female';
        $this->assertSame($gender, $expectedResult, "The expected result is true/female");
    }

    /**
    * @group female
    */
    public function testCprLastValueIsEven(){
        $expectedResult = 0;
        $result = ((int) substr($this->fakeInfo->getCpr(), 9, 1)) % 2;
        $this->assertSame($expectedResult, $result, "The expected result is the last number is even");
    }

    /**
    * @group male
    */
    public function testGenderIsMale(){
        $gender = $this->fakeInfo->getFullNameAndGender()["gender"];
        $expectedResult = 'male';
        $this->assertSame($gender, $expectedResult, "The expected result is true/male");
    }

    /**
    * @group male
    */
    public function testCprLastValueIsOdd(){
        $expectedResult = 1;
        $result = ((int) substr($this->fakeInfo->getCpr(), 9, 1)) % 2;
        $this->assertSame($expectedResult, $result, 'The expected result is last number is odd');
    }

}