<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\facade\Log;

// 应用公共文件
function returnMsg( $data = [], $code = 0, $msg = 'success'){
    $res = [
        'code' => $code,
        'msg' => $msg
    ];
    if(!empty($data)){
        $res['data'] = $data;
    }

    return $res;
}

function getUrl($url, $header = false) {
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //返回数据不直接输出
    curl_setopt($ch, CURLOPT_ENCODING, "gzip"); //指定gzip压缩
    //add header
    if(!empty($header)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    }
    //add ssl support
    if(substr($url, 0, 5) == 'https') {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    //SSL 报错时使用
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);    //SSL 报错时使用
    }
    //add 302 support
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $content = [];
    try {
        $content = curl_exec($ch); //执行并存储结果
    } catch (\Exception $e) {
        Log::error('分词错误'.$e->getMessage());
    }
    $curlError = curl_error($ch);
    if(!empty($curlError)) {
        Log::error('分词错误码'.$curlError);
    }
    curl_close($ch);
    return $content;
}