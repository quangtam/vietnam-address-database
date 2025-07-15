# Vietnam Address Database

Raw JSON database for Vietnamese administrative addresses according to Resolution 202/2025/QH15.

This repository provides the same database for both **JavaScript/TypeScript** and **PHP** platforms.

## Quick Start

### JavaScript/TypeScript

```bash
npm install vietnam-address-database
```

```javascript
const addressData = require('vietnam-address-database');
console.log(addressData[0].version); // "1.1"
```

### PHP

```bash
composer require quangtam/vietnam-address-database
```

```php
use VietnamAddressDatabase\VietnamAddressDatabase;
$provinces = VietnamAddressDatabase::getProvinces();
```

## Database Statistics

- **34 provinces** (tỉnh/thành phố)
- **3,321 wards** (phường/xã)
- **10,977 ward mappings** (ánh xạ mã cũ sang mới theo Resolution 202/2025/QH15)

## Platform-Specific Documentation

- **[JavaScript/TypeScript Documentation](README-JS.md)**
- **[PHP Documentation](README-PHP.md)**

## Publishing

See **[PUBLISHING.md](PUBLISHING.md)** for detailed publishing instructions for both platforms.

## Data Source

This database is based on **Resolution 202/2025/QH15** and contains the most up-to-date Vietnamese administrative addresses.

## License

MIT

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
