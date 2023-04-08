<?php

require_once 'src/FakeInfo.php';

use PHPUnit\Framework\TestCase;

class nameGenderTest extends TestCase 
{

    public function setUp(): void {
		$this->fakeInfo = new FakeInfo();
	}

    public function tearDown(): void {
		unset($this->fakeinfo);
	}

    public function testIsArray(){
        $array = $this->fakeInfo->getFullNameAndGender();
        $this->assertIsArray($array, 'The expected result is an array');
    }

    public function testIsSame(){
        $array1 = $this->fakeInfo->getFullNameAndGender();
        $array2 = $this->fakeInfo->getFullNameAndGender();
        $this->assertSame($array1, $array2, 'The expected result is the same');
    }

    public function testArrayHasKeyFirstname(){
        $value = 'firstName';
        $array = $this->fakeInfo->getFullNameAndGender();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyLastname(){
        $value = 'lastName';
        $array = $this->fakeInfo->getFullNameAndGender();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyGender(){
        $value = 'gender';
        $array = $this->fakeInfo->getFullNameAndGender();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    } 

    public function testArrayLengthIs3(){
        $expectedLength = 3;
        $array = $this->fakeInfo->getFullNameAndGender();
        $this->assertCount($expectedLength, $array, "The expected result is array has a length of {$expectedLength}");
    } 

}