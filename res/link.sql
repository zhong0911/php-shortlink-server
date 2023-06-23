CREATE DATABASE shortlinks;

use shortlinks;

CREATE TABLE IF NOT EXISTS shortlinks.shortlinks
(
    id              INT auto_increment
        PRIMARY KEY,
    short_link      TEXT       NOT NULL,
    long_link       TEXT       NOT NULL,
    status          TINYINT(1) NOT NULL,
    generation_time DATETIME   NOT NULL,
    expiration_time DATETIME   NOT NULL,
    request_times   INT        NOT NULL
);
