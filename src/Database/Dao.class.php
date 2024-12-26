<?php

namespace App\Database;

use Error;
use PDO;
use PDOException;

class Dao
{
    protected $connection;
    private $options = [];
    private string $dsn;
    private $file;

    public function __construct()
    {}

    private function setFile($file = 'config.ini')
    {
        $this->file = parse_ini_file($file);

        if(empty($this->file))
        {
            throw new Error("The 'config.ini' is empty");
        }
    }

    private function getFile()
    {
        $this->setFile();
        return $this->file;
    }

    private function setDsn()
    {
        $database = $this->getFile();

        $driver = $database['driver'];
        $dbname = $database['dbname'];
        $host = $database['host'];
        $port = $database['port'];

        $this->dsn = "$driver:host=$host;dbname=$dbname;port=$port";
    }

    private function getDsn()
    {
        $this->setDsn();
        return $this->dsn;
    }

    private function setOptions()
    {
        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::CASE_LOWER => true
        ];
    }

    private function getOptions()
    {
        $this->setOptions();
        return $this->options;
    }

    private function setConnection()
    {
        try {

            $database = $this->getFile();
            $username = $database['username'];
            $password = $database['password'];

            $dsn = $this->getDsn();
            $options = $this->getOptions();

            $this->connection = new PDO($dsn, $username, $password, $options);

        } catch(PDOException $e){
            echo "Erro ao conectar no banco de dados: \n";
            echo $e->getMessage();
        }
    }

    protected function getConnection()
    {
        $this->setConnection();
        return $this->connection;
    }

    protected function closeConnection()
    {
        $this->connection = null;
    }
    
    private function validateQuery($result)
    {   
        if($result->rowCount() < 0){
            throw new Error("Nenhum resultado encontrado!");
        }

        if($result->rowCount() == 1){
            return $result->fetch();
        }
        return $result->fetchAll();
    }

    // SELECT QUERYS
    protected function selectQuery($query, $params = null)
    {
        try {
            $this->getConnection();

            if($params == null){
                $stmt = $this->connection->prepare($query);
                $stmt->execute();
                $result = $stmt;
            } else {
                $stmt = $this->connection->prepare($query);
                $stmt->execute($params);
                $result = $stmt;
            }
            
            $this->closeConnection();
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }

        return $this->validateQuery($result);
    }

    protected function insertQuery($query, $params = null)
    {
        try {
            $this->getConnection();

            if($params == null){
                $stmt = $this->connection->prepare($query);
                $success = $stmt->execute();
                $result = $stmt;
            } else {
                $stmt = $this->connection->prepare($query);
                $success = $stmt->execute($params);
                $result = $stmt;
            }
            
            $this->closeConnection();

            if($success){
                echo "Registro inserido com sucesso!\n";
                return true;
            }
            return false;   
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

}
