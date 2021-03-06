<?php
namespace Admin\Controller;
use \Common\Tools\BackController;

class GoodsController extends BackController {
    //列表展示
    public function showlist(){
        $goods = new \Model\GoodsModel();
        $nowinfo = $goods -> fetchData();

        $info = $nowinfo['pageinfo']; //当前页数据信息
        $pagelist = $nowinfo['pagelist'];//页码列表信息

        $this -> assign('info',$info);
        $this -> assign('pagelist',$pagelist);
        $this -> display();

    }
    public function add(){
        $typeinfo=D('type')->select();
        $catinfo=D('category')->order('cat_path')->select();
        $this->assign('catinfo',$catinfo);
        $this->assign('typeinfo',$typeinfo);
        $this->display();
    }
    public function addOk(){
        $goods = new \Model\GoodsModel();  //实例化GoodsModel对象
        //两个逻辑：展示、收集
        if(IS_POST){ //收集表单
            $data = $goods -> create();
            if($goods -> add($data)){
                $this ->success('添加商品成功', U('showlist'), 2);
            }else{
                $this ->error('添加商品失败');
            }
        }else{//展示表单

            $this -> display();
        }
    }

    public function update(){
        $goods = new \Model\GoodsModel();
        if(IS_POST){
            $data = $goods -> create();
            if($goods -> save($data))
                $this -> success('修改商品成功', U('showlist'), 2);
            else
                $this -> error('修改商品失败', U('upd',array('goods_id'=>$data['goods_id'])), 2);
        }else{
            $goods_id = I('get.goods_id'); //接收被修改商品的goods_id
            $info = $goods->find($goods_id);//查询被修改商品的信息

            /*************获得相册信息*************/
            $picsinfo = D('GoodsPics')->where(array('goods_id'=>$goods_id))->select();
            if(!empty($picsinfo))

                $this -> assign('picsinfo',$picsinfo);
            /*************获得相册信息*************/
            $catinfo=D('category')->order('cat_path')->select();
            $this->assign('catinfo',$catinfo);

            $catextinfo=D('goods_cat')->where(array('goods_id'=>$goods_id))->select();
            $this->assign('catextinfo',$catextinfo);
            $typeinfo=D('type')->select();
            $this->assign('typeinfo',$typeinfo);
            $this -> assign('info',$info);
            $this -> display();
        }
    }
    function delPics(){
        $pics_id = I('get.pics_id');
        //查询图片并
        $info = D('GoodsPics')->find($pics_id);
        //①删除相册图片[物理删除]
        unlink($info['pics_big']);
        unlink($info['pics_small']);

        //②删除数据记录信息
        $z = D('GoodsPics')->delete($pics_id); //返回删除记录条数,1条
        if($z){
            echo "删除成功！";
        }
    }
    function delGoods(){
        $goods_id = I('get.goods_id');  //获得被删除商品的id信息
        $goods = D('goods');
        $z = $goods -> setField(array('goods_id'=>$goods_id,'is_del'=>'删除'));
        //setField()内部有调用save()方法，
        if($z){
            echo json_encode(array('status'=>1)); //ok  99%
        }else{
            echo json_encode(array('status'=>2)); //fail 1%
        }
    }

    function getAttributeByType(){
        $type_id = I('get.type_id');
        $attrinfo = D('Attribute')->where(array('type_id'=>$type_id))->select();
        echo json_encode($attrinfo);
    }
    function getAttributeByTypeUpd(){
        $type_id = I('get.type_id');
        $goods_id = I('get.goods_id');
        //判断当前选取的type_id和本身商品的是否一致
        $goodsinfo = D('Goods')->find($goods_id);
        if($type_id!== $goodsinfo['type_id']){

            $attrinfo = D('Attribute')->where(array('type_id'=>$type_id))->select();
            $info['mark'] = 1; ////其他类型对应的属性信息
            $info[1] = $attrinfo;
            //$info是三维数组
            echo json_encode($info);
        }else{
            //数据表：goods_attr  attribute
            $attrinfo = D('GoodsAttr')
                ->alias('g')
                ->join('__ATTRIBUTE__ a on g.attr_id=a.attr_id')
                ->where(array('goods_id'=>$goods_id))
                ->field('g.attr_id,g.attr_value,a.attr_name,a.attr_is_sel,a.attr_sel_opt')
                ->select();
            //dump($attrinfo);//普通的二维数组信息

            $tmp = array();
            foreach($attrinfo as $k => $v){
                if(!empty($tmp[$v['attr_id']]) || $v['attr_is_sel']==1){
                    //多选属性整合
                    $tmp[$v['attr_id']]['attr_id'] = $v['attr_id'];
                    $tmp[$v['attr_id']]['attr_name'] = $v['attr_name'];
                    $tmp[$v['attr_id']]['attr_is_sel'] = $v['attr_is_sel'];
                    $tmp[$v['attr_id']]['attr_sel_opt'] = $v['attr_sel_opt'];
                    $tmp[$v['attr_id']]['attr_value'][] = $v['attr_value'];
                }else{
                    //单选属性整合
                    $tmp[$v['attr_id']] = $v;
                }
            }
            //dump($tmp);//整合后的三维数组信息
            $info['mark'] = 2; //商品本身拥有的的属性信息
            $info[1] = $tmp;
            //$info变为一个四维数组
            echo json_encode($info);
        }
    }
}
