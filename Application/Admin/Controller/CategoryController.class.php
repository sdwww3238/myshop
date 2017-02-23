<?php
namespace Admin\Controller;
use \Common\Tools\BackController;
class CategoryController extends BackController{
    public function showlist(){
        $info=D('category')->order('cat_path')->select();
        $this->assign('info',$info);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $cat=new \Model\CategoryModel();
            $data= $cat->create();
            if($cat->add($data)){
                $this->success('添加分类成功',U('showlist'));
            }else{
                $this->error('添加分类失败');
            }
        }else{
            $pinfo=D('category')->where(array('cat_level'=>array('in','0,1')))->order('cat_path')->select();

            $this->assign('pinfo',$pinfo);
            $this->display();
        }

    }
}