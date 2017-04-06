<?php
namespace Home\Controller;
use Think\Controller;

class ArticleController extends Controller{

	protected $blog;
	protected $cate;

	public function __construct(){
		parent::__construct();
		$this->blog = D('Admin/Blog');
		$this->cate = D('Admin/Cate');
	}

	// 查看文章
	public function view(){
		if(isset($_GET['id']) && $_GET['id'] != ''){
			$blog = $this->blog->field('title,content,category,comment_num,label,author,add_time,ding,cai')->find($_GET['id']);
			$this->assign('blog',$blog);

			$cate = $this->cate->field('cate_name')->find($blog['category']);
			$this->assign('cate',$cate);
			
			$this->display();
		}
	}

	// 查看文章列表
	public function list(){
		if(IS_GET){
			$id = I('get.id');
			$blogs = S('blogs');
			if(!$blogs){
				$blogs = $this->blog->field('id,title,comment_num,category,label,author,add_time')->where('category='.$id)->order('add_time desc')->select();
				S('blogs',$blogs,3600);
			}
			$cate = S('cate');
			if(!$cate){
				$cate = $this->cate->field('id,cate_name')->select();
				S('cate',$cate,3600);
			}
			$this->assign('cate',$cate);
			$this->assign('blogs',$blogs);
			$this->display();
		}
		
	}
}