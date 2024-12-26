<?php

namespace App\Models;

use App\Database\Dao;

class Logs extends Dao
{
    public static function registerLog($params)
    {
        $sql = "INSERT INTO api_logs(request_time, endpoint, request_method, response_status)
                VALUES (:request_time, :endpoint, :request_method, :response_status)";

        $body = [
            ":request_time" => $params["request_time"],
            ":endpoint" => $params["endpoint"],
            ":request_method" => $params["request_method"],
            ":response_status" => $params["response_status"]
        ];

        self::insertQuery($sql, $body);
    }
}