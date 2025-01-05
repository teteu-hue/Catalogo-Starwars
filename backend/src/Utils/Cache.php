<?php

namespace App\Utils;

class Cache
{
    private static $cacheExpiration = 604800; //  1 week
    private static $basePath = __DIR__ . '/cache/';

    /**
     * Gera o caminho do arquivo  de cache com base no endpoint e parâmetros.
     * Se o diretório de cache não existir, ele será criado automaticamente.
     * 
     * @param string $endpoint (ex: '/moveis' ou '/characters')
     * @param array $params[]
     * 
     * @return string caminho de cache gerado Utils/cache
     */
    private static function getCachePathname($endpoint, $params = [])
    {
        
        // Caso o diretorio nao existe, cria dinamicamente.
        if(!is_dir(self::$basePath)){
            mkdir(self::$basePath, 0777, true);
        }

        $key = $endpoint . '_' . md5(json_encode($params));
        return self::$basePath . $key .  '.json';
    }

    /**
     * se o arquivo de cache existir e não estiver expirado retorna os filmes do cache.
     * 
     * @param string $endpoint = '/movies' || '/characters'
     * @param array $params[]
     * 
     * @return json | null
     */
    public static function getFromCache($endpoint, $params = [])
    {
        $pathName = self::getCachePathname($endpoint, $params);

        if(file_exists($pathName)){
            $cacheTime = filemtime($pathName);
            $currentTime = time();

            if(($currentTime - $cacheTime) < self::$cacheExpiration){
                return json_decode(file_get_contents($pathName), true);
            }
        }
        return null;
    }

    /**
     * salva os dados no cache.
     * 
     * @param array $data -> dados que serão salvos no cache
     * @param string $endpoint
     * @param array $params
     * 
     */
    public static function saveToCache($endpoint, $data, $params = [])
    {
        $pathName = self::getCachePathname($endpoint, $params);
        
        if(file_put_contents($pathName, json_encode($data, JSON_PRETTY_PRINT)) == false){
            throw new \Exception("Failed to write cache file: " . $pathName);
        }
        error_log("Cache criado com sucesso!");
        error_log("Path: $pathName");
    }

    /**
     * @param string $endpoint
     * @param array $params
     * 
     * @return void;
     */

    public static function clearCache($endpoint, $params = [])
    {
        $pathName = self::getCachePathname($endpoint, $params);

        if(file_exists($pathName)){
            unlink($pathName);
        }
    }

    /**
     * Limpa todos os arquivos de cache dentro de Utils
     * 
     * @return void;
     */

    public static function clearAllCache()
    {
        $files = glob(self::$basePath, '*.json');

        if(!$files){
            echo "Não foram encontrados arquivos de cache";
        }

        foreach($files as $file){
            unlink($file);
        }
    }
}
