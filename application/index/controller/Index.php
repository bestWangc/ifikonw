<?php
namespace app\index\controller;

use think\Db;
use think\facade\Cache;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    public function articleInfo()
    {
        $res = [
            'content' => '人生就是六个大字，怎么着都不行。',
            'fake' => 0,
            'real' => 0
        ];
        //文章id
        $articleID = $this->getArticleID($this->memberID);

        if($articleID == 0){
            $res['content'] = '冷知识都被您看完了，真TM棒棒的！';
            $res['again'] = 0;
        }
        $info = Db::name('article')->where('id',$articleID)->field('content,real,fake')->find();
        if(!empty($info)){
            $res = $info;
            $res['again'] = 1;
        }
        return returnMsg($res);
    }

    private function getArticleID($memberID)
    {
        $articleID = 0;
        $readInfo = Db::name('read')->where('member_id',$memberID)->column('article_id');
        $articleInfo = Db::name('article')->column('id');
        $choseArr = array_diff($articleInfo,$readInfo);

        if(!empty($choseArr)){
            $articleID = $choseArr[array_rand($choseArr)];
            Db::name('read')->insert(['member_id' => $memberID,'article_id' => $articleID]);
        }
        return $articleID;
    }
}
