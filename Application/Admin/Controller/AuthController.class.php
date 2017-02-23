<?php
namespace Admin\Controller;
use \Common\Tools\BackController;
class AuthController extends BackController{
    public function showlist(){
        $info=D('auth')->order('auth_path')->select();
        $this->assign('info',$info);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $auth=new \Model\AuthModel();
            $data= $auth->create();
            if($auth->add($data)){
                $this->success('分配权限成功',U('showlist'));
            }else{
                $this->error('分配权限失败');
            }
        }else{
            $pinfo=D('auth')->where(array('auth_level'=>array('in','0,1')))->order('auth_path')->select();
            $this->assign('pinfo',$pinfo);
            $this->display();
        }

    }
}