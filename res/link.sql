CREATE TABLE IF NOT EXISTS link
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

INSERT INTO antx.link (id, short_link, long_link, status, generation_time, expiration_time, request_times)
VALUES (1, '0', '0', 0, '2023-05-27 14:23:50', '2023-05-27 14:22:34', 0);
INSERT INTO antx.link (id, short_link, long_link, status, generation_time, expiration_time, request_times)
VALUES (2, 'www', 'https://www.antx.cc/', 1, '2023-04-29 15:43:01', '2099-12-31 23:59:59', 0);
INSERT INTO antx.link (id, short_link, long_link, status, generation_time, expiration_time, request_times)
VALUES (3, 'cdn', 'https://cdn.antx.cc/', 1, '2023-04-29 15:43:37', '2099-12-31 23:59:59', 0);
INSERT INTO antx.link (id, short_link, long_link, status, generation_time, expiration_time, request_times)
VALUES (4, 'api', 'https://api.antx.cc/', 1, '2023-04-29 15:43:51', '2099-12-31 23:59:59', 0);
INSERT INTO antx.link (id, short_link, long_link, status, generation_time, expiration_time, request_times)
VALUES (5, 'login', 'https://passport.antx.cc/login/', 1, '2023-04-29 15:44:25', '2099-12-31 23:59:59', 0);
INSERT INTO antx.link (id, short_link, long_link, status, generation_time, expiration_time, request_times)
VALUES (6, 'register', 'https://passport.antx.cc/register/', 1, '2023-04-29 15:44:55', '2099-12-31 23:59:59',
        0);

