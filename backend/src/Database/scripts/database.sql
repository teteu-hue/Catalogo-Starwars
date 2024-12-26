CREATE DATABASE starwars;

CREATE TABLE api_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_time DATETIME NOT NULL,
    endpoint VARCHAR(255) NOT NULL,
    request_method VARCHAR(10) NOT NULL,
    response_status INT NOT NULL
);

ALTER TABLE api_logs ADD COLUMN ip_address VARCHAR(45) NOT NULL;
