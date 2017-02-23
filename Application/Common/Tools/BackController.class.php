<?php
namespace Common\Tools;
use Think\Controller;
class BackController extends Controller{
    function __construct(){
        parent::__construct();
       $admin_id=session('admin_id');
       $admin_name=session('admin_name');
       $nowAC=CONTROLLER_NAME.'-'.ACTION_NAME;
       if(!empty($admin_name)){
           $allowAC="Login-logout,Login-login,Login-verifyImg,Index-index,Index-head,Index-left,Index-right,Login-checkCode";
           $roleinfo=D('manager')->alias('m')->join('__ROLE__ r on m.mg_role_id=r.role_id')->field('r.role_auth_ac')
               ->where(array('mg_id'=>$admin_id))->find();
           $role_ac=$roleinfo['role_auth_ac'];
           if(strpos($role_ac,$nowAC)===false&&strpos($allowAC,$nowAC)===false&&$admin_name!='admin'){
               exit('没有权限访问');
           }
       }else{
           $allowAC = "Login-login,Login-verifyImg,Login-checkCode";
           if(strpos($allowAC,$nowAC)===false){
               //$this -> redirect('Admin/login');

               //通过js，可以使得全部的frameset都跳转
               $js = <<<eof
                    <script type="text/javascript">
                    window.top.location.href = "/index.php/Admin/Login/login";
                    </script>
eof;
               echo $js;
           }
       }

    }
}
