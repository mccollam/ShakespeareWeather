CREATE TABLE IF NOT EXISTS conditions
(
    code SMALLINT UNSIGNED NOT NULL,
    day VARCHAR(60) NOT NULL,
    night VARCHAR(60) NOT NULL,
    icon SMALLINT UNSIGNED,
    PRIMARY KEY (code)
);