<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>会员列表</title>
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="/Public/Admin/js/ue/third-party/jquery.min.js"></script>
        <script type="text/javascript">
            function show_attr(){
                var type_id = $('#type_id option:selected').val(); //被选中类型的id值
                //利用ajax去服务器端获得“选中类型”对应的属性信息
                $.ajax({
                    url:"<?php echo U('Attribute/getInfoByType');?>",
                    data:{'type_id':type_id},
                    dataType:'json',
                    type:'get',
                    success:function(msg){
                        //遍历msg中的每个属性信息并显示
                        var s = "";
                        $.each(msg,function(k,v){
                            s+= "<tr>";
                            s+= "<td>"+v.attr_id+"</td>";
                            s+= "<td>"+v.attr_name+"</td>";
                            s+= "<td>"+v.type_id+"</td>";
                            s+= "<td>"+v.attr_is_sel+"</td>";
                            s+= "<td>"+v.attr_write_mod+"</td>";
                            s+= "<td>"+v.attr_sel_opt+"</td>";
                            s+= "</tr>";
                        });
                        $('.table_a tr:not(:first)').remove();
                        $('.table_a').append(s);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：属性管理-》属性列表管理</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo U('add');?>">【添加属性】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px; margin: 10px 5px;">
            按照商品类型显示： <select id="type_id" onchange="show_attr()">
            <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): if(($_GET['type_id']) == $v['type_id']): ?><option value="<?php echo ($v["type_id"]); ?>" selected="selected">
                        <?php else: ?>
                    <option value="<?php echo ($v["type_id"]); ?>"><?php endif; ?>
                <?php echo ($v["type_name"]); ?></option><?php endforeach; endif; ?>
        </select>

            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>名称</td>
                    <td>类型</td>
                    <td>选取方式</td>
                    <td>录入方式</td>
                    <td>供选取的值</td>
                        <td align="center">操作</td>
                    </tr>
                    <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr id="">
                        <td><?php echo ($v["attr_id"]); ?></td>
                        <td><?php echo ($v["attr_name"]); ?></td>
                        <td><?php echo ($v["type_id"]); ?></td>
                        <td><?php echo ($v["attr_is_sel"]); ?></td>
                        <td><?php echo ($v["attr_write_mod"]); ?></td>
                        <td><?php echo ($v["attr_sel_opt"]); ?></td>
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