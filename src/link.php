<?php
/**
 * @Author: zhong
 * @Email: i@antx.cc
 * @Date: 2023-5-26 10:12:07
 */

function getShortLinkLongLink($short_link): string
{
    return queryAccountData("SELECT long_link FROM shortlinks WHERE short_link='$short_link'", "long_link");
}

function getShortLinkExist($short_link): bool
{
    return queryAccountData("SELECT short_link FROM shortlinks WHERE short_link='$short_link'", "short_link") != "";
}

function getShortLinkExpirationTime($short_link): string
{
    return queryAccountData("SELECT expiration_time FROM shortlinks WHERE short_link='$short_link'", "expiration_time");
}

function getShortLinkGenerationTime($short_link): string
{
    return queryAccountData("SELECT generation_time FROM shortlinks WHERE short_link='$short_link'", "generation_time");
}

function getShortLinkStatus($short_link): string
{
    return queryAccountData("SELECT status FROM shortlinks WHERE short_link='$short_link'", "status");
}

function getShortLinkRequestTimes($short_link): string
{
    return queryAccountData("SELECT request_times FROM shortlinks WHERE short_link='$short_link'", "request_times");
}

function updateShortLinkRequestTimes($short_link): bool
{
    $request_times = (int)getShortLinkRequestTimes($short_link) + 1;
    return insertData("update link set request_times=$request_times where short_link='$short_link'");
}

function getAllShortLinksRequestTimes(): string
{
    return queryAccountData("SELECT request_times FROM shortlinks WHERE id=1", "request_times");
}

function updateAllShortLinksRequestTimes(): bool
{
    $request_times = (int)getAllShortLinksRequestTimes() + 1;
    return insertData("update shortlinks set request_times=$request_times where id=1");
}

function getNewShortLink(): string
{
    do {
        $short_link = genShortLong();
    } while (getShortLinkExist($short_link));
    return $short_link;
}

function addShortLink($short_link, $long_link, $generation_time, $expiration_time): bool
{
    return insertData("insert into shortlinks (id, short_link, long_link, status, generation_time, expiration_time, request_times) values (default, '$short_link', '$long_link', true, '$generation_time', '$expiration_time', 0)");
}


function genShortLong($length = 6): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) $randomString .= $characters[rand(0, $charactersLength - 1)];
    return $randomString;
}

function queryAccountData($sql, $key): string
{
    $conn = mysqli_connect("mysql.db.antx.cc", "root", getenv("ANTX_MYSQL_PASSWORD"), "shortlinks");
    $result = mysqli_query($conn, $sql);
    $res = "";
    while ($row = mysqli_fetch_array($result)) {
        $res = $row[$key];
    }
    $conn->close();
    return $res;
}


function insertData($sql): bool
{
    $conn = mysqli_connect("mysql.db.antx.cc", "root", getenv("ANTX_MYSQL_PASSWORD"), "shortlinks");
    $res = false;
    if ($conn->query($sql) === TRUE) {
        $res = true;
    }
    $conn->close();
    return $res;
}