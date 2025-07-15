<?php

namespace VietnamAddressDatabase;

/**
 * Vietnam Address Database
 * 
 * Raw JSON database for Vietnamese administrative addresses according to Resolution 202/2025/QH15
 * This class provides access to the raw database data.
 */
class VietnamAddressDatabase
{
    /**
     * @var array|null Cached database data
     */
    private static $data = null;

    /**
     * Get the raw database data
     * 
     * @return array The complete database array
     */
    public static function getData(): array
    {
        if (self::$data === null) {
            $jsonPath = __DIR__ . '/../address.json';
            
            if (!file_exists($jsonPath)) {
                throw new \RuntimeException('Address database file not found: ' . $jsonPath);
            }
            
            $jsonContent = file_get_contents($jsonPath);
            if ($jsonContent === false) {
                throw new \RuntimeException('Failed to read address database file');
            }
            
            self::$data = json_decode($jsonContent, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \RuntimeException('Invalid JSON in address database: ' . json_last_error_msg());
            }
        }
        
        return self::$data;
    }

    /**
     * Get header information
     * 
     * @return array|null Header data or null if not found
     */
    public static function getHeader(): ?array
    {
        $data = self::getData();
        foreach ($data as $item) {
            if (isset($item['type']) && $item['type'] === 'header') {
                return $item;
            }
        }
        return null;
    }

    /**
     * Get database version
     * 
     * @return string|null Database version or null if not found
     */
    public static function getVersion(): ?string
    {
        $header = self::getHeader();
        return $header['version'] ?? null;
    }

    /**
     * Get provinces data
     * 
     * @return array Array of province objects
     */
    public static function getProvinces(): array
    {
        return self::getTableData('provinces');
    }

    /**
     * Get wards data
     * 
     * @return array Array of ward objects
     */
    public static function getWards(): array
    {
        return self::getTableData('wards');
    }

    /**
     * Get ward mappings data
     * 
     * @return array Array of ward mapping objects
     */
    public static function getWardMappings(): array
    {
        return self::getTableData('ward_mappings');
    }

    /**
     * Get data for a specific table
     * 
     * @param string $tableName Name of the table to retrieve
     * @return array Array of table data or empty array if not found
     */
    public static function getTableData(string $tableName): array
    {
        $data = self::getData();
        foreach ($data as $item) {
            if (isset($item['type']) && $item['type'] === 'table' && 
                isset($item['name']) && $item['name'] === $tableName) {
                return $item['data'] ?? [];
            }
        }
        return [];
    }

    /**
     * Find province by province code
     * 
     * @param string $code Province code
     * @return array|null Province data or null if not found
     */
    public static function getProvinceByCode(string $code): ?array
    {
        $provinces = self::getProvinces();
        foreach ($provinces as $province) {
            if (isset($province['province_code']) && $province['province_code'] === $code) {
                return $province;
            }
        }
        return null;
    }

    /**
     * Find ward by ward code
     * 
     * @param string $code Ward code
     * @return array|null Ward data or null if not found
     */
    public static function getWardByCode(string $code): ?array
    {
        $wards = self::getWards();
        foreach ($wards as $ward) {
            if (isset($ward['ward_code']) && $ward['ward_code'] === $code) {
                return $ward;
            }
        }
        return null;
    }

    /**
     * Get wards by province code
     * 
     * @param string $provinceCode Province code
     * @return array Array of wards in the province
     */
    public static function getWardsByProvinceCode(string $provinceCode): array
    {
        $wards = self::getWards();
        return array_filter($wards, function($ward) use ($provinceCode) {
            return isset($ward['province_code']) && $ward['province_code'] === $provinceCode;
        });
    }

    /**
     * Search provinces by name (case-insensitive, partial match)
     * 
     * @param string $query Search query
     * @return array Array of matching provinces
     */
    public static function searchProvinces(string $query): array
    {
        $provinces = self::getProvinces();
        $lowerQuery = mb_strtolower($query, 'UTF-8');
        
        return array_filter($provinces, function($province) use ($lowerQuery) {
            $name = mb_strtolower($province['name'] ?? '', 'UTF-8');
            $shortName = mb_strtolower($province['short_name'] ?? '', 'UTF-8');
            
            return mb_strpos($name, $lowerQuery, 0, 'UTF-8') !== false ||
                   mb_strpos($shortName, $lowerQuery, 0, 'UTF-8') !== false;
        });
    }

    /**
     * Search wards by name (case-insensitive, partial match)
     * 
     * @param string $query Search query
     * @param string|null $provinceCode Optional province code to filter results
     * @return array Array of matching wards
     */
    public static function searchWards(string $query, ?string $provinceCode = null): array
    {
        $wards = self::getWards();
        $lowerQuery = mb_strtolower($query, 'UTF-8');
        
        $filtered = array_filter($wards, function($ward) use ($lowerQuery, $provinceCode) {
            $name = mb_strtolower($ward['name'] ?? '', 'UTF-8');
            $nameMatch = mb_strpos($name, $lowerQuery, 0, 'UTF-8') !== false;
            
            if ($provinceCode !== null) {
                return $nameMatch && isset($ward['province_code']) && $ward['province_code'] === $provinceCode;
            }
            
            return $nameMatch;
        });
        
        return array_values($filtered);
    }

    /**
     * Find new ward code from old ward code using mappings
     * 
     * @param string $oldWardCode Old ward code
     * @return string|null New ward code or null if not found
     */
    public static function findNewWardCode(string $oldWardCode): ?string
    {
        $mappings = self::getWardMappings();
        foreach ($mappings as $mapping) {
            if (isset($mapping['old_ward_code']) && $mapping['old_ward_code'] === $oldWardCode) {
                return $mapping['new_ward_code'] ?? null;
            }
        }
        return null;
    }

    /**
     * Clear cached data (useful for testing)
     */
    public static function clearCache(): void
    {
        self::$data = null;
    }
}
