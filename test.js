const addressData = require('./index.js');

console.log('Testing vietnam-address-database...');

// Test basic structure
if (!Array.isArray(addressData)) {
  console.error('❌ Error: Export should be an array');
  process.exit(1);
}

console.log('✓ Export is an array');

// Find header
const header = addressData.find(item => item.type === 'header');
if (!header) {
  console.error('❌ Error: No header found');
  process.exit(1);
}

console.log(`✓ Found header with version: ${header.version}`);

// Find tables
const provinces = addressData.find(item => item.type === 'table' && item.name === 'provinces');
const wards = addressData.find(item => item.type === 'table' && item.name === 'wards');
const wardMappings = addressData.find(item => item.type === 'table' && item.name === 'ward_mappings');

if (!provinces) {
  console.error('❌ Error: No provinces table found');
  process.exit(1);
}

if (!wards) {
  console.error('❌ Error: No wards table found');
  process.exit(1);
}

if (!wardMappings) {
  console.error('❌ Error: No ward_mappings table found');
  process.exit(1);
}

console.log(`✓ Found ${provinces.data.length} provinces`);
console.log(`✓ Found ${wards.data.length} wards`);
console.log(`✓ Found ${wardMappings.data.length} ward mappings`);

// Test sample data
const hanoi = provinces.data.find(p => p.province_code === '01');
if (!hanoi) {
  console.error('❌ Error: Hanoi not found');
  process.exit(1);
}

console.log(`✓ Sample province: ${hanoi.name}`);

const hanoiWards = wards.data.filter(w => w.province_code === '01');
console.log(`✓ Hanoi has ${hanoiWards.length} wards`);

// Test ward mappings
const sampleMapping = wardMappings.data[0];
if (!sampleMapping.old_ward_code || !sampleMapping.new_ward_code) {
  console.error('❌ Error: Invalid ward mapping structure');
  process.exit(1);
}

console.log(`✓ Sample mapping: ${sampleMapping.old_ward_name} → ${sampleMapping.new_ward_name}`);

console.log('✅ All tests passed!');
