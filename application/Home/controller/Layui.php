<?php
namespace app\Home\controller;
use think\Controller;
use think\Request;
use think\Validate;
use think\Cache;
class Layui extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            if(Request()->instance()->isAjax()){
                return json(1);
            }

        }else{
            return $this->fetch();
        }
    }
}
