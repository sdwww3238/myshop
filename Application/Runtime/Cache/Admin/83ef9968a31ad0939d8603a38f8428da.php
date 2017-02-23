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
    <form action="<?php echo U('add');?>" method="post">
        <table border="1" width="100%" class="table_a" id="general-tab-tb">
            <tr>
                <td>属性名称</td>
                <td><input type="text" name="attr_name" /></td>
            </tr>
            <tr>
                <td>所属类型</td>
                <td><select name="type_id">
                        <option value="0">--请选择--</option>
                        <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><option value="<?php echo ($v["type_id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
                    </select><span style="color:red">*</span>
                </td>
            </tr>
            <tr>
                <td>是否可选</td>
                <td>
                    <input type="radio" name="attr_is_sel" value="0" checked="checked" />单选
                    <input type="radio" name="attr_is_sel" value="1" />多选
                </td>
            </tr>
            <tr>
                <td>录入方式</td>
                <td>
                    <input type="radio" name="attr_write_mod" value="0" checked="checked" />手工
                    <input type="radio" name="attr_write_mod" value="1" />从以下选取
                </td>
            </tr>
            <tr>
                <td>可选信息值</td>
                <td><textarea name="attr_sel_opt"></textarea>多个值中间使用,分割</td>
            </tr>
            <tr>
                <td cospan="100"><input type="submit" value="添加" /></td>
            </tr>
        </table>
    </form>
</div>
</body>

</html>