<?php

require_once 'src/FakeInfo.php';

use PHPUnit\Framework\TestCase;

class getCprFullnameGenderAndBirthdateTest extends TestCase 
{
    public function setUp(): void {
		$this->fakeInfo = new FakeInfo();
	}

    public function tearDown(): void {
		unset($this->fakeinfo);
	}

    public function testIsArray(){
        $array = $this->fakeInfo->getCprFullNameGenderAndBirthDate();
        $this->assertIsArray($array, 'The expected result is an array');
    }

    public function testArrayLengthIs5(){
        $expectedLength = 5;
        $array = $this->fakeInfo->getCprFullNameGenderAndBirthDate();
        $this->assertCount($expectedLength, $array, "The expected result is array has a length of {$expectedLength}");
    } 

    public function testArrayHasKeyCpr(){
        $value = 'CPR';
        $array = $this->fakeInfo->getCprFullNameGenderAndBirthDate();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyFirstname(){
        $value = 'firstName';
        $array = $this->fakeInfo->getCprFullNameGenderAndBirthDate();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyLastname(){
        $value = 'lastName';
        $array = $this->fakeInfo->getCprFullNameGenderAndBirthDate();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyGender(){
        $value = 'gender';
        $array = $this->fakeInfo->getCprFullNameGenderAndBirthDate();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyBirthDate(){
        $value = 'birthDate';
        $array = $this->fakeInfo->getCprFullNameGenderAndBirthDate();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testBirthdateAndCprMatch(){
        $birthdate = substr($this->fakeInfo->getCprFullNameGenderAndBirthDate()['birthDate'], 8, 2) . 
        substr($this->fakeInfo->getCprFullNameGenderAndBirthDate()['birthDate'], 5, 2) . 
        substr($this->fakeInfo->getCprFullNameGenderAndBirthDate()['birthDate'], 2, 2);
        $cpr = substr($this->fakeInfo->getCprFullNameGenderAndBirthDate()['CPR'], 0, 6);
        $this->assertSame($birthdate, $cpr, 'The expected result is birthdate matches cpr');
    } 
}