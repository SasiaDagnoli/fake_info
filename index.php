<?php

require_once 'src/FakeInfo.php';

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
print_r($fakeInfo->getFullNameAndGender());

echo $fakeInfo->getFullNameAndGender()['firstName'];