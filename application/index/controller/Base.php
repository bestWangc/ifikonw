<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Base extends Controller
{
    protected $memberID;

    public function initialize()
    {
        $this->getIP();
    }

    function getIP() {
        $unknown = 'unknown';
        $ip = '';
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
            && $_SERVER['HTTP_X_FORWARDED_FOR']
            && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        //处理多层代理的情况
        if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip));

        if(!empty($ip)){
            if(empty($lastTime)){
                $this->memberID = $this->setIP($ip);
            }
        }
        return $ip;
    }

    private function setIP($ip){
        $info = Db::name('member')->where('ip',$ip)->field('id,last_day,count')->find();
        if(empty($info)){
            $data = [
                'ip' => $ip,
                'last_day' => time()
            ];
            $insertID = Db::name('member')->insertGetId($data);
        } else {
            if(time() - $info['last_day'] > 86400){
                $data = [
                    'ip' => $ip,
                    'count' => $info['count'] + 1,
                    'last_day' => time()
                ];
                Db::name('member')->where('id',$info['id'])->update($data);
            }
            $insertID = $info['id'];
        }
        return $insertID;
    }
}
