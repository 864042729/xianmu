<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/8/11
 * Time: 下午12:48
 */

namespace app\admin\controller;
use think\Db;

class System extends base

{
    public function  siteConfig(){
        $system = Db::name('system')->select();
        foreach($system as $key=>$val){
            if(is_serialized($val['value'])){
                $system_value = unserialize($val['value']);
            }else{
                $system_value = $val['value'];
            }
            $this->assign($val['name'],$system_value);
        }
        $theme_css = ['Blue.css','Black.css',];
        $this->assign('data',$theme_css);
        return $this->fetch();

    }
    //更新网站信息
    public function updateConfig(){

        if ($this->request->isPost()) {
            $config_type = $this->request->post('config_type');
            switch ($config_type){
                case 'site_config': //站点配置
                    $site_config                = $this->request->post('site_config/a');
                    $site_config['site_tongji'] = htmlspecialchars_decode($site_config['site_tongji']);
                    $data['value']              = serialize($site_config);
                    break;
                case 'email_config': //邮箱配置
                    $email_config                = $this->request->post('email_config/a');
                    $data['value']              = serialize($email_config);
                    break;
                case 'qq_config':   //QQ登录
                    $qq_config                   = $this->request->post('qq_config/a');
                    $data['value']               = serialize($qq_config);
                    break;
                case 'weixin_config':   //微信登录
                    $weixin_config              = $this->request->post('weixin_config/a');
                    $data['value']               = serialize($weixin_config);
                    break;

            }
            if(Db::name('system')->where('name', $config_type)->find()){
                if (Db::name('system')->where('name', $config_type)->update($data) !== false) {
                    $this->success('提交成功');
                }else {
                    $this->error('提交失败');
                }
            }else {
                $data['name'] = $config_type;
                if (Db::name('system')->insert($data) !== false) {
                    $this->success('提交成功');
                }else {
                    $this->error('提交失败');
                }
            }
        }

    }

}