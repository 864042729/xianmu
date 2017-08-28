<?php
namespace app\Home\controller;
use think\Controller;
use think\Request;
use think\Validate;
use think\Cache;
class Validform extends Controller
{
    public function index()
    {
        if(request()->isPost()){
//            if(Request()->instance()->isAjax()){
//                return json(1);
//            }
//            $result = $this->validate($_POST, 'User');
            $mo_user=model('User');
            $data=input('post.');
            $result=$mo_user->is_login($data);
            if (true !== $result) {
                // 验证失败 输出错误信息
                $this->error($result);
//                return json(1);
            }
        }else{
            return $this->fetch();
        }
    }
}
