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
                <span style="float: left;">当前位置是：商品管理-》商品分类列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加商品分类】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>名称</td>
                        <td>上级id</td>
                        <td>全路径</td>
                        <td>等级</td>

                        <td align="center">操作</td>
                    </tr>
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="">
                        <td><?php echo ($v["cat_id"]); ?></td>
                        <td><?php echo str_repeat('***/',$v['cat_level']); echo ($v["cat_name"]); ?></a></td>
                        <td><?php echo ($v["cat_pid"]); ?></td>
                        <td><?php echo ($v["cat_path"]); ?></td>
                        <td><?php echo ($v["cat_level"]); ?></td>

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