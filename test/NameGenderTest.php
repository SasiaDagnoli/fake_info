<?php

require_once 'src/FakeInfo.php';

use PHPUnit\Framework\TestCase;

class NameGenderTest extends TestCase {

    private $fakeInfo;

    public function setUp(): void {
		$this->Fakeinfo = new FakeInfo;
	}

    public function tearDown(): void {
		unset($this->Fakeinfo);
	}

    public function testIsArray(){
        $output = $this->FakeInfo->getFullNameAndGender();
        $this->assertIsArray($output, 'The expected result is an array');
    }

    public function testIsSame(){
        $output1 = $this->FakeInfo->getFullNameAndGender();
        $output2 = $this->FakeInfo->getFullNameAndGender();
        $this->assertSame($output1, $output2, 'The expected result is the same');
    }

    public function testIsNan(){
        $output = $this->FakeInfo->getFullNameAndGender();
        $this->assertNan($output, 'The expected result is not a number');
    }

    public function testArrayHasKeyFirstname(){
        $value = 'firstName';
        $array = $this->FakeInfo->getFullNameAndGender();
        $this->assertArrayHasKey($value, $output, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyLastname(){
        $value = 'lastName';
        $array = $this->FakeInfo->getFullNameAndGender();
        $this->assertArrayHasKey($value, $output, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyGender(){
        $value = 'gender';
        $array = $this->FakeInfo->getFullNameAndGender();
        $this->assertArrayHasKey($value, $output, "The expected result is array contains {$value}");
    }

}