<?php
namespace Model;
use Think\Model;
class UserModel extends Model{
    protected $_map             =   array(
        'name'=>'user_name',
        'password'=>'user_pwd',
        'email'=>'user_email',


    );  // 字段映射定义
    protected $_auto=array(
        array('add_time','time',1,'function'),
        array('user_pwd','md5',1,'function')
    );
    protected function _after_insert(&$data,$options){
        if($_POST['act']=='regist'){
            $code=md5(uniqid());
            $this->setField(array('user_id'=>$data['user_id'],'user_check_code'=>$code));
            $link="http://www.touchme.com/index.php/Home/User/jihuo/user_id/".$data['user_id']."/checkcode/".$code;
            sendMail($data['user_email'],'会员注册激活',"请点击一下超链接，激活您的账号：<a href='".$link."' target='_blank'>".$link."</a>");
        }
    }
}