<?php

require_once 'src/DB.php';
require_once 'src/FakeInfo.php';
require_once 'src/Town.php';

// getCPR();
// getFullNameAndGender();
// getFullNameGenderAndBirthDate();
// getCprFullNameAndGender();
// getCprFullNameGenderAndBirthDate();
// getAddress();
// getPhoneNumber();
// getFakePerson();
// getFakePersons(int $amount);

echo '<pre>';
$fakeInfo = new FakeInfo;
print_r($fakeInfo->getAddress());

echo "\n";
echo "\n";
echo "Print:";
echo "\n";
print_r($fakeInfo->getAddress()["address"]);

echo "\n";
echo "\n";
echo "Print street:";
echo "\n";
print_r($fakeInfo->getAddress()["address"]["street"]);

echo "\n";
echo "\n";
echo "Print keys:";
echo "\n";
print_r(array_keys($fakeInfo->getAddress()["address"]));

echo "\n";
echo "\n";
echo "Print values:";
echo "\n";
print_r(array_values($fakeInfo->getAddress()["address"]));

echo "\n";
echo "\n";

$array = $fakeInfo->getAddress()["address"];
if (array_key_exists('street', $array)) {
    echo "The 'street' key is in the array";
} else {
        echo "The 'street' key is NOT in the array";
    }