<?php
/**
 * @Author: zhong
 * @Email: i@antx.cc
 * @Date: 2023-5-26 10:12:07
 */

//error_reporting(0);
header('Content-type:application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require '../src/link.php';
require '../src/utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $short_link = $_GET['short_link'] ?? '';
    if ($short_link) {
        $long_link = getShortLinkLongLink($short_link);
        if ($long_link) {
            $now_time = date('Y-m-d H:i:s');
            $expiration_time = getShortLinkExpirationTime($short_link);
            if ($now_time < $expiration_time) {
                if (getShortLinkStatus($short_link)) {
                    updateAllShortLinksRequestTimes();
                    updateShortLinkRequestTimes($short_link);
                    redirect($long_link);
                } else {
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Short link cannot access'
                    ));
                }
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Short link has expired'
                ));
            }
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
}