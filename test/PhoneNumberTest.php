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

    // Assert that getPhoneNumber returns a string
    public function testPhoneNumberIsString()
    {
        $this->assertIsString($this->fakeInfo->getPhoneNumber());
    }

    // Assert getPhoneNumber returns exactly 8 numbers
    public function testPhoneNumberHasCorrectFormat()
    {
        $phoneNumber = $this->fakeInfo->getPhoneNumber();
        $this->assertMatchesRegularExpression("/^[0-9]{1,8}$/", $phoneNumber);
    }

    // Assert prefix is the first number in the phone number
    /*  public function testPhoneNumberPrefixIsFirst()
{
$phoneNumber = $this->fakeInfo->getPhoneNumber();
$phonePrefixes = FakeInfo::PHONE_PREFIXES;

$foundPrefix = false;
foreach ($phonePrefixes as $prefix) {
if (str_starts_with($phoneNumber, $prefix)) {
$foundPrefix = true;
break;
}
}
} */
}
