<?php

require_once 'src/FakeInfo.php';
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class getFakePersonsTest extends TestCase
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
        $array = $this->fakeInfo->getFakePersons();
        $this->assertIsArray($array, 'The expected result is an array');
    }

    /**
     * @dataProvider provideAmount
     */
    public function testIfAmountIsOver200OrUnder2($value, $expected)
    {
        $array = $this->fakeInfo->getFakePersons($value);
        $arrayLength = count($array);
        $this->assertCount($expected, $array, "$arrayLength");
    }

    public function provideAmount()
    {
        return [
            [250, 200],
            [199, 199],
            [100, 100],
            [10, 10],
            [0, 2],
            [1, 2],
            [-1, 2],
        ];
    }
}
