<?php
namespace Admin\Controller;
use \Common\Tools\BackController;
class TypeController extends BackController {
    public function showlist(){
        $info=D('type')->select();
        $this->assign('info',$info);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $auth=new \Model\TypeModel();
            $data= $auth->create();
            if($auth->add($data)){
                $this->success('添加类型成功',U('showlist'));
            }else{
                $this->error('添加类型失败');
            }
        }else{
            $this->display();
        }

    }
}