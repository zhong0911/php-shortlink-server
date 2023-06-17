<?php
/**
 * @Author: zhong
 * @Email: i@antx.cc
 * @Date: 2023-5-26 10:12:07
 */
require '../api/config.php';
require '../static/php/link.php';
require '../static/php/php/utils.php';

error_reporting(E_ERROR | E_PARSE);
header('Content-type:application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$long_link = $_GET['long_link'] ?? '';
if ($long_link) {
    // 判断长链接是否为正确的链接
    if (isUrl($long_link)) {
        $expiration_time = $_GET['expiration_time'] ?? '2099-12-31 23:59:59';
        $date_arr = date_parse_from_format('Y-m-d H:i:s', $expiration_time);
        // 判断过期时间是否符合格式
        if ($date_arr['error_count'] === 0 && $date_arr['warning_count'] === 0) {
            $short_link = $_GET['short_link'] ?? getNewShortLink();
            // 判断长链接是否存在
            if (!getShortLinkExist($short_link)) {
                // 判断长链接是否与短链接相同
                if ($long_link !== $short_link_url . $short_link) {
                    $generation_time = date('Y-m-d H:i:s');
                    // 判断是否生成成功
                    if (addShortLink($short_link, $long_link, $generation_time, $expiration_time)) {
                        echo json_encode(array(
                            'success' => true,
                            'message' => 'Generated successfully',
                            'short_link' => $short_link_url . $short_link,
                            'long_link' => $long_link,
                            'generation_time' => $generation_time,
                            'expiration_time' => $expiration_time
                        ), JSON_UNESCAPED_SLASHES);
                    } else {
                        echo json_encode(array(
                            'success' => false,
                            'message' => 'Generation failed'
                        ));
                    }
                } else {
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Short link cannot be the same as long link'
                    ));
                }
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Short link does exist'
                ));
            }

        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'Expiration time format error'
            ));
        }
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'URL format error'
        ));
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => 'Long link is empty'
    ));
}