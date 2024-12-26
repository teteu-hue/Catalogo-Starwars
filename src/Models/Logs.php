<?php

namespace App\Models;

use App\Database\Dao;

class Logs extends Dao
{
    public function registerLog($params)
    {
        $sql = "INSERT INTO api_logs(request_time, endpoint, request_method, response_status, ip_address)
                VALUES (:request_time, :endpoint, :request_method, :response_status, :ip_address)";

        $body = [
            ":request_time" => $params["request_time"],
            ":endpoint" => $params["endpoint"],
            ":request_method" => $params["request_method"],
            ":response_status" => $params["response_status"],
            ":ip_address" => $params["ip_address"]
        ];

        $this->insertQuery($sql, $body);
    }
}