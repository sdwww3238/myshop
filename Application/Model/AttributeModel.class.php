<?php
namespace Model;
use Think\Model;
class AttributeModel extends Model{
    protected $_validate=array(
        array('type_id','0','类型必须选择',0,'notequal'),
    );
}