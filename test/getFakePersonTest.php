<?php

require_once 'src/FakeInfo.php';
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class getFakePersonTest extends TestCase
{
    private $fakeInfo;

    protected function setUp(): void
    {
        $this->fakeInfo = new FakeInfo();
    }

    public function tearDown(): void
    {
        unset($this->fakeInfo);
    }

    /** @test */
    public function testIsArray()
    {
        $array = $this->fakeInfo->getFakePerson();
        $this->assertIsArray($array, 'The expected result is an array');
    }

    public function testArrayHasKeyCpr()
    {
        $value = 'CPR';
        $array = $this->fakeInfo->getFakePerson();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyFirstname()
    {
        $value = 'firstName';
        $array = $this->fakeInfo->getFakePerson();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyLastname()
    {
        $value = 'lastName';
        $array = $this->fakeInfo->getFakePerson();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyGender()
    {
        $value = 'gender';
        $array = $this->fakeInfo->getFakePerson();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyBirthDate()
    {
        $value = 'birthDate';
        $array = $this->fakeInfo->getFakePerson();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyAddress()
    {
        $value = 'address';
        $array = $this->fakeInfo->getFakePerson();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyPhoneNumber()
    {
        $value = 'phoneNumber';
        $array = $this->fakeInfo->getFakePerson();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayLengthIs7()
    {
        $expectedLength = 7;
        $array = $this->fakeInfo->getFakePerson();
        $this->assertCount($expectedLength, $array, "The expected result is array has a length of {$expectedLength}");
    }
}
