<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>添加商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》添加商品信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo U('showlist');?>">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Admin/Role/distribute.html?role_id=51" method="post" enctype="multipart/form-data">
                <input type='hidden' name='role_id' value="<?php echo ($roleinfo["role_id"]); ?>" />
                <table border="1" width="100%" class="table_a" id="general-tab-tb">
                    <tr>
                        <td style='font-size:30px;' colspan='100'>当前分配权限的角色：<?php echo ($roleinfo["role_name"]); ?></td>
                    </tr>
                    <?php if(is_array($auth_infoA)): foreach($auth_infoA as $key=>$v): ?><tr>
                            <td><input type='checkbox' name='role_auth_ids[]' value='<?php echo ($v["auth_id"]); ?>'
                                <?php if(in_array(($v['auth_id']), is_array($roleinfo['role_auth_ids'])?$roleinfo['role_auth_ids']:explode(',',$roleinfo['role_auth_ids']))): ?>checked='checked'<?php endif; ?>
                                ><?php echo ($v["auth_name"]); ?></td>
                            <td>
                                <?php if(is_array($auth_infoB)): foreach($auth_infoB as $key=>$vv): if($vv['auth_pid'] == $v['auth_id']): ?><div class='yang'><input type='checkbox' name='role_auth_ids[]' value='<?php echo ($vv["auth_id"]); ?>'
                                            <?php if(in_array(($vv['auth_id']), is_array($roleinfo['role_auth_ids'])?$roleinfo['role_auth_ids']:explode(',',$roleinfo['role_auth_ids']))): ?>checked='checked'<?php endif; ?>
                                            ><?php echo ($vv["auth_name"]); ?></div><?php endif; endforeach; endif; ?>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    <tr>
                        <td colspan='100'><input type="submit" name='now_act' value="分配权限" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>

</html>