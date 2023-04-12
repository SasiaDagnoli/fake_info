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
$test = $fakeInfo->getFullNameGenderAndBirthDate();
/* print_r($test["birthDate"]); */
echo $test["birthDate"];
echo "<br>";
echo substr($test["birthDate"], 2, 2);
echo "<br>";
print_r($fakeInfo->getFullNameGenderAndBirthDate());
print_r($fakeInfo);
echo substr($fakeInfo->getCpr(), 0, 2);
