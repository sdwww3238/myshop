<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
    public function login(){
        if(IS_POST){
            //用户名/密码校验，、
            $user = D('User');
            $name = $_POST['user_name'];
            $pwd = $_POST['user_pwd'];
            $info = $user -> where(array('user_name'=>$name,'user_pwd'=>md5($pwd)))->find();

            if($info){
                if($info['user_check'] === "1"){
                    //已经通过邮件激活账号
                    //持久化用户信息
                    session('user_id',$info['user_id']);
                    session('user_name',$name);
                    //页面跳转
                    //$this -> redirect($url,$params=array(),$delay=间隔时间,$msg='');
                    $this -> redirect('Index/index');
                }
                $this -> error('请先通过邮件激活您的账号',U('showRegister'),1);
                exit;
            }
            $this -> error('用户名或密码不存在',U('login'),1);

        }else{
            $this -> display();
        }
    }
    public function regist(){
        $user=new \Model\UserModel();
        if(IS_POST){
            $data=$user->create();
            if($user->add($data)){
                $this->success('注册成功',U('showRegister'));
            }else{
                $this->error();
            }
        }else{

            $this->display();
        }

    }
    public function verifyImg(){
        $cfg=array(
            'imageH'    =>  30,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
            'fontSize'  =>  15,              // 验证码字体大小(px)
        );
        $very=new \Think\Verify($cfg);
        $very->entry();

    }
    public function checkCode(){
        $code=I('get.code');
        $very=new \Think\Verify();
        if($very->check($code)){
            echo json_encode(array('status'=>1));
        }else{
            echo json_encode(array('status'=>2));
        }
    }
    function showRegister(){
        $this->display();

    }
    function jihuo(){
        $user_id = I('get.user_id');
        $checkcode = I('get.checkcode');

        //更改user_check=1,user_check_code=null
        $user = D('User');
        //首先需要验证，再激活
        $userinfo = $user ->where(array('user_check'=>0))-> find($user_id);
        if($userinfo['user_check_code']===$checkcode){
            //2天之内需要激活账号，否则删除此账号
            if(time()-$userinfo['add_time']<3600*24*2){
                //验证码比较成功再激活
                $z = $user -> setField(array('user_id'=>$user_id,'user_check'=>1,'user_check_code'=>''));
                if($z){
                    $this -> success('会员激活成功',U('login'),1);
                }
            }else{
                //超过两天没有激活的账号就删除
                $user -> delete($user_id);
            }
        }else{
            $this -> error('操作有错误或账号已经激活',U('login'),1);
        }
    }
    public function logout(){
        session_destroy();
        $this->success('退出登陆',U('user/login'));
    }
}