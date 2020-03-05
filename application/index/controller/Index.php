<?php
namespace app\index\controller;


use think\Db;
use think\facade\Cache;
use think\facade\Request;

class Index extends Base
{
    public function index()
    {
        $this->articleInfo();
        // return $this->fetch();
    }

    public function articleInfo()
    {
        $totalName = 'total-count';
        $total = Cache::get($totalName);
        if(!$total){
            $count = Db::name('article')->count('id');
            Cache::set($totalName,(int)$count);
        }

        //验证文章id
        $hadRead = $this->getArticleID($this->memberID,$total);

        return false;
    }

    private function getArticleID($memberID,$total)
    {

        $articleID = 0;
        $readInfo = Db::name('read')->where('member_id',$memberID)->column('article_id');
        dump($readInfo);
        $aricleInfo = Db::name('article')->column('id');
        dump($aricleInfo);
        $choseArr = array_diff($aricleInfo,$readInfo);

        if(!empty($choseArr)){
            $rand = rand(0,count($choseArr)-1);
            while(!isset($choseArr[$rand])){
                $rand = rand(0,count($choseArr)-1);
            }
            $articleID = $choseArr[$rand];

            Db::name('read')->insert(['member_id' => $memberID,'article_id' => $articleID]);
        }

        var_dump($articleID);
        die;

        $articleID = 0;

        $randArr = [];
        $articleID = rand(1,$total);
        do{
            do{
                $articleID = rand(1,$total);
                if(count($randArr) >= $total){
                    var_dump($randArr);
                    $articleID = 0;
                    break;
                }
            }while(!in_array($articleID,$randArr) && array_push($randArr,$articleID));

        }while($this->getReadInfo($memberID,$articleID));

        var_dump($articleID);
        return $articleID;
    }

    //看看该ip已经看过那些条目
    private function getReadInfo($memberID,$articleID)
    {
        $res = false;
        $name = $memberID.'-read-'.$articleID;
        if(Cache::get($name)) {
            $res = true;
        }else{
            var_dump('11111111111111');
            $readInfo = Db::name('read')->where('member_id')->column('article_id');
            var_dump($readInfo);
            if(!empty($readInfo)){
                foreach ($readInfo as $key){
                    $cacheName = $memberID.'-read-'.$key;
                    Cache::set($cacheName,1);
                }
            }
            if(in_array($articleID,$readInfo)){
                $res = true;
            }
        }

        return $res;
    }
}
