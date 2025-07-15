const fs = require('fs');
const path = require('path');

console.log('Building JavaScript package...');

// Validate address.json exists and is valid JSON
const addressPath = path.join(__dirname, 'address.json');
if (!fs.existsSync(addressPath)) {
  console.error('Error: address.json not found!');
  process.exit(1);
}

try {
  const addressData = JSON.parse(fs.readFileSync(addressPath, 'utf8'));
  console.log('✓ address.json is valid JSON');
  
  // Count records
  let provinceCount = 0;
  let wardCount = 0;
  let wardMappingCount = 0;
  
  addressData.forEach(item => {
    if (item.type === 'table') {
      if (item.name === 'provinces') {
        provinceCount = item.data.length;
      } else if (item.name === 'wards') {
        wardCount = item.data.length;
      } else if (item.name === 'ward_mappings') {
        wardMappingCount = item.data.length;
      }
    }
  });
  
  console.log(`✓ Found ${provinceCount} provinces`);
  console.log(`✓ Found ${wardCount} wards`);
  console.log(`✓ Found ${wardMappingCount} ward mappings`);
  
  // Copy JS README
  if (fs.existsSync('README-JS.md')) {
    fs.copyFileSync('README-JS.md', 'README.md');
    console.log('✓ Copied JavaScript README');
  }
  
  console.log('✓ JavaScript build completed successfully!');
  
} catch (error) {
  console.error('Error: Invalid JSON in address.json');
  console.error(error.message);
  process.exit(1);
}
