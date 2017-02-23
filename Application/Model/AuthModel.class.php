<?php
namespace Model;
use Think\Model;
class AuthModel extends Model{

    protected function _after_insert($data,$options){
        if($data['auth_pid']==0){
            $path=$data['auth_pid'];
        }else{
            $pinfo=$this->field('auth_path')->find($data['auth_pid']);
            $ppath=$pinfo['auth_path'];
            $path=$ppath.'-'.$data['auth_id'];
        }
        $level=substr_count($path,'-');
        $this->save(array('auth_id'=>$data['auth_id'],'auth_path'=>$path,'auth_level'=> $level));
    }

}