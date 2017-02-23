<?php
namespace Admin\Controller;
use \Common\Tools\BackController;
class IndexController extends BackController{
    public function index(){
        $this->display();
    }
    public function head(){
        $this->display();
    }
    public function left(){
        $admin_id=session('admin_id');
        $admin_name=session('admin_name');
        if($admin_name!=='admin'){
            $auth_ids=D('Manager')->alias('m')->join('__ROLE__ r on m.mg_role_id=r.role_id')->field('r.role_auth_ids')->
            where(array('m.mg_id'=>$admin_id))->find();
            $auth_ids=$auth_ids['role_auth_ids'];
            //dump($auth_ids);
            $auth_infoA=D('Auth')->where("auth_id in ($auth_ids) and auth_level=0")->select();
            $auth_infoB=D('Auth')->where("auth_id in ($auth_ids) and auth_level=1")->select();
        }else{
            $auth_infoA=D('Auth')->where("auth_level=0")->select();
            $auth_infoB=D('Auth')->where("auth_level=1")->select();
        }

        //dump($auth_infoA);die;
        $this->assign('auth_infoA',$auth_infoA);
        $this->assign('auth_infoB',$auth_infoB);
        $this->display();
    }
}