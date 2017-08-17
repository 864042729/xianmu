<?php

namespace app\admin\controller;
use think\Cache;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;

class Base extends Controller
{
    //基类
    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        if (!Session::has('admin_id')) {
            $this->redirect('login/Login');
        }
        $this->getGroup();
    }


    /**
     * 输出权限组
     */
    protected function getGroup(){
        if(Cache::has('group_info')) {
            $group_info = Cache::get('group_info');
        }else{
            $group_info = Db::name('auth_group')->column('title', 'id');
            Cache::set('group_info',$group_info);
        }
        $this->assign('group_info',$group_info);
    }








}
