<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/8/10
 * Time: 下午2:41
 */
namespace app\admin\controller;
use think\Cache;


/**
 * 清理缓存
 * Class Clear
 * @package app\admin\controller
 */
class Clear extends Base
{

    //清空缓存
    public function delete(){
        if(Cache::clear()){
            return $this->success('清理成功');
        }else{
            return $this->error('清理失败');
        }
    }

}
