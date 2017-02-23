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
<div style="font-size: 13px;margin:10px 5px">
    <form action="<?php echo U('add');?>" method="post" enctype="multipart/form-data">
        <table border="1" width="100%" class="table_a" id="general-tab-tb">
            <tr>
                <td>权限名称</td>
                <td><input type="text" name="auth_name" /></td>
            </tr>
            <tr>
                <td>权限上级</td>
                <td>
                    <select name="auth_pid">
                        <option value="0">请选择</option>
                        <?php if(is_array($pinfo)): foreach($pinfo as $key=>$v): ?><option value="<?php echo ($v["auth_id"]); ?>"><?php echo str_repeat('----/',$v['auth_level']); echo ($v["auth_name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>控制器</td>
                <td><input type="text" name="auth_c" /></td>
            </tr>
            <tr>
                <td>操作方法</td>
                <td><input type="text" name="auth_a" /></td>
            </tr>
            <tr>
                <td cospan="100"><input type="submit" value="添加" /></td>
            </tr>
        </table>
    </form>
</div>
</body>

</html>