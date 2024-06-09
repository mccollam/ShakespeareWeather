CREATE TABLE IF NOT EXISTS weatherquotes
(
    id INT NOT NULL AUTO_INCREMENT,
    code SMALLINT UNSIGNED NOT NULL,
    day BOOL NOT NULL,
    night BOOL NOT NULL,
    tempmin SMALLINT,
    tempmax SMALLINT,
    quote TEXT NOT NULL,
    source VARCHAR(100),
    FOREIGN KEY (code) REFERENCES conditions(code),
    INDEX `CODES` (code),
    PRIMARY KEY (id)
);