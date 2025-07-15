<?php

require_once __DIR__ . '/src/VietnamAddressDatabase.php';

use VietnamAddressDatabase\VietnamAddressDatabase;

echo "Testing Vietnam Address Database for PHP...\n";

try {
    // Test basic data loading
    $data = VietnamAddressDatabase::getData();
    if (!is_array($data) || empty($data)) {
        throw new Exception('Failed to load database');
    }
    echo "✓ Database loaded successfully\n";

    // Test version
    $version = VietnamAddressDatabase::getVersion();
    if (!$version) {
        throw new Exception('Failed to get version');
    }
    echo "✓ Version: {$version}\n";

    // Test provinces
    $provinces = VietnamAddressDatabase::getProvinces();
    if (!is_array($provinces) || empty($provinces)) {
        throw new Exception('Failed to get provinces');
    }
    echo "✓ Found " . count($provinces) . " provinces\n";

    // Test wards
    $wards = VietnamAddressDatabase::getWards();
    if (!is_array($wards) || empty($wards)) {
        throw new Exception('Failed to get wards');
    }
    echo "✓ Found " . count($wards) . " wards\n";

    // Test ward mappings
    $mappings = VietnamAddressDatabase::getWardMappings();
    if (!is_array($mappings) || empty($mappings)) {
        throw new Exception('Failed to get ward mappings');
    }
    echo "✓ Found " . count($mappings) . " ward mappings\n";

    // Test specific province
    $hanoi = VietnamAddressDatabase::getProvinceByCode('01');
    if (!$hanoi || !isset($hanoi['name'])) {
        throw new Exception('Failed to get Hanoi province');
    }
    echo "✓ Sample province: {$hanoi['name']}\n";

    // Test wards by province
    $hanoiWards = VietnamAddressDatabase::getWardsByProvinceCode('01');
    echo "✓ Hanoi has " . count($hanoiWards) . " wards\n";

    // Test search
    $searchResults = VietnamAddressDatabase::searchProvinces('hà nội');
    echo "✓ Search 'hà nội' found " . count($searchResults) . " results\n";

    // Test ward mapping
    if (!empty($mappings)) {
        $firstMapping = $mappings[0];
        $oldCode = $firstMapping['old_ward_code'];
        $newCode = VietnamAddressDatabase::findNewWardCode($oldCode);
        if ($newCode) {
            echo "✓ Sample mapping: {$firstMapping['old_ward_name']} → {$firstMapping['new_ward_name']}\n";
        }
    }

    echo "✅ All tests passed!\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
