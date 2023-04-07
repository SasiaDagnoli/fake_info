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
        $this->assertIsArray($output);
    }

}