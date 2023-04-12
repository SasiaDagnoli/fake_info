<?php

require_once 'src/FakeInfo.php';

use PHPUnit\Framework\TestCase;

class getFullnameAndGenderTest extends TestCase 
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

    public function testArrayLengthIs3(){
        $expectedLength = 3;
        $array = $this->fakeInfo->getFullNameAndGender();
        $this->assertCount($expectedLength, $array, "The expected result is array has a length of {$expectedLength}");
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

    public function testFirstnameIsAString(){
        $value = $this->fakeInfo->getFullNameAndGender()['firstName'];
        $this->assertIsString($value, 'The expected result is firstName is a string');
    }

    public function testLastnameIsAString(){
        $value = $this->fakeInfo->getFullNameAndGender()['lastName'];
        $this->assertIsString($value, 'The expected result is lastName is a string');
    }

    public function tesGenderIsAString(){
        $value = $this->fakeInfo->getFullNameAndGender()['gender'];
        $this->assertIsString($value, 'The expected result is gender is a string');
    }

    public function testGenderIsFemaleOrMale(){
        $gender = $this->fakeInfo->getCprFullNameAndGender()['gender'];
        $expectedResult = array('female', 'male');
        $this->assertContains($gender, $expectedResult, "The expected result is male or female");
    }
}