<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
	public function index(){
		$blog = D('blog');
		$data = $blog->field("title,content,category,label,author,add_time")->order("add_time desc")->select();
		$this->assign("data",$data);
		$this->display();
	}
}
