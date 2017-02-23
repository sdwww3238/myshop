<?php
namespace Common\Tools;
use Think\Controller;
class HomeController extends Controller{
    function __construct(){
        parent::__construct();
        $category=D('category');
        $cat_infoA=$category->where(array('cat_level'=>0))->select();
        $cat_infoB=$category->where(array('cat_level'=>1))->select();
        $cat_infoC=$category->where(array('cat_level'=>2))->select();
        $this->assign('cat_infoA',$cat_infoA);
        $this->assign('cat_infoB',$cat_infoB);
        $this->assign('cat_infoC',$cat_infoC);
    }
}