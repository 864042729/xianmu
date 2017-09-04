<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 判断是否为合法的身份证号码
 * @param $mobile
 * @return int
 */
function isCreditNo($vStr){
    $vCity = array(
        '11','12','13','14','15','21','22',
        '23','31','32','33','34','35','36',
        '37','41','42','43','44','45','46',
        '50','51','52','53','54','61','62',
        '63','64','65','71','81','82','91'
    );
    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) return false;
    if (!in_array(substr($vStr, 0, 2), $vCity)) return false;
    $vStr = preg_replace('/[xX]$/i', 'a', $vStr);
    $vLength = strlen($vStr);
    if ($vLength == 18) {
        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
    } else {
        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
    }
    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) return false;
    if ($vLength == 18) {
        $vSum = 0;
        for ($i = 17 ; $i >= 0 ; $i--) {
            $vSubStr = substr($vStr, 17 - $i, 1);
            $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr , 11));
        }
        if($vSum % 11 != 1) return false;
    }
    return true;
}

function upload($file,$rule){
    // 移动到框架应用根目录/public/uploads/ 目录下
    $info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
    if ($info) {
        $data['code'] = 200;
        $data['msg'] = "上传成功";
        $data['url'] = $info->getSaveName();
        return $data;
    } else {

        // 上传失败获取错误信息
        $data['code'] = 500;
        $data['msg'] =$rule.$file->getError();
        return $data;
    }
}


/**
 * 分页
 * $page   页码
 * $total  总数
 * $pageTotal   每页显示的天数
 * 可以将$pageTotal,$page,$total等数据作为参数传递，或者在paging作为全局变量（推荐）
 */
function paging($page,$total,$pageTotal){
    $rd='';
    if($total<=0){
        return $rd;
    }
    $page_num=ceil($total /$pageTotal);
    $limit_page=5;
    if($page_num < $limit_page){
        $limit_page = $page_num;
    }


    if($limit_page%2 == 1){
        $center_page = floor($limit_page/2);
        $start_page = $page-$center_page;
    }else{
        $center_page = $limit_page/2;
        $start_page = $page-$center_page + 1;

    }
    $end_page = $page+$center_page;

    //(7) 分页页码组合完之后 发现 开始页码小于1 重设为页码1开始
    if($start_page < 1){
        $start_page = 1;
        $end_page = $limit_page;
    }
    //(8) 分页页码组合完之后 发现 结束页码大于总页码数 重设为最后页码开始往前延伸
    if($end_page > $page_num){
        $start_page = $page_num-$limit_page+1;
        $end_page = $page_num;
    }

    $rd.= '<div style="display: block"><div id="wst-pager"><div name="laypage1.3" class="laypage_main laypageskin_molv" id="laypage_0">';
    $rd.= '<span style="background-color: #eee">'.$page.'/'.$page_num.'页 </span>';
    // （2） 循环页码  把页码全部循环出来
    for ($i=$start_page; $i <= $end_page; $i++) {
        if($i == $page){
            $rd.= '<span class="laypage_curr">'.($i).'</span>';
        }else{
            $rd.= '<a href="?page='.($i).'" data-page="'.($i).'">'.($i).'</a>';
        }


    }
    $rd.='<span class="laypage_total"><form action="?" method="get"><label>到第</label> <input type="number" name="page" min="1" class="laypage_skip"><label>页</label><button type="submit" class="laypage_btn">确定</button></form></span></div></div></div>';

    return $rd;
}


/**
 * 数据转csv格式的excle
 * @param  array $data      需要转的数组
 * @param  string $header   要生成的excel表头
 * @param  string $filename 生成的excel文件名
 *      示例数组：
$data = array(
'1,2,3,4,5',
'6,7,8,9,0',
'1,3,5,6,7'
);
$header='用户名,密码,头像,性别,手机号';
 */
function create_csv($data,$header=null,$filename='simple.csv'){
    // 如果手动设置表头；则放在第一行
    if (!is_null($header)) {
        array_unshift($data, $header);
    }
    // 防止没有添加文件后缀
    $filename=str_replace('.csv', '', $filename).'.csv';
    ob_clean();
    Header( "Content-type:  application/octet-stream ");
    Header( "Accept-Ranges:  bytes ");
    Header( "Content-Disposition:  attachment;  filename=".$filename);
    foreach( $data as $k => $v){
        // 如果是二维数组；转成一维
        if (is_array($v)) {
            $v=implode(',', $v);
        }
        // 替换掉换行
        $v=preg_replace('/\s*/', '', $v);
        // 解决导出的数字会显示成科学计数法的问题
        $v=str_replace(',', "\t,", $v);
        // 转成gbk以兼容office乱码的问题
        echo iconv('UTF-8','GBK',$v)."\t\r\n";
    }
}

//通过数组遍历得出导出报表类型结构
/**
 * @param $lists   数组(要导出的数据)
 * @param $pres    表头键值
 * @param $filename      文件名称
 */
function getXLSFromList($lists,$pres,$filename){
    //　　内容太大建议搜索少量再导出
    //    if(count($lists)>=20000)
    //    {
    //        header("Content-Type:text/html;charset=utf-8");
    //        echo "<br/><h1 style='color:red'>Export data is too large, please narrow your search!</h1><br/>";
    //        exit;
    //    }
    $content='<head><meta http-equiv="Content-type" content="text/html;charset=UTF-8" /></head> ';
    $content.="<table border='1'><tr>";
    //输出表头键值
    foreach($pres as $_pre){
        $content.="<td>$_pre</td>";
    }
    $content.="</tr>";
    foreach($lists as $key=>$val) {
        $content.= "<tr>";
        foreach ($val as $ck => $cv) {
            $content.= "<td style='vnd.ms-excel.numberformat:@'>".$cv."</td>"; //style样式将导出的内容都设置为文本格式 输出对应键名的键值 即内容
        }
        $content.="</tr>";
    }
    $content.="</table>";

    //导出代码
    set_time_limit(0);
    ini_set('memory_limit','1024M');//设置导出最大内存
//    $ranking =$data;//获得需要导出的数据
//    $content = getXLSFromList($title,$ranking);//获得输出的表格内容
    header("Content-type:application/vnd.ms-execl;charset=gb2312");//设置导出格式
    header("Content-Disposition:attactment;filename=".$filename.".xls");//设置导出文件名
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $content;
}