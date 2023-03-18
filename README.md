# Fake Data Generator

## Purpose
Sample PHP class that generates fake data of nonexistent Danish persons.

## Installation

1. The script `db/addresses.sql` must be run. It will create the MariaDB/MySQL database `addresses`.
2. The file `info/info.php` contains default database values. It may be necessary to update it with the database configuration in use.

## Class `FakeInfo` - Public methods

- `getCPR(): string`
- `getFullNameAndGender(): array`
- `getFullNameGenderAndBirthDate(): array`
- `getPhoneNumber(): string`
- `getFakePerson(): array`
- `getFakePersons(): array`

## Sample Output

```php
echo '<pre>';
$fakeInfo = new FakeInfo;
print_r($fakeInfo->getFakePersons());
```

Output
```php
Array
(
    [CPR] => 1909743965
    [firstName] => Anton D.
    [lastName] => Jespersen
    [gender] => male
    [birthDate] => 1974-09-19
    [address] => Array
        (
            [street] => WTquWUqMiHLBKXcEÆnMpqhdGæzlrødfAAAJuGGXø
            [number] => 456
            [floor] => 61
            [door] => th
            [postal_code] => 3650
            [town_name] => Ølstykke
        )
    [phoneNumber] => 55129415
)
```

## Tools
PHP8 / MariaDB

## Author
Arturo Mora-Rioja (amri@kea.dk)