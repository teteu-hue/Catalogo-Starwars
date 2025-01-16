<?php

namespace App\Models;

use App\Database\Dao;

class RequestApiLogs extends Dao
{
    private $requestTime;
    private string $endpoint;
    private string $requestMethod;
    private int $responseStatus;
    private string $ipAddress;

    // estudar o metodo __invoke ->
    // metodo magicos __call, __toString, __construct, __destruct, __invoke

    public function __construct($requestTime, $endpoint, $requestMethod, $responseStatus, $ipAddress)
    {
        $this->requestTime = $requestTime;
        $this->endpoint = $endpoint;
        $this->requestMethod = $requestMethod;
        $this->responseStatus = $responseStatus;
        $this->ipAddress = $ipAddress;
        $this->registerLog();
    }

    private function registerLog()
    {
        $sql = "INSERT INTO api_logs(request_time, endpoint, request_method, response_status, ip_address)
                VALUES (:request_time, :endpoint, :request_method, :response_status, :ip_address)";

        $body = [
            ":request_time" => $this->requestTime,
            ":endpoint" => $this->endpoint,
            ":request_method" => $this->requestMethod,
            ":response_status" => $this->responseStatus,
            ":ip_address" => $this->ipAddress
        ];

        $this->insertQuery($sql, $body);
    }
}