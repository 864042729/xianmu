<?php
namespace app\Home\controller;
use think\Controller;
use think\Validate;
use think\Cache;
class Index extends Controller
{
    public function index()
    {
//        $value=Db('user')->where(array('id'=>1))->select();

        //fetchSql()查看当前sql语句
//   $value=Db('user')->fetchSql()->where(array('id'=>1))->select();
//        SELECT * FROM `bl_user` WHERE  `id` = 1

//        db('user',[],false)->where('status',1)->select();
        //上面的[]为数据库的连接参数，例如：
        // 'type'=> 'mysql',      //数据库类型
        // 'database'=> 'atnongye'//数据库名
//        $aa=db('bl_user',[ 'type'=> 'mysql', 'database'=> 'atnongye'],false)->where('id',1)->find();


//       $aa=Db('user')->where('islock',1)->column('username','id');
//       $gr=db('user')
//            ->field('')
//            ->group('user_id,test_time')
//            ->select();
//        var_dump($value);

        $rule = [
            'username'   => 'unique:users',
        ];

        $msg = [
            'username.unique' => '用户存在',
        ];
//        var_dump($_POST);
        //post到的值
        if($_POST){
            $data['username']=$_POST['username'];
            //实例化Validate类
            $validate = new Validate($rule, $msg);
            //把post到的值与Validate类里的$rule验证，不符合就返回false，batch()表示验证全部；
            $result   = $validate->batch()->check($data);
            //不符合就返回$msg数组；
            $error=$validate->getError();
        }




        if(Request()->instance()->isAjax()){
            if(null !=$result){
                $data['info']='对';
                $data['status']='y';
                return json($data);//$json是数组
            }else{
                //                dump(json($error));
                $data['info']=$error['username'];
                $data['status']='n';
                return json($data);//$json是数组
            }
        }

        return $this->fetch();
    }
    /**
     * 数据验证
     * ajax接收、返回
    */
    public function aa()
    {
        if(Request()->instance()->isPost()){
            //内置规则
            //http://www.kancloud.cn/manual/thinkphp5/129356
            $rule = [
                'username'  => 'require|max:1',
                'age'   => 'number|between:1,120',
                'emil' => 'email',
            ];

            $msg = [
                'username.require' => '名称必须',
                'username.max'     => '名称最多不能超过25个字符',
                'age.number'   => '年龄必须是数字',
                'age.between'  => '年龄只能在1-120之间',
                'emil'        => '邮箱格式错误',
            ];

//        $data = [
//            'name'  => 'thinkphp',
//            'age'   => '131',
//            'email' => 'thinkphp',
//        ];
//$data['name']='1234561123454545646546465456545646545645645645645646465';
            //post到的值
            $data=$_POST;
            //实例化Validate类
            $validate = new Validate($rule, $msg);
            //把post到的值与Validate类里的$rule验证，不符合就返回false，batch()表示验证全部；
            $result   = $validate->batch()->check($data);
            //不符合就返回$msg数组；
            $error=$validate->getError();
            if(Request()->instance()->isAjax()){
//                dump(json($error));
                return json($error);//$json是数组
            }
            if(true !== $result){

                var_dump(111);
            }else{
                $this->success('新增成功', 'Index/index');
            }

        }






        return $this->fetch();
    }

    /**
     * 测试 注册
    */
    public function reg(){
        $_POST['username']='1';
        $_POST['password']='1';
        $_POST['repassword']='1';
        $_POST['emil']='1';
        $_POST['age']='1';
//        if(Request()->instance()->isPost()){
            $rule = [
                'username'  => 'require|length:1,16',
                'password'   => 'require|length:6,20',
                'repassword'=>'require|confirm:password',
                'emil' => 'email',
            ];

            $msg = [
                'username.require' => '名称必须',
                'username.length'     => '名称只能在1-16位之间',
                'password.require' => '密码必须',
                'password.length'     => '密码只能在6-20位之间',
                'repassword.require' => '确定密码必填',
                'repassword.confirm' => '两次输入的密码不相同',
                'age.number'   => '年龄必须是数字',
                'age.between'  => '年龄只能在1-120之间',
                'emil'        => '邮箱格式错误',
            ];
            //post到的值
            $data=$_POST;
            //实例化Validate类
            $validate = new Validate($rule, $msg);
            //把post到的值与Validate类里的$rule验证，不符合就返回false，batch()表示验证全部；
            $result   = $validate->batch()->check($data);

            //不符合就返回$msg数组；
            $error=$validate->getError();
            //判断ajax
            if(Request()->instance()->isAjax()){
                if(true !== $result){
                    return json($error);//返回值$json是数组
                }else{
                    $bb_ajax['success']='注册成功';
                $bb_ajax['url']=url('Index/index');
                    return json($bb_ajax);//返回值$json是数组
                }
            }
            if(true !== $result){

                $this->error($error['password'], 'Index/index');
            }else{
                $this->success('新增成功', 'Index/index');
            }
//        }
    }
    /**
     *上传图片
     */
    public function file(){
        $file = request()->file('img');
// 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
// 成功上传后 获取上传信息
// 输出 jpg

// 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
        }else{
// 上传失败获取错误信息
            echo $file->getError();
        }
    }
    public function upload(){
        var_dump($_FILES);
        if(Request()->instance()->isAjax()){

            $path = $_POST['param'];
            $pathinfo = pathinfo($path);
//            echo "目录名称：$pathinfo[dirname]<br>";
//            echo "文件名称：$pathinfo[basename]<br>";
//            echo "扩展名：$pathinfo[extension]";
            $pathinfo=$pathinfo['basename'];
            $uploadDir = 'ui'."/".date("Ymd")."/";
            //$uploadDir = 'Uploads'.DIRECTORY_SEPARATOR;
            $dir = $uploadDir;
            file_exists($dir) || (mkdir($dir,0777,true) && chmod($dir,0777));
            $rs = move_uploaded_file($_POST['param'],$dir.$pathinfo);
            var_dump($_POST['param']);
            var_dump($dir.$pathinfo);
            var_dump($rs);exit;


            $file = request()->file($pathinfo);
        var_dump($pathinfo);
            var_dump($file);
        //判断文件类型
        if(!count($file)){
            $data['info']='图片不能为空';
            $data['status']='n';
            return json($data);//$json是数组
//            $this->output_data(-1,'图片不能为空!');
        }
        $type=$file->checkImg();
        if(!$type){
            $data['info']='图片类型不正确';
            $data['status']='n';
            return json($data);//$json是数组
//            $this->output_data(-1,'图片类型不正确!');
        }
        }
        return $this->fetch();





        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        $picture=model("Picture");
        $turepath = $file->getRealPath();
        $md5path=md5_file($turepath);
        $shalpath=sha1_file($turepath);
        $map["md5"]=$md5path;
        $map["sha1"]=$shalpath;
        /*判断是否有相同图片上传过了*/
        $image=$picture->find($map);
        if($image){
            $this->output_data(200,'success',array('img'=>'http://'.$_SERVER['HTTP_HOST'].$image["path"],"id"=>$image["id"]));
        }
        //判断文件类型
        if(!count($file)){
            $this->output_data(-1,'图片不能为空!');
        }
        $type=$file->checkImg();
        if(!$type){
            $this->output_data(-1,'图片类型不正确!');
        }

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $path = $info->getSaveName();
            $data=array();
            $img_path='http://'.$_SERVER['HTTP_HOST'].'/uploads/'.$path;
            $type=$info->getExtension();
            $type="image/".$type;
            $data["path"]='/uploads/'.$path;
            $data["type"]=$type;
            $data["status"]=1;
            $data["md5"]=$md5path;
            $data["sha1"]=$shalpath;

            $result=$picture->insert($data);
            $this->output_data(200,'success',array('img'=>$img_path,"id"=>$result));
            /*echo $path;
            echo "<br>";
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
            echo "<br>";
            输出 42a79759f284b767dfcb2a0197904287.jpg*/
            echo $info->getPathName();
        }else{
            // 上传失败获取错误信息
            $this->output_data(-1,'提交失败!');
        }

    }
    /**
     *关联查询
     */
    public function onequery(){

    }




    /**
     * 测试 注册
     */
    public function regg()
    {
        $_POST['userName'] = '1';
        $_POST['userEmail'] = '1';
        $_POST['repassword'] = '1';
        $_POST['emil'] = '1';
        $_POST['age'] = '1';
//        $User =validate('Users');;
        $result = $this->validate($_POST, 'Users');
        if (true !== $result) {
            // 验证失败 输出错误信息
            dump($result);
        }
    }
    /**
     * 测试 注册
     */
    public function reggg()
    {

//        $_POST['loginName'] = '111thinkphp';
//        $_POST['userEmail'] = 'dfds@df.com';
//        $_POST['userId']='41';
        if (request()->isPost()){
            var_dump(input(''));exit;
            input('post.loginName');
            input('post.userEmail');
            input('post.userId');
            $User =model('Users');
            $User->add($_POST);
        }else{
            return $this->fetch();
        }



    }
}
