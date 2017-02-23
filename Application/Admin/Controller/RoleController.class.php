<?php
namespace Admin\Controller;
use \Common\Tools\BackController;
class RoleController extends BackController{
    public function showlist(){
        $info = D('Role')->select();
        $this -> assign('info',$info);
        $this -> display();
    }
    public function distribute(){
        $role=new \Model\RoleModel();
        if(IS_POST){
            $data=$role->create();
            if($role->save($data)){
                $this->success('分配权限成功',U('showlist'));
            }else{
                $this->error('分配权限失败');
            }
        }else{
            $role_id=I('get.role_id');

            $roleinfo=$role->find($role_id);

            $auth_infoA=D('Auth')->where("auth_level=0")->select();
            $auth_infoB=D('Auth')->where("auth_level=1")->select();
            $this->assign('auth_infoA',$auth_infoA);
            $this->assign('auth_infoB',$auth_infoB);
            $this->assign('roleinfo',$roleinfo);
            $this->display();
        }

    }
}