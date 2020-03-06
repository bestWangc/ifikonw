<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\facade\Request;

class Article extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function create(Request $request)
    {
        $content = $request::post('content','');
        if(empty($content)){
            return returnMsg([],1,'铁子，你写内容啊！');
        }
        $link = $request::post('link','');
        $name = $request::post('name','');

        //查找是否存在该数据
        $info = Db::name('article')->where('content',$content)->value('id');
        if(!empty($info)){
            return returnMsg([],1,'别人已经盘过了，换一条噻！');
        }
        $data = [
            'content' => $content,
            'link' => $link,
            'name' => $name
        ];
        //文章id
        $articleID = Db::name('article')->insertGetId($data);

        if($articleID){
            return returnMsg([],0,'恭喜，盘它！');
        }
        return returnMsg([],0,'盘失败了，再来！');
    }
}
