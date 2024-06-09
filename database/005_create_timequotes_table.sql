CREATE TABLE IF NOT EXISTS timequotes
(
    id INT NOT NULL AUTO_INCREMENT,
    timestart TIME NOT NULL,
    timeend TIME NOT NULL,
    quote TEXT NOT NULL,
    source VARCHAR(100),
    PRIMARY KEY (id)
);