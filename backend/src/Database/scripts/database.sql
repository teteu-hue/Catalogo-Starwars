CREATE DATABASE starwars;

CREATE TABLE api_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_time DATETIME NOT NULL,
    endpoint VARCHAR(255) NOT NULL,
    request_method VARCHAR(10) NOT NULL,
    response_status INT NOT NULL
);

ALTER TABLE api_logs ADD COLUMN ip_address VARCHAR(45) NOT NULL;

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    episode_id INT NOT NULL,
    opening_crawl TEXT,
    release_date DATE,
    director VARCHAR(255),
    producers VARCHAR(255)
);

CREATE TABLE characters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

CREATE TABLE characters_movies (
    id_movie INT,
    id_character INT,
    PRIMARY KEY (id_movie, id_character),
    FOREIGN KEY (id_movie) REFERENCES movies(id) ON DELETE CASCADE,
    FOREIGN KEY (id_character) REFERENCES characters(id) ON DELETE CASCADE
);

