<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
	public function index(){
		$blog = D('blog');
		$data = $blog->field("title,content,category,label,author,add_time")->order("add_time desc")->select();
		foreach ($data as $k => $v) {
			# code...
			$data[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
			$data[$k]['content'] = html_entity_decode($v['content']);
		}
		$this->assign("data",$data);
		$this->display();
	}
}
