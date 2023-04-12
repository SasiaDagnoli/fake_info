<?php

require_once 'src/FakeInfo.php';
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class getBirthDateTest extends TestCase
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
    public function birthDateFormatTest()
    {
        $format = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = $getFunction["birthDate"];
        $this->assertMatchesRegularExpression($format, $getBirthDate);
    }

    public function testBirthDateIsString()
    {
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = $getFunction["birthDate"];
        $this->assertIsString($getBirthDate);
    }

    public function testBirthDateIsGreaterOrEqual1()
    {
        $lowestNumber = 1;
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = substr($getFunction["birthDate"], 8, 2);
        $this->assertGreaterThanOrEqual($lowestNumber, $getBirthDate, "The expected result is greater than {$lowestNumber}");
    }

    public function testBirthDateDayIsUnder31()
    {
        $highestNumber = 31;
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = substr($getFunction["birthDate"], 8, 2);
        $this->assertLessThanOrEqual($highestNumber, $getBirthDate, "The expected result is lower than {$highestNumber}");
    }

    public function testBirthDateMonthIsGreaterOrEqual1()
    {
        $lowestNumber = 1;
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = substr($getFunction["birthDate"], 5, 2);
        $this->assertGreaterThanOrEqual($lowestNumber, $getBirthDate, "The expected result is greater than {$lowestNumber}");
    }

    public function testBirthDateMonthIsUnder12()
    {
        $highestNumber = 12;
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = substr($getFunction["birthDate"], 5, 2);
        $this->assertLessThanOrEqual($highestNumber, $getBirthDate, "The expected result is lower than {$highestNumber}");
    }

    public function testBirthDateYearIsUnder99()
    {
        $highestNumber = 99;
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = substr($getFunction["birthDate"], 2, 2);
        $this->assertLessThanOrEqual($highestNumber, $getBirthDate, "The expected result is lower than {$highestNumber}");
    }

    public function testBirthDateMatchesCprDate()
    {
        $cprDate = substr($this->fakeInfo->getCpr(), 0, 2);
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = substr($getFunction["birthDate"], 8, 2);
        $this->assertSame($cprDate, $getBirthDate);
    }

    public function testBirthDateMonthMatchesCprMonth()
    {
        $cprMonth = substr($this->fakeInfo->getCpr(), 2, 2);
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = substr($getFunction["birthDate"], 5, 2);
        $this->assertSame($cprMonth, $getBirthDate);
    }

    public function testBirthDateYearMatchesCprYear()
    {
        $cprYear = substr($this->fakeInfo->getCpr(), 4, 2);
        $getFunction = $this->fakeInfo->getFullNameGenderAndBirthDate();
        $getBirthDate = substr($getFunction["birthDate"], 2, 2);
        $this->assertSame($cprYear, $getBirthDate);
    }
}
