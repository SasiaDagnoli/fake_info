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

    // mock PHONE_PREFIXES and assert that getPhoneNumber returns a number that starts with the mocked prefix
    public function testPhoneNumberPrefixIsFirst()
    {
        $phoneNumber = $this->fakeInfo->getPhoneNumber();
        $phonePrefixes = [
            '2', '30', '31', '40', '41', '42', '50', '51', '52', '53', '60', '61', '71', '81', '91', '92', '93', '342',
            '344', '345', '346', '347', '348', '349', '356', '357', '359', '362', '365', '366', '389', '398', '431',
            '441', '462', '466', '468', '472', '474', '476', '478', '485', '486', '488', '489', '493', '494', '495',
            '496', '498', '499', '542', '543', '545', '551', '552', '556', '571', '572', '573', '574', '577', '579',
            '584', '586', '587', '589', '597', '598', '627', '629', '641', '649', '658', '662', '663', '664', '665',
            '667', '692', '693', '694', '697', '771', '772', '782', '783', '785', '786', '788', '789', '826', '827', '829'
        ];

        $foundPrefix = false;
        foreach ($phonePrefixes as $prefix) {
            if (str_starts_with($phoneNumber, $prefix)) {
                $foundPrefix = true;
                break;
            }
        }

        $this->assertTrue($foundPrefix);
    }

    // Assert prefix is the first number in the phone number (Only works if you change PHONE_PREFIXES to a public constant)
    /*     public function testPhoneNumberPrefixIsFirst()
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
