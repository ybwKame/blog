<?php
namespace Home\Model;
use Think\Model;

class BloguserModel extends Model{
	protected $_auto = array(
		array('add_time','time',1,'function'),
		array('touxiang','/data/touxiang/default.jpg',1,'string'),
		array('password','md5',1,'function'),
	);
}