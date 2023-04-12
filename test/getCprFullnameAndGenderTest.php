<?php

require_once 'src/FakeInfo.php';

use PHPUnit\Framework\TestCase;

class getCprFullnameAndGenderTest extends TestCase 
{

    public function setUp(): void {
		$this->fakeInfo = new FakeInfo();
	}

    public function tearDown(): void {
		unset($this->fakeinfo);
	}

    public function testIsArray(){
        $array = $this->fakeInfo->getCprFullNameAndGender();
        $this->assertIsArray($array, 'The expected result is an array');
    }

    public function testArrayLengthIs4(){
        $expectedLength = 4;
        $array = $this->fakeInfo->getCprFullNameAndGender();
        $this->assertCount($expectedLength, $array, "The expected result is array has a length of {$expectedLength}");
    } 

    public function testArrayHasKeyFirstname(){
        $value = 'firstName';
        $array = $this->fakeInfo->getCprFullNameAndGender();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyLastname(){
        $value = 'lastName';
        $array = $this->fakeInfo->getCprFullNameAndGender();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    }

    public function testArrayHasKeyGender(){
        $value = 'gender';
        $array = $this->fakeInfo->getCprFullNameAndGender();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    } 

    public function testArrayHasKeyCPR(){
        $value = 'CPR';
        $array = $this->fakeInfo->getCprFullNameAndGender();
        $this->assertArrayHasKey($value, $array, "The expected result is array contains {$value}");
    } 

    public function testIsString(){
        $result = $this->fakeInfo->getCprFullNameAndGender()['CPR'];
        $this->assertIsString($result, 'The expected result is a string');
    }
    public function testFirstnameIsAString(){
        $value = $this->fakeInfo->getCprFullNameAndGender()['firstName'];
        $this->assertIsString($value, 'The expected result is firstName is a string');
    }

    public function testLastnameIsAString(){
        $value = $this->fakeInfo->getCprFullNameAndGender()['lastName'];
        $this->assertIsString($value, 'The expected result is lastName is a string');
    }

    public function tesGenderIsAString(){
        $value = $this->fakeInfo->getCprFullNameAndGender()['gender'];
        $this->assertIsString($value, 'The expected result is gender is a string');
    }

    public function testCprHasLength10(){
        $expectedLength = 10;
        $result = $this->fakeInfo->getCprFullNameAndGender()['CPR'];
        $this->assertEquals($expectedLength, strlen($result), "The expected result is length of {$expectedLength}");
    }

    public function testCprOnlyContainsDigits(){
        $regularExpresion = '/^[0-9]*$/';
        $result = $this->fakeInfo->getCprFullNameAndGender()['CPR'];
        $this->assertMatchesRegularExpression($regularExpresion, $result, "The expected result only contains digits");
    }

    public function testCprDateDayIsGreaterOrEqual1(){
        $lowestNumber = 1;
        $result = substr($this->fakeInfo->getCprFullNameAndGender()['CPR'], 0, 2);
        $this->assertGreaterThanOrEqual($lowestNumber, $result, "The expected result is greater than {$lowestNumber}");
    }

    public function testCprDateDayIsUnder31(){
        $maxNumer = 31;
        $result = substr($this->fakeInfo->getCprFullNameAndGender()['CPR'], 0, 2);
        $this->assertLessThanOrEqual($maxNumer, $result, "The expected result is lower than {$maxNumer}");
    }

    public function testCprDateMonthIsGreaterOrEqual1(){
        $lowestNumber = 1;
        $result = substr($this->fakeInfo->getCprFullNameAndGender()['CPR'], 2, 2);
        $this->assertGreaterThanOrEqual($lowestNumber, $result, "The expected result is greater than {$lowestNumber}");
    }

    public function testCprDateMonthIsUnder12(){
        $maxNumer = 12;
        $result = substr($this->fakeInfo->getCprFullNameAndGender()['CPR'], 2, 2);
        $this->assertLessThanOrEqual($maxNumer, $result, "The expected result is lower than {$maxNumer}");
    }

    public function testCprDateYearIsUnder99(){
        $maxNumer = 99;
        $result = substr($this->fakeInfo->getCprFullNameAndGender()['CPR'], 4, 2);
        $this->assertLessThanOrEqual($maxNumer, $result, "The expected result is lower than {$maxNumer}");
    }

    public function testCprLastDigitIsNotZero(){
        $regex = '/[1-9]/';
        $result = substr($this->fakeInfo->getCprFullNameAndGender()['CPR'], 9);
        $this->assertMatchesRegularExpression($regex, $result, 'Expected result to be a number between 1 and 9');
    }

    public function testGenderIsFemaleOrMale(){
        $gender = $this->fakeInfo->getCprFullNameAndGender()['gender'];
        $expectedResult = array('female', 'male');
        $this->assertContains($gender, $expectedResult, "The expected result is male or female");
    }

    // ---- this test will most likely fail ----
    public function testCprLastValueMatchesGender(){
        if($this->fakeInfo->getCprFullNameAndGender()['gender'] === 'female'){
            $expectedResult = 0;
        } else{
            $expectedResult = 1;
        }
        $result = ((int) substr($this->fakeInfo->getCprFullNameAndGender()['CPR'], 9, 1)) % 2;
        $this->assertSame($expectedResult, $result, "The expected result is the last number matches gender");
    }
}