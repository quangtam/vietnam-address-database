# Vietnam Address Database (PHP)

Raw JSON database for Vietnamese administrative addresses according to Resolution 202/2025/QH15.

This package provides a PHP library with convenient methods to work with Vietnamese administrative addresses.

## Version 1.0.0 - First Release

✓ **34 Tỉnh/Thành phố** (Provinces/Cities)  
✓ **3,321 Phường/Xã** (Wards/Communes)  
✓ **10,977 quy tắc mapping** (Mapping rules)

### Data Sources

This database integrates data from two major administrative updates:

- **Resolution 202/2025/QH15** (effective from July 1, 2025)
- **Resolution NQ-UBTVQH15** (effective from January 1, 2025)

## Installation

```bash
composer require quangtam/vietnam-address-database
```

## Usage

```php
<?php

use VietnamAddressDatabase\VietnamAddressDatabase;

// Get raw database
$data = VietnamAddressDatabase::getData();

// Get database version
$version = VietnamAddressDatabase::getVersion();

// Get all provinces
$provinces = VietnamAddressDatabase::getProvinces();

// Get all wards
$wards = VietnamAddressDatabase::getWards();

// Get ward mappings
$wardMappings = VietnamAddressDatabase::getWardMappings();

// Find province by code
$hanoi = VietnamAddressDatabase::getProvinceByCode('01');

// Find ward by code
$ward = VietnamAddressDatabase::getWardByCode('00004');

// Get wards by province
$hanoiWards = VietnamAddressDatabase::getWardsByProvinceCode('01');

// Search provinces
$results = VietnamAddressDatabase::searchProvinces('hà nội');

// Search wards
$wardResults = VietnamAddressDatabase::searchWards('ba đình', '01');

// Find new ward code from old code
$newCode = VietnamAddressDatabase::findNewWardCode('26881');
```

## API Reference

### Basic Methods

- `VietnamAddressDatabase::getData()` - Get raw database array
- `VietnamAddressDatabase::getVersion()` - Get database version
- `VietnamAddressDatabase::getHeader()` - Get header information

### Province Methods

- `VietnamAddressDatabase::getProvinces()` - Get all provinces
- `VietnamAddressDatabase::getProvinceByCode(string $code)` - Find province by code
- `VietnamAddressDatabase::searchProvinces(string $query)` - Search provinces by name

### Ward Methods

- `VietnamAddressDatabase::getWards()` - Get all wards  
- `VietnamAddressDatabase::getWardByCode(string $code)` - Find ward by code
- `VietnamAddressDatabase::getWardsByProvinceCode(string $provinceCode)` - Get wards by province
- `VietnamAddressDatabase::searchWards(string $query, ?string $provinceCode = null)` - Search wards

### Ward Mapping Methods

- `VietnamAddressDatabase::getWardMappings()` - Get all ward mappings
- `VietnamAddressDatabase::findNewWardCode(string $oldWardCode)` - Find new ward code from old code

## Data Structure

The database contains:

- **34 provinces** (tỉnh/thành phố)
- **3,321 wards** (phường/xã)  
- **10,977 ward mappings** (ánh xạ mã cũ sang mới)

### Province Object
```php
[
    'id' => '1',
    'province_code' => '01',
    'name' => 'Thành phố Hà Nội',
    'short_name' => 'Thành phố Hà Nội',
    'code' => 'HNI',
    'place_type' => 'Thành phố Trung Ương',
    'country' => 'VN',
    'created_at' => null,
    'updated_at' => null
]
```

### Ward Object
```php
[
    'id' => '1',
    'ward_code' => '00004',
    'name' => 'Phường Ba Đình',
    'province_code' => '01',
    'created_at' => null,
    'updated_at' => null
]
```

### Ward Mapping Object
```php
[
    'id' => '1',
    'old_ward_code' => '26881',
    'old_ward_name' => 'Phường 12',
    'old_district_name' => 'Quận Gò Vấp',
    'old_province_name' => 'Thành phố Hồ Chí Minh',
    'new_ward_code' => '26882',
    'new_ward_name' => 'Phường An Hội Tây', 
    'new_province_name' => 'Thành phố Hồ Chí Minh',
    'created_at' => '2025-07-02 14:28:29',
    'updated_at' => '2025-07-02 14:28:29'
]
```

## Testing

```bash
# Install dependencies
composer install

# Run PHPUnit tests
./vendor/bin/phpunit

# Or run simple test
php test-php.php
```

## Requirements

- PHP >= 7.4

## Data Source

This database is based on Resolution 202/2025/QH15 and contains the most up-to-date Vietnamese administrative addresses.

## License

MIT

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
