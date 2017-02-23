<?php
namespace Model;
use Think\Model;
class CategoryModel extends Model{

    protected function _after_insert($data,$options){
        if($data['cat_pid']==0){
            $path=$data['cat_id'];
        }else{
            $pinfo=$this->field('cat_path')->find($data['cat_pid']);
            $ppath=$pinfo['cat_path'];
            $path=$ppath.'-'.$data['cat_id'];
        }
        $level=substr_count($path,'-');
        $this->save(array('cat_id'=>$data['cat_id'],'cat_path'=>$path,'cat_level'=> $level));
    }

}