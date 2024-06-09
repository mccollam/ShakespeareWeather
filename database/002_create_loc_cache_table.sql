CREATE TABLE IF NOT EXISTS loc_cache
(
    dt TIMESTAMP NOT NULL,
    loc POINT NOT NULL,
    SPATIAL INDEX `SPATIAL` (`loc`),
    INDEX `CACHETIME` (dt)
);