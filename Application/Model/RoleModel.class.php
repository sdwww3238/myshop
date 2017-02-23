<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 2017/2/12
 * Time: 21:10
 */
namespace Model;
use Think\Model;
class RoleModel extends Model{
    protected function _before_update(&$data,$options){
        if($_POST['now_act']=='分配权限'){
            $data['role_auth_ids']=implode(',', $data['role_auth_ids']);

            $authinfo=D('auth')->where("auth_id in({$data['role_auth_ids']})")->select();

            $s='';
            foreach ($authinfo as $k=>$v){
                if(!empty($v['auth_c'])&&!empty($v['auth_a']))
                    $s.= $v['auth_c']."-".$v['auth_a'].",";
            }
            $s=rtrim($s,',');
            $data['role_auth_ac'] = $s;
        }
    }

    protected function _after_insert($data,$options){

    }

}