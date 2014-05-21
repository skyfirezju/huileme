<?php
class FormModel extends Model {
    // 定义自动验证
    protected $_validate    =   array(
    	//验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]
        array('title','require','标题必须'),
        );
    // 定义自动完成
    protected $_auto    =   array(
    	//完成字段1,完成规则,[完成条件,附加规则] 1代表新增数据的时候处理
        array('create_time','time',1,'function'),
        );
 }
