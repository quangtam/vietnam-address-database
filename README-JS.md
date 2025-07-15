# Vietnam Address Database (JavaScript/TypeScript)

Raw JSON database for Vietnamese administrative addresses according to Resolution 202/2025/QH15.

This package contains only the raw database and is designed to be used as a dependency in other JavaScript/TypeScript libraries.

## Installation

```bash
npm install vietnam-address-database
```

## Usage

### CommonJS

```javascript
const addressData = require('vietnam-address-database');
console.log(addressData[0].version); // "1.1"
```

### ES Modules

```javascript
import addressData from 'vietnam-address-database';
console.log(addressData[0].version); // "1.1"
```

### Usage in other libraries

This package is designed to be required/imported in other libraries:

```javascript
// In your address processing library
const vietnamAddressDB = require('vietnam-address-database');

// Parse the data structure
let provinces = [];
let wards = [];
let wardMappings = [];

vietnamAddressDB.forEach(item => {
  if (item.type === 'table') {
    if (item.name === 'provinces') {
      provinces = item.data;
    } else if (item.name === 'wards') {
      wards = item.data;
    } else if (item.name === 'ward_mappings') {
      wardMappings = item.data;
    }
  }
});

// Now you can implement your own functions
function getProvinces() {
  return provinces;
}

function getProvinceByCode(code) {
  return provinces.find(p => p.province_code === code);
}

function getWardMappings() {
  return wardMappings;
}
```

## Data Structure

The exported data is an array with the following structure:

### Header
```javascript
{
  "type": "header",
  "version": "1.1",
  "comment": "JSON database for JavaScript/ TypeScript library..."
}
```

### Database Info
```javascript
{
  "type": "database",
  "name": "address"
}
```

### Provinces Table
```javascript
{
  "type": "table",
  "name": "provinces",
  "database": "address",
  "data": [
    {
      "id": "1",
      "province_code": "01",
      "name": "Thành phố Hà Nội",
      "short_name": "Thành phố Hà Nội",
      "code": "HNI",
      "place_type": "Thành phố Trung Ương",
      "country": "VN",
      "created_at": null,
      "updated_at": null
    }
    // ... more provinces
  ]
}
```

### Wards Table
```javascript
{
  "type": "table",
  "name": "wards", 
  "database": "address",
  "data": [
    {
      "id": "1",
      "ward_code": "00004",
      "name": "Phường Ba Đình",
      "province_code": "01",
      "created_at": null,
      "updated_at": null
    }
    // ... more wards
  ]
}
```

### Ward Mappings Table
```javascript
{
  "type": "table",
  "name": "ward_mappings",
  "database": "address", 
  "data": [
    {
      "id": "1",
      "old_ward_code": "26881",
      "old_ward_name": "Phường 12",
      "old_district_name": "Quận Gò Vấp",
      "old_province_name": "Thành phố Hồ Chí Minh",
      "new_ward_code": "26882",
      "new_ward_name": "Phường An Hội Tây",
      "new_province_name": "Thành phố Hồ Chí Minh",
      "created_at": "2025-07-02 14:28:29",
      "updated_at": "2025-07-02 14:28:29"
    }
    // ... more mappings
  ]
}
```

## TypeScript Support

This package includes TypeScript type definitions:

```typescript
import addressData, { Province, Ward, WardMapping, DatabaseItem } from 'vietnam-address-database';

const data: DatabaseItem[] = addressData;
```

## Testing

```bash
npm test
```

## Data Source

This database is based on Resolution 202/2025/QH15 and contains the most up-to-date Vietnamese administrative addresses.

- **34 provinces** (tỉnh/thành phố)
- **3,321 wards** (phường/xã)
- **10,977 ward mappings** (ánh xạ mã cũ sang mới)

## License

MIT

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
