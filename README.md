# Vietnam Address Database

Raw JSON database for Vietnamese administrative addresses according to Resolution 202/2025/QH15.

This repository provides the same database for both **JavaScript/TypeScript** and **PHP** platforms.

## Version 1.0.0 - First Release

✓ **34 Tỉnh/Thành phố** (Provinces/Cities)  
✓ **3,321 Phường/Xã** (Wards/Communes)  
✓ **10,977 quy tắc mapping** (Mapping rules)

### Data Sources

This database integrates data from two major administrative updates:

- **Resolution 202/2025/QH15** (effective from July 1, 2025)
- **Resolution NQ-UBTVQH15** (effective from January 1, 2025)

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

- **34 Tỉnh/Thành phố** (Provinces/Cities)  
- **3,321 Phường/Xã** (Wards/Communes)  
- **10,977 quy tắc mapping** (ánh xạ mã cũ sang mới)

### Administrative Updates Integration

This database reflects the latest Vietnamese administrative changes from:

- **Resolution 202/2025/QH15** (effective July 1, 2025)
- **Resolution NQ-UBTVQH15** (effective January 1, 2025)

## Platform-Specific Documentation

- **[JavaScript/TypeScript Documentation](README-JS.md)**
- **[PHP Documentation](README-PHP.md)**

## Publishing

See **[PUBLISHING.md](PUBLISHING.md)** for detailed publishing instructions for both platforms.

## Data Source

This database is based on **Resolution 202/2025/QH15** and contains the most up-to-date Vietnamese administrative addresses.

### Primary Sources

- **Data Repository**: [DVHCVN Database](https://github.com/thanhtrungit97/dvhcvn)
- **Legal Documents**: [Administrative Reorganization Resolutions 2023-2025](https://thuvienphapluat.vn/chinh-sach-phap-luat-moi/vn/ho-tro-phap-luat/chinh-sach-moi/72841/tong-hop-nghi-quyet-sap-xep-don-vi-hanh-chinh-cua-63-tinh-thanh-giai-doan-2023-2025)

### Legal Framework

The database integrates administrative changes from:

- **Resolution 202/2025/QH15** (effective July 1, 2025)
- **Resolution NQ-UBTVQH15** (effective January 1, 2025)
- **Comprehensive administrative reorganization resolutions for 63 provinces/cities (2023-2025)**

## License

MIT

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
