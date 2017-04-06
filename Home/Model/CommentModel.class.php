<?php
namespace Home\Model;
use Think\Model;

class CommentModel extends Model{
	protected $_auto = array(
		array('add_time','time',1,'function'),
	);
}