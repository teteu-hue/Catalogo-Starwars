<?php

namespace App\Utils;

class Cache
{
    private static $cacheExpiration = 3600;
    private static $basePath = __DIR__ . '/cache/';

    private static function getCacheFilename($endpoint, $params = [])
    {
        
        // Caso o diretorio nao existe, cria dinamicamente.
        if(!is_dir(self::$basePath)){
            mkdir(self::$basePath, 0777, true);
        }

        $key = $endpoint . '_' . md5(json_encode($params));
        return self::$basePath . $key .  '.json';
    }

    public static function getFromCache($endpoint, $params = [])
    {
        $filename = self::getCacheFilename($endpoint, $params);

        if(file_exists($filename)){
            $cacheTime = filemtime($filename);
            $currentTime = time();

            if(($currentTime - $cacheTime) < self::$cacheExpiration){
                return json_decode(file_get_contents($filename), true);
            }
        }
        return null;
    }

    public static function saveToCache($endpoint, $data, $params = [])
    {
        $filename = self::getCacheFilename($endpoint, $params);
        error_log("Tentando salvar no caminho: $filename");

        if(file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT)) == false){
            throw new \Exception("Failed to write cache file: " . $filename);
        }
    }

    public static function clearCache($endpoint, $params = [])
    {
        $filename = self::getCacheFilename($endpoint, $params);

        if(file_exists($filename)){
            unlink($filename);
        }
    }

    public static function clearAllCache()
    {
        $files = glob(self::$basePath, '*.json');

        foreach($files as $file){
            unlink($file);
        }
    }
}

$testFile = '/tmp/test_cache.txt';
file_put_contents($testFile, 'Test data');
