<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function add(){
    	if(IS_POST){
    		$data = I('POST.');
    	}
    	$blog = D('Blog');
    	$data = $blog->create($data);
    	$rs = $blog->add($data);
    	if(is_string($rs)){
    		echo '添加成功';
    	}
    }
}