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

        //比较相似度
        $compare = new Compare();
        $compare->start(['id' => $articleID,'content' => $content]);
        if($articleID){
            return returnMsg([],0,'恭喜，盘它！');
        }
        return returnMsg([],0,'盘失败了，再来！');
    }

    public function articleUp(Request $request)
    {
        $id = $request::post('id','');
        if(empty($id)){
            return returnMsg([],1,'出了个错，再来一下子！');
        }
        $type = $request::post('type/d','');
        if($type === ''){
            return returnMsg([],1,'选个真假啊骚年！');
        }
        if($type === 1){
            $field = 'real';
        } else {
            $field = 'fake';
        }
        Db::name('article')->where('id',$id)->where('status',1)->setInc($field);
        $res = Db::name('article')->where('id',$id)->where('status',1)->value($field);
        if($res){
            return returnMsg(['count' => $res],0,'老弟，稳！');
        }
        return returnMsg([],1,'出，出了个错，尼酱！');
    }
}
