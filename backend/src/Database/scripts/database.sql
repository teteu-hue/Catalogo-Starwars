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
    film_id INT,
    name VARCHAR(255),
    url VARCHAR(255),
    FOREIGN KEY (film_id) REFERENCES films(id) ON DELETE CASCADE
);

CREATE TABLE filmes_personagens (
    film_id INT,
    character_id INT,
    PRIMARY KEY (film_id, character_id),
    FOREIGN KEY (film_id) REFERENCES filmes(id) ON DELETE CASCADE,
    FOREIGN KEY (character_id) REFERENCES personagens(id) ON DELETE CASCADE
);

