<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>会员列表</title>
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：权限管理-》管理员管理</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加角色】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>名称</td>
                        <td>登记时间</td>
                        <td>角色</td>
                        <td align="center">操作</td>
                    </tr>
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="">
                        <td><?php echo ($v["mg_id"]); ?></td>
                        <td><?php echo ($v["mg_name"]); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$v["mg_time"])); ?></td>
                        <td><?php echo ($v["role_name"]); ?></td>
                        <td><a href="" >修改</a></td>
                        <td>
                            <a href="">删除</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>