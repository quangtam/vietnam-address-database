# Publishing Guide

This repository contains both JavaScript/TypeScript and PHP packages sharing the same database.

## Structure

```
vietnam-address-database/
├── package.json          # NPM package configuration
├── composer.json          # Composer package configuration
├── address.json           # Shared database
├── index.js              # JavaScript entry point
├── index.d.ts            # TypeScript definitions
├── src/                  # PHP source code
├── tests/                # PHP tests
├── README.md             # Main repository documentation
├── README-JS.md          # JavaScript documentation
├── README-PHP.md         # PHP documentation
├── build-js.js           # JavaScript build script
├── build-php.php         # PHP build script
└── test-all.sh           # Cross-platform test script
```

## Publishing JavaScript Package to NPM

1. **Build JavaScript package:**
   ```bash
   npm run build
   ```
   This will copy `README-JS.md` to `README.md`

2. **Test JavaScript package:**
   ```bash
   npm test
   ```

3. **Publish to NPM:**
   ```bash
   npm publish
   ```

The published NPM package will only include:
- `index.js`
- `index.d.ts` 
- `address.json`
- `README.md` (JavaScript version)

## Publishing PHP Package to Packagist

1. **Build PHP package:**
   ```bash
   composer run build
   # or: php build-php.php
   ```
   This will copy `README-PHP.md` to `README.md`

2. **Test PHP package:**
   ```bash
   composer run test
   # or: php test-php.php
   ```

3. **Create release tag:**
   ```bash
   git add .
   git commit -m "Release v1.0.0"
   git tag v1.0.0
   git push origin v1.0.0
   ```

4. **Submit to Packagist:**
   - Go to https://packagist.org/packages/submit
   - Enter your repository URL
   - Packagist will automatically exclude JavaScript files based on `composer.json` archive settings

The published Composer package will only include:
- `src/` (PHP source code)
- `tests/` (PHP tests)
- `address.json`
- `composer.json`
- `phpunit.xml`
- `README.md` (PHP version)

## Files Excluded by Platform

### NPM (excludes PHP files)
- `src/`
- `tests/` 
- `composer.json`
- `phpunit.xml`
- `test-php.php`
- `build-php.php`
- `README-PHP.md`

### Composer (excludes JavaScript files)  
- `index.js`
- `index.d.ts`
- `package.json`
- `test.js`
- `build-js.js`
- `README-JS.md`
- `node_modules/`

## Testing Both Platforms

Run comprehensive tests:
```bash
./test-all.sh
```

## Notes

- Both platforms share the same `address.json` database
- Each platform has its own README that gets copied during build
- Build scripts ensure the correct README is used for each platform
- Archive/files configuration ensures clean package distribution
