<?php
namespace Admin\Controller;
use \Common\Tools\BackController;
class LoginController extends BackController {
    public function login(){
        if(IS_POST){
            $name = $_POST['admin_user'];
            $pwd = $_POST['admin_psd'];
            //用户名和密码的校验
            $manager = D('Manager');
            $info = $manager ->where(array('mg_name'=>$name,'mg_pwd'=>$pwd))-> find();
            if($info != null){
                session('admin_id',$info['mg_id']);
                session('admin_name',$info['mg_name']);
                $this ->success('登陆成功',U('index/index'),0);
            }else{
                $this -> error('用户名或密码错误');
            }

        }else{
            $this -> display();
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
    public function logout(){
        session(null);
        $this->redirect('Login/login');
    }
    public function showlist(){
        $info=M('manager')->alias('m')->join('LEFT JOIN __ROLE__ r on m.mg_role_id = r.role_id')->field('m.*,r.role_name')->select();
        $this->assign('info',$info);
        $this->display();
    }
}
