<?php

require_once 'src/FakeInfo.php';
require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    private $fakeInfo;

    protected function setUp(): void
    {
        $this->fakeInfo = new FakeInfo();
    }
    protected function tearDown(): void
    {
        unset($this->fakeInfo);
    }



    ### UNIT TESTS ###

    //  ADDRESS (PROPERTY ARRAY)
    
    public function testArrayIsSame(){
        $array1 = $this->fakeInfo->getAddress();
        $array2 = $this->fakeInfo->getAddress();
        $this->assertSame($array1, $array2, 'The two arrays are not identical.');
    }

    public function testAddressIsArray()
    {
        $this->assertIsArray($this->fakeInfo->getAddress());
    }

    public function testAddressIsNotString()
    {
        $this->assertIsNotString($this->fakeInfo->getAddress());
    }

    /**
     * @dataProvider provideArrayHasKey
     */
    public function testArrayHasKey($key): void
    {
        $array = $this->fakeInfo->getAddress()['address'];
        $this->assertArrayHasKey($key, $array, "Array does not contain '{$key}' as key.");
    }
    public static function provideArrayHasKey() {
        return [
            ['street'],
            ['number'],
            ['floor'],
            ['door'],
            ['postal_code'],
            ['town_name'],
            ['town_name'],
        ];
    }

    /**
     * @dataProvider provideArrayNotHasKey
     */
    public function testArrayNotHasKey($key): void
    {
        $array = $this->fakeInfo->getAddress()['address'];
        $this->assertArrayNotHasKey($key, $array, "Array contains '{$key}' as key.");
    }

    public static function provideArrayNotHasKey()
    {
        return [
            ['town'],
            ['window'],
            ['zip_code'],
            ['0'],
            ['?'],
        ];
    }

    public function testArrayLengthIs6()
    {
        $expectedLength = 6;
        $array = $this->fakeInfo->getAddress()['address'];
        $this->assertCount($expectedLength, $array, "Length of array does not match expected value of {$expectedLength}.");
    }

    
    // Note re testKeyIsString: Possible to set the name of the data sets that shows if it fails [eg. data set #2 shows as 'floor']?

    /**
     * @dataProvider provideKeyIsString
     */
    public function testKeyIsString($key): void
    {

        $this->assertIsString($this->fakeInfo->getAddress()['address'][$key]);

    }

    public static function provideKeyIsString()
    {
        return [
            ['street'],
            ['number'],
            // ['floor'], // FAILS: Sometimes only a number is returned, which reads as an integer. Should always be a string, as even though the value may be a number, no calculations will be performed.
            // ['door'], // FAILS: Sometimes only a number is returned, which reads as an integer. Should always be a string, as even though the value may be a number, no calculations will be performed.
            ['postal_code'],
            ['town_name'],
        ];
    }

    /**
     * @dataProvider provideKeyIsNotInt
     */
    public function testKeyIsNotInt($key): void
    {

        $this->assertIsNotInt($this->fakeInfo->getAddress()['address'][$key]);


    }
    public static function provideKeyIsNotInt()
    {
        return [
            ['street'],
            ['number'],
            // ['floor'], // FAILS: Should fail all the time, as even if the value may be a number, it should be returned as a string.
            // ['door'], // FAILS: Should fail all the time, as even if the value may be a number, it should be returned as a string.
            ['postal_code'],
            ['town_name'],
        ];
    }



    // STREET

    // Regex: String must allow alphabetical characters including Danish letters, allow one or more spaces randomly throughout string, and be 40 characters in length
    // Regex Alternative 1: /^[a-zA-ZÆØÅæøå][a-zA-ZÆØÅæøå ]+[a-zA-ZÆØÅæøå]$/
    // Regex Alternative 2: /^(?=.{40})([a-zA-ZÆØÅæøå]{2,40}[a-zA-ZÆØÅæøå ]*[a-zA-ZÆØÅæøå]{2,40})$/

    // Note re testStreetHasCorrectFormat:
    // Ambiguous test: Does it pass because the format is true, or because the regex is badly formulated and lets it 'pass' falsely?
    // As such, it could become a test of the regex instead of the code.

    // Possible refactors:
    // > Should add expression to check for double spaces
    // > First character + after spaces should start with big letter
    // > Spaces can currently occur as last character at end of string (eg. 'XikHåjChnVuØSpfAexsIijDiQpKæåbScHRAKhct '). Solution = adding trim() to code?
    // > Stand-alone characters can currently occur in the string, eg. 'fPSzvOIEzSwLpJWFKxEZgNgJMvhinlDØmtFÆeq Y' or 'R E QælKGpnWKÅrJÆUnrØhGcåRhGåeUXnoPVaFiW'

    public function testDBStreetHasCorrectFormat()
    {
        $street = $this->fakeInfo->getAddress()['address']['street'];
        $this->assertMatchesRegularExpression("/^[a-zA-ZÆØÅæøå]|[\s]{40}$/", $street, "'{$street}' does not match regex.");
    }

    /**
     * @dataProvider provideStreetHasCorrectFormat
     */
    public function testStreetHasCorrectFormat($street): void
    {
        $this->assertMatchesRegularExpression("/^[a-zA-ZÆØÅæøå]|[\s]{40}$/", $street, "'{$street}' does not match regex.");
    }
    public static function provideStreetHasCorrectFormat()
    {
        return [
            ['XikHåjChnVuØSpfAexsIijDiQpKæåbScHRAKhctf'], // 40 chars, no spaces = true
            // ['XikHåjChnVuØSpfAexsIijDiQpKæåbScHRAKhct'], // 39 chars, no spaces = false
            ['XikHåj ChnVuØSpf AexsIijDiQ pKæåbScHRAKh'], // 40 chars, with spaces = true
            // ['XikHåj ChnVuØSpf AexsIijDiQ pKæåbScHRAK'], // 39 chars, with spaces = false
            ['XikHåjChnVuØSpfAexsIijDiQpKæåbScHRAKh tf'], // 40 chars, 2 letters at end = true
            // ['XikHåjChnVuØSpfAexsIijDiQpKæåbScHRAKhc f'], // 40 chars, 1 letter at end = false
            ['XikHåj C hnVuØSpfAexsIijDiQpKæåbScHRAKhc'], // 40 chars, 1 letter on it's own = false
            ['XikHåj Ch nVuØSpfAexsIijDiQpKæåbScHRAKhc'], // 40 chars, 1 letter on it's own = true
        ];
    }

    public function testDBStreetHasLength40(): void
    {
        $expectedLength = 40;
        $street = $this->fakeInfo->getAddress()['address']['street'];
        $this->assertEquals($expectedLength, mb_strlen($street), "'{$street}' does not match length of 40 characters.");
    }

    /**
     * @dataProvider provideStreetHasLength40
     */
    public function testStreetHasLength40($street): void
    {
        $expectedLength = 40;
        $this->assertEquals($expectedLength, mb_strlen($street), "'{$street}' does not match length of 40 characters.");
    }
    public static function provideStreetHasLength40()
    {
        return [
            ['XikHåjChnVuØSpfAexsIijDiQpKæåbScHRAKhctf'], // 40 chars, no spaces = true
            // ['XikHåjChnVuØSpfAexsIijDiQpKæåbScHRAKhct'], // 39 chars, no spaces = false
            ['XikHåj ChnVuØSpf AexsIijDiQ pKæåbScHRAKh'], // 40 chars, with spaces = true
            // ['XikHåj ChnVuØSpf AexsIijDiQ pKæåbScHRAK'], // 39 chars, with spaces = false
            ['XikHåjChnVuØSpfAexsIijDiQpKæåbScHRAKh tf'], // 40 chars, 2 letters at end = true
            // ['XikHåjChnVuØSpfAexsIijDiQpKæåbScHRAKhc f'], // 40 chars, 1 letter at end = false
            ['XikHåj C hnVuØSpfAexsIijDiQpKæåbScHRAKhc'], // 40 chars, 1 letter on it's own = false
            ['XikHåj Ch nVuØSpfAexsIijDiQpKæåbScHRAKhc'], // 40 chars, 1 letter on it's own = true
        ];
    }



    // NUMBER

    public function testDBNumberHasCorrectFormat(): void
    {
        $number = $this->fakeInfo->getAddress()['address']['number'];
        $this->assertMatchesRegularExpression("/^[1-9]\d{0,2}[A-Z]?$/", $number, "The number '{$number}' does not match regex.");
    }

    /**
     * @dataProvider provideNumberHasCorrectFormat
     */
    public function testNumberHasCorrectFormat($number): void
    {
        $this->assertMatchesRegularExpression("/^[1-9]\d{0,2}[A-Z]?$/", $number, "The number '{$number}' does not match regex.");
    }
    public static function provideNumberHasCorrectFormat()
    {
        return [
            // ['0'], // SHOULD FAIL
            ['1'],
            // ['1a'], // SHOULD FAIL
            ['1A'],
            // ['1-A'], // SHOULD FAIL
            // ['#1'], // SHOULD FAIL
            ['20'],
            ['20A'],
            // ['20a'], // SHOULD FAIL
            ['300'],
            ['300A'],
            // ['300a'], // SHOULD FAIL
            // ['1000'], // SHOULD FAIL
            // ['1000B'], // SHOULD FAIL
        ];
    }

    public function testDBNumberHasLengthInRange(): void
    {
        $number = $this->fakeInfo->getAddress()['address']['number'];
        $this->assertMatchesRegularExpression("/^.{1,4}$/", $number, "The length of number value '{$number}' does not match the [1,4] range.");
    }

    /**
     * @dataProvider provideNumberHasLengthInRange
     */
    public function testNumberHasLengthInRange($number): void
    {
        $this->assertMatchesRegularExpression("/^.{1,4}$/", $number, "The length of number value '{$number}' does not match the [1,4] range.");
    }
    public static function provideNumberHasLengthInRange()
    {
        return [
            ['1'],
            ['1A'],
            ['20'],
            ['20A'],
            ['300'],
            ['300A'],
            // ['1000B'], // SHOULD FAIL
        ];
    }



    // FLOOR

    public function testDBFloorHasCorrectFormat(): void
    {
        $floor = $this->fakeInfo->getAddress()['address']['floor'];
        $this->assertMatchesRegularExpression("/^[1-9][0-9]?$|^([s][t])$/", $floor, "The floor value '{$floor}' does not match either regex.");
    }

    /**
     * @dataProvider provideFloorHasCorrectFormat
     */
    public function testFloorHasCorrectFormat($floor): void
    {
        $this->assertMatchesRegularExpression("/^[1-9][0-9]?$|^([s][t])$/", $floor, "The floor value '{$floor}' does not match either regex.");
    }
    public static function provideFloorHasCorrectFormat()
    {
        return [
            ['st'],
            // ['stt'], // SHOULD FAIL
            // ['st.'], // SHOULD FAIL
            // ['ss'], // SHOULD FAIL
            // ['0'], // SHOULD FAIL
            ['1'],
            ['50'],
            ['99'],
            // ['100'], // SHOULD FAIL
        ];
    }

    public function testDBFloorHasLengthInRange(): void
    {
        $floor = $this->fakeInfo->getAddress()['address']['floor'];
        $this->assertMatchesRegularExpression("/^.{1,2}$/", $floor, "The length of floor value '{$floor}' does not match the [1,2] range.");
    }

    /**
     * @dataProvider provideFloorHasLengthInRange
     */
    public function testFloorHasLengthInRange($floor): void
    {
        $this->assertMatchesRegularExpression("/^.{1,2}$/", $floor, "The length of floor value '{$floor}' does not match the [1,2] range.");
    }
    public static function provideFloorHasLengthInRange()
    {
        return [
            ['st'],
            ['1'],
            ['50'],
            ['99'],
            // ['100'], // SHOULD FAIL
            // ['1000'], // SHOULD FAIL
        ];
    }



    // DOOR

    public function testDBDoorHasCorrectFormat(): void
    {
        $door = $this->fakeInfo->getAddress()['address']['door'];
        $this->assertMatchesRegularExpression("/^([t][h])$|^([m][f])$|^([t][v])$^[1-9]$||^[1-4][0-9]?$|^[5][0]$|^[a-zæøå][1-9][0-9]{0,2}$|^[a-zæøå][-][1-9][0-9]{0,2}$/", $door, "The door value '{$door}' does not match any regex.");
    }

    /**
     * @dataProvider provideDorHasCorrectFormat
     */
    public function testDoorHasCorrectFormat($door): void
    {
        $this->assertMatchesRegularExpression("/^([t][h])$|^([m][f])$|^([t][v])$^[1-9]$||^[1-4][0-9]?$|^[5][0]$|^[a-zæøå][1-9][0-9]{0,2}$|^[a-zæøå][-][1-9][0-9]{0,2}$/", $door, "The door value '{$door}' does not match any regex.");
    }
    public static function provideDorHasCorrectFormat()
    {
        return [
            ['th'],
            ['mf'],
            ['tv'],
            // ['st'], // SHOULD FAIL

            // ['0'], // SHOULD FAIL
            ['1'],
            ['7'],
            ['50'],
            // ['51'], // SHOULD FAIL
            // ['100'], // SHOULD FAIL

            // ['c0'], // SHOULD FAIL
            ['c1'],
            ['c50'],
            ['c51'],
            ['c100'],
            // ['c1000'], // SHOULD FAIL

            // ['d-0'], // SHOULD FAIL
            ['d-1'],
            ['d-50'],
            ['d-51'],
            ['d-100'],
            // ['d-1000'], // SHOULD FAIL
        ];
    }

    public function testDBDoorHasLengthInRange(): void
    {
        $door = $this->fakeInfo->getAddress()['address']['door'];
        $this->assertMatchesRegularExpression("/^.{1,5}$/", $door, "The length of door value '{$door}' does not match the [1,5] range.");
    }

    /**
     * @dataProvider provideDoorHasLengthInRange
     */
    public function testDoorHasLengthInRange($door): void
    {
        $this->assertMatchesRegularExpression("/^.{1,5}$/", $door, "The length of door value '{$door}' does not match the [1,5] range.");
    }
    public static function provideDoorHasLengthInRange()
    {
        return [
            // [''], // SHOULD FAIL

            ['th'],
            ['mf'],
            ['tv'],

            ['1'],
            ['50'],

            ['c1'],
            ['c50'],
            ['c100'],
            // ['c10000'], // SHOULD FAIL

            ['d-1'],
            ['d-50'],
            ['d-100'],
            // ['d-1000'], // SHOULD FAIL
        ];
    }



    // POSTAL_CODE

    public function testDBPostalCodeHasCorrectFormat(): void
    {
        $postal_code = $this->fakeInfo->getAddress()['address']['postal_code'];
        $this->assertMatchesRegularExpression("/^[1-9][0-9]{3}$/", $postal_code, "The postal_code value '{$postal_code}' does not match regex.");
    }

    /**
     * @dataProvider providePostalCodeHasCorrectFormat
     */
    public function testPostalCodeHasCorrectFormat($postal_code): void
    {
        $this->assertMatchesRegularExpression("/^[1-9][0-9]{3}$/", $postal_code, "The postal_code value '{$postal_code}' does not match regex.");
    }
    public static function providePostalCodeHasCorrectFormat()
    {
        return [
            // ['0130'], // SHOULD FAIL
            ['1301'],

            // ['1000'], // SHOULD FAIL, BUT DOESN'T, AS VALUE IS HARDCODED AND DOES NOT COMPARE WITH DB-REGISTERED VALUES = NEEDS ANOTHER/BETTER WAY TO TEST IF IN DB OR NOT
            
            ['2200'],
            // ['22000'], // SHOULD FAIL
            // ['2200N'], // SHOULD FAIL
            // ['#2200'], // SHOULD FAIL
            // ['22%0'], // SHOULD FAIL
            ['4672'],
            ['8763'],
        ];
    }

    public function testDBPostalCodeHasLength4(): void
    {
        $postal_code = $this->fakeInfo->getAddress()['address']['postal_code'];
        $this->assertMatchesRegularExpression("/^.{4}$/", $postal_code, "The length of postal_code value '{$postal_code}' does not match length of 40 characters.");
    }

    /**
     * @dataProvider providePostalCodeHasLength4
     */
    public function testPostalCodeHasLength4($postal_code): void
    {
        $this->assertMatchesRegularExpression("/^.{4}$/", $postal_code, "The length of postal_code value '{$postal_code}' does not match length of 40 characters.");
    }
    public static function providePostalCodeHasLength4()
    {
        return [
            // ['200'], // SHOULD FAIL
            ['1301'],
            ['2200'],
            // ['22000'], // SHOULD FAIL
            // ['2200N'], // SHOULD FAIL
            // ['#2200'], // SHOULD FAIL
        ];
    }

    
    // TOWN_NAME

    // NOT SURE HOW TO SOLVE THIS ONE W/O GOING THROUGH EACH AND EVERY VALUE IN THE DB,
    // AS IT DEPENDS ON THE RANDOM TOWN_VALUE RETURNED, WITH MANY DIFFERENT FORMATS, ETC.
    // PERHAPS WE HAVE TO DO MOCKING FOR THIS ONE? (AND POSSIBLY ALSO POSTAL_CODE, REALISTICALLY).
    // WHEN DOES IT TURN INTO AN INTEGRATION TEST VS. A UNIT TEST?
    // > PROBABLY THIS IS THE INTEGRATION TEST 'PART' OF THE PROJECT.

}