<?php

require_once 'src/FakeInfoTest.php';
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class getBirthDateTest extends TestCase
{
    private $fakeInfo;

    protected function setUp(): void
    {
        $this->fakeInfo = new FakeInfo();
    }

    /** @test */
    public function birthDateTest()
    {
        //$birthDate = new FakeInfo();
        //$result = $birthDate->getFullNameGenderAndBirthDate();
        $this->assertIsArray($this->fakeInfo->getFullNameGenderAndBirthDate());
    }
}
