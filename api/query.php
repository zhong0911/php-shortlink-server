<?php
/**
 * @Author: zhong
 * @Email: i@antx.cc
 * @Date: 2023-5-26 10:12:07
 */

error_reporting(E_ERROR | E_PARSE);
header('Content-type:application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require './config.php';
require '../src/link.php';

$short_link = $_GET['short_link'] ?? '';
if ($short_link) {
    if (getShortLinkExist($short_link)) {
        echo json_encode(array(
            'success' => true,
            'message' => 'Queried successfully',
            'short_link' => $short_link_url . $short_link,
            'long_link' => getShortLinkLongLink($short_link),
            'generation_time' => getShortLinkGenerationTime($short_link),
            'expiration_time' => getShortLinkExpirationTime($short_link)
        ),
            JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'Short link don\'t exist'
        ));
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => 'Short link is empty'
    ));
}

