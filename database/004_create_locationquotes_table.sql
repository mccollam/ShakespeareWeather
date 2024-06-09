CREATE TABLE IF NOT EXISTS locationquotes
(
    id INT NOT NULL AUTO_INCREMENT,
    location VARCHAR(80) NOT NULL,
    quote TEXT NOT NULL,
    source VARCHAR(100),
    INDEX `LOCATIONS` (location),
    PRIMARY KEY (id)
);