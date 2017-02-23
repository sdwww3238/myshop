<?php
namespace Admin\Controller;
use \Common\Tools\BackController;
class AttributeController extends BackController{
    public function showlist(){
        $type_id=I('get.type_id');
        $info=D('attribute')->where(array('type_id'=>$type_id))->select();
        $typeinfo=D('type')->select();
        $this->assign('typeinfo',$typeinfo);
        $this->assign('info',$info);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $auth=new \Model\AttributeModel();
            $data= $auth->create();
            if($data){
                if($auth->add($data)){
                    $this->success('添加属性成功',U('Type/showlist'));
                }else{
                    $this->error('添加属性失败');
                }
            }else{
                $errorinfo=$auth->getError();
                $this->error($errorinfo,1);
            }

        }else{
            $typeinfo=D('type')->select();
            $this->assign('typeinfo',$typeinfo);
            $this->display();
        }

    }
    function getInfoByType(){
        $type_id = I('get.type_id');
        $info = D('Attribute')->where(array('type_id'=>$type_id))->select();
        echo json_encode($info);
    }
}
