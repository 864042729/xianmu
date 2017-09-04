<?php
namespace app\layui\model;
use think\model\Merge;

class User extends Merge
{
    // 设置主表名
    protected $table = 'bl_user';
    // 定义关联模型列表
    protected static $relationModel = [
        // 给关联模型设置数据表
        'info'   =>  'bl_user_info',
    ];
    // 定义关联外键
    protected $fk = 'info_mid';
    protected $mapFields = [
        // 为混淆字段定义映射
        'info_id' =>  'info.mid',
    ];
}
