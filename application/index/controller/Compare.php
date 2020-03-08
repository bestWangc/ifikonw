<?php
namespace app\index\controller;

use phpanalysis\src\Analysis;
use app\index\controller\LCS;
use think\Controller;
use think\Db;
use think\Exception;
use think\facade\Log;
use think\facade\Request;

class Compare extends Controller
{
    public function index()
    {
        $info = Db::name('compare')
            ->alias('c')
            ->leftJoin('article a','a.id = c.article_id_old')
            ->leftJoin('article a1','a1.id = c.article_id_new')
            ->field('c.id as row_id,c.ratio,a.id as old_id,a.content as old_content,a.create_at as old_create,a1.id as new_id,a1.content as new_content,a1.create_at as new_create')
            ->where('c.status',1)
            ->select();
        $this->assign('info',$info);
        return $this->fetch();
    }

    //比较相似度
    public function start($data)
    {
        $allArticle = Db::name('article')->field('id,content,create_at')->select();

        $analysis = new Analysis();
        $baseStr = array_filter(explode(',',$analysis->run($data['content'])));
        $compareArr = [];
        foreach ($allArticle as $key => $val) {
            if($val['id'] == $data['id']){
                continue;
            }
            $tempStr = array_filter(explode(',',$analysis->run($val['content'])));
            //设置所有分词的总集合
            $wordArr = array_unique(array_merge($baseStr,$tempStr));
            //获取分词后的每个数组 向量的模
            $baseMo = $this->getVectorStr($baseStr,$wordArr);
            $tempMo = $this->getVectorStr($tempStr,$wordArr);
            $percent = $this->similarity($baseMo,$tempMo) * 100;
            if($percent < 20){
                continue;
            }
            $temp = [
                'article_id_old' => $val['id'],
                'article_id_new' => $data['id'],
                'ratio' => round($percent)
            ];
            array_push($compareArr,$temp);
        }
        if(!empty($compareArr)){
            Db::name('compare')->insertAll($compareArr);
        }

        return true;
    }

    //计算余弦相似度
    private function similarity(array $vec1, array $vec2) {
        return $this->dotProduct($vec1, $vec2) / ($this->absVector($vec1) * $this->absVector($vec2));
    }

    private function dotProduct(array $vec1, array $vec2) {
        $result = 0;
        foreach (array_keys($vec1) as $key1) {
            foreach (array_keys($vec2) as $key2) {
                if ($key1 === $key2) $result += $vec1[$key1] * $vec2[$key2];
            }
        }
        return $result;
    }

    private function absVector(array $vec) {
        $result = 0;
        foreach (array_values($vec) as $value) {
            $result += $value * $value;
        }
        return sqrt($result);
    }

    public function getVectorStr($strArr,$wordArr){
        $vectorStr = array();
        foreach($wordArr as $key1 => $temp2){
            $num = 0;
            foreach($strArr as $key2 => $temp1){
                if($temp2 == $temp1){
                    $num++;
                }
            }
            $vectorStr[$key1] = $num;
        }
        return $vectorStr;
    }

    public function repeat(Request $request)
    {
        $id = $request::get('row_id','');
        if(empty($id)){
            return returnMsg([],1,'参数不全啊！');
        }
        // 启动事务
        Db::startTrans();
        try {
            $res = Db::name('article')->where('id',$id)->setField('status',0);
            if(!$res){
                throw new Exception('文章删除失败',4001);
            }
            $res = Db::name('compare')->where('article_id_old',$id)->whereOr('article_id_new',$id)->setField('status',0);
            if(!$res){
                throw new Exception('分析数据失败',4002);
            }
            // 提交事务
            Db::commit();
            if($res){
                return returnMsg([],0,'删掉了！');
            }
        } catch (\Exception $e) {
            // 回滚事务
            dump($e->getMessage());
            dump($e->getCode());
            Db::rollback();
        }

        return returnMsg([],1,'出，出了个错！');
    }

    public function delete(Request $request)
    {
        $id = $request::get('row_id','');
        if(empty($id)){
            return returnMsg([],1,'参数不全啊！');
        }
        $res = Db::name('compare')->where('id',$id)->setField('status',0);
        if($res){
            return returnMsg([],0,'删掉了！');
        }
        return returnMsg([],1,'出，出了个错！');
    }
}
