<?php

namespace phpanalysis\src;

class Analysis
{

    /**
     * 实现分词功能
     * @param $content
     * @return string
     */
    public function run($content)
    {
        $content = $this->delSymbol($content);
        PhpAnalysis::$loadInit = false;
        $pa = new PhpAnalysis('utf-8', 'utf-8', false);
        $pa->LoadDict();
        $pa->SetSource($content);
        $pa->StartAnalysis(false);
        // $tags = $pa->GetFinallyKeywords($num-1);
        $tags = $pa->GetFinallyResult(',');
        return $tags;
    }

    //去除字符串中的 多余符合提高准确率
    public function delSymbol($str){
        $symbolArr = array('​','“','”','"','>','<',' ',' ','`','·','~','!','！','@','#','$','￥','%','^','……',
            '&','*','(',')','（','）','-','_','——','+','=','|','\\','[',']',
            '【','】','{','}',';','；',':','：','\'','"','“','”',',','，','<','>','《','》','.','。','/','、','?','？');
        return str_replace($symbolArr,'',$str);
    }
}



