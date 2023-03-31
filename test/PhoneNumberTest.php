<?php

require_once 'src/FakeInfo.php';

use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    private $fakeInfo;

    protected function setUp(): void
    {
        $this->fakeInfo = new FakeInfo();
    }

    public function testPhoneNumberIsString()
    {
        $this->assertIsString($this->fakeInfo->getPhoneNumber());
    }

    public function testPhoneNumberHasCorrectFormat()
    {
        $phoneNumber = $this->fakeInfo->getPhoneNumber();
        $this->assertMatchesRegularExpression("/^\d{8}$/", $phoneNumber);
    }


    // This test fails... (Failed asserting that '53000459' is not equal to '53000459'.
    public function testPhoneNumberIsUnique()
    {
        $phoneNumber1 = $this->fakeInfo->getPhoneNumber();
        $phoneNumber2 = $this->fakeInfo->getPhoneNumber();

        $this->assertNotEquals($phoneNumber1, $phoneNumber2);
    }

    // This also fails
    // testing 1000 phone numbers -> adds them to array,
    // then using 'array_unique' to remove dublicates -> asserting that the number of unique phone numbers is aqual to number of tests
    public function testPhoneNumberIsUnique2()
    {
        $phoneNumbers = [];
        $numTests = 1000;

        for ($i = 0; $i < $numTests; $i++) {
            $phoneNumbers[] = $this->fakeInfo->getPhoneNumber();
        }

        $uniqueNumbers = array_unique($phoneNumbers);
        $numUnique = count($uniqueNumbers);

        $this->assertEquals($numTests, $numUnique);
    }
}
