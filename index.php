<?php
require_once 'src/FakeInfo.php';
echo '<pre>';
$fakeInfo = new FakeInfo;
print_r($fakeInfo->getFakePerson());
