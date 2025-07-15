<?php

use PHPUnit\Framework\TestCase;
use VietnamAddressDatabase\VietnamAddressDatabase;

class VietnamAddressDatabaseTest extends TestCase
{
    protected function setUp(): void
    {
        // Clear cache before each test
        VietnamAddressDatabase::clearCache();
    }

    public function testGetData()
    {
        $data = VietnamAddressDatabase::getData();
        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }

    public function testGetHeader()
    {
        $header = VietnamAddressDatabase::getHeader();
        $this->assertIsArray($header);
        $this->assertEquals('header', $header['type']);
        $this->assertArrayHasKey('version', $header);
    }

    public function testGetVersion()
    {
        $version = VietnamAddressDatabase::getVersion();
        $this->assertIsString($version);
        $this->assertNotEmpty($version);
    }

    public function testGetProvinces()
    {
        $provinces = VietnamAddressDatabase::getProvinces();
        $this->assertIsArray($provinces);
        $this->assertNotEmpty($provinces);
        $this->assertCount(34, $provinces);
        
        // Test first province structure
        $firstProvince = $provinces[0];
        $this->assertArrayHasKey('id', $firstProvince);
        $this->assertArrayHasKey('province_code', $firstProvince);
        $this->assertArrayHasKey('name', $firstProvince);
    }

    public function testGetWards()
    {
        $wards = VietnamAddressDatabase::getWards();
        $this->assertIsArray($wards);
        $this->assertNotEmpty($wards);
        
        // Test first ward structure
        $firstWard = $wards[0];
        $this->assertArrayHasKey('id', $firstWard);
        $this->assertArrayHasKey('ward_code', $firstWard);
        $this->assertArrayHasKey('name', $firstWard);
        $this->assertArrayHasKey('province_code', $firstWard);
    }

    public function testGetWardMappings()
    {
        $mappings = VietnamAddressDatabase::getWardMappings();
        $this->assertIsArray($mappings);
        $this->assertNotEmpty($mappings);
        
        // Test first mapping structure
        $firstMapping = $mappings[0];
        $this->assertArrayHasKey('old_ward_code', $firstMapping);
        $this->assertArrayHasKey('new_ward_code', $firstMapping);
        $this->assertArrayHasKey('old_ward_name', $firstMapping);
        $this->assertArrayHasKey('new_ward_name', $firstMapping);
    }

    public function testGetProvinceByCode()
    {
        $hanoi = VietnamAddressDatabase::getProvinceByCode('01');
        $this->assertIsArray($hanoi);
        $this->assertEquals('01', $hanoi['province_code']);
        $this->assertStringContainsString('Hà Nội', $hanoi['name']);
        
        $notFound = VietnamAddressDatabase::getProvinceByCode('99');
        $this->assertNull($notFound);
    }

    public function testGetWardByCode()
    {
        $ward = VietnamAddressDatabase::getWardByCode('00004');
        $this->assertIsArray($ward);
        $this->assertEquals('00004', $ward['ward_code']);
        
        $notFound = VietnamAddressDatabase::getWardByCode('99999');
        $this->assertNull($notFound);
    }

    public function testGetWardsByProvinceCode()
    {
        $hanoiWards = VietnamAddressDatabase::getWardsByProvinceCode('01');
        $this->assertIsArray($hanoiWards);
        $this->assertNotEmpty($hanoiWards);
        
        // All wards should belong to Hanoi
        foreach ($hanoiWards as $ward) {
            $this->assertEquals('01', $ward['province_code']);
        }
    }

    public function testSearchProvinces()
    {
        $results = VietnamAddressDatabase::searchProvinces('hà nội');
        $this->assertIsArray($results);
        $this->assertNotEmpty($results);
        
        $results = VietnamAddressDatabase::searchProvinces('xyz');
        $this->assertIsArray($results);
        $this->assertEmpty($results);
    }

    public function testSearchWards()
    {
        $results = VietnamAddressDatabase::searchWards('ba đình');
        $this->assertIsArray($results);
        
        $resultsWithProvince = VietnamAddressDatabase::searchWards('ba đình', '01');
        $this->assertIsArray($resultsWithProvince);
        
        foreach ($resultsWithProvince as $ward) {
            $this->assertEquals('01', $ward['province_code']);
        }
    }

    public function testFindNewWardCode()
    {
        $mappings = VietnamAddressDatabase::getWardMappings();
        if (!empty($mappings)) {
            $firstMapping = $mappings[0];
            $oldCode = $firstMapping['old_ward_code'];
            $expectedNewCode = $firstMapping['new_ward_code'];
            
            $newCode = VietnamAddressDatabase::findNewWardCode($oldCode);
            $this->assertEquals($expectedNewCode, $newCode);
        }
        
        $notFound = VietnamAddressDatabase::findNewWardCode('99999');
        $this->assertNull($notFound);
    }
}
