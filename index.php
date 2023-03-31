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
print_r($fakeInfo->getFakePersons());