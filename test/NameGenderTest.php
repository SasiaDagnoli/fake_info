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
        $output = $this->fakeInfo->getFullNameAndGender();
        $this->assertIsArray($output, 'The expected result is an array');
    }

    public function testIsSame(){
        $output1 = $this->fakeInfo->getFullNameAndGender();
        $output2 = $this->fakeInfo->getFullNameAndGender();
        $this->assertSame($output1, $output2, 'The expected result is the same');
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

}