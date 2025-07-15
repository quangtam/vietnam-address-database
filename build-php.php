#!/usr/bin/env php
<?php

echo "Building PHP package...\n";

// Validate address.json exists and is valid JSON
$addressPath = __DIR__ . '/address.json';
if (!file_exists($addressPath)) {
    echo "Error: address.json not found!\n";
    exit(1);
}

try {
    $jsonContent = file_get_contents($addressPath);
    if ($jsonContent === false) {
        throw new Exception('Failed to read address.json');
    }
    
    $addressData = json_decode($jsonContent, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON in address.json: ' . json_last_error_msg());
    }
    
    echo "✓ address.json is valid JSON\n";
    
    // Count records
    $provinceCount = 0;
    $wardCount = 0;
    $wardMappingCount = 0;
    
    foreach ($addressData as $item) {
        if (isset($item['type']) && $item['type'] === 'table') {
            if (isset($item['name'])) {
                if ($item['name'] === 'provinces') {
                    $provinceCount = count($item['data'] ?? []);
                } elseif ($item['name'] === 'wards') {
                    $wardCount = count($item['data'] ?? []);
                } elseif ($item['name'] === 'ward_mappings') {
                    $wardMappingCount = count($item['data'] ?? []);
                }
            }
        }
    }
    
    echo "✓ Found {$provinceCount} provinces\n";
    echo "✓ Found {$wardCount} wards\n";
    echo "✓ Found {$wardMappingCount} ward mappings\n";
    
    // Copy PHP README
    if (file_exists('README-PHP.md')) {
        copy('README-PHP.md', 'README.md');
        echo "✓ Copied PHP README\n";
    }
    
    echo "✓ PHP build completed successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
