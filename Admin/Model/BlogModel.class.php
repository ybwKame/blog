<?php
namespace Admin\Model;
use Think\Model;

class BlogModel extends Model{
	protected $_auto = array(
		array('add_time','time',1,'function'),
		array('mod_time','time',2,'funciton')
	);
}