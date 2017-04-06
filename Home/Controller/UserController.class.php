<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{

	protected $blog;
	protected $cate;
	protected $user;
	protected $comment;

	public function __construct(){
		parent::__construct();
		$this->blog = D('Admin/Blog');
		$this->cate = D('Admin/Cate');
		$this->user = D('Bloguser');
		$this->comment = D('Comment');
	}

	public function index(){
		// 文章分页
		$cnt = $this->blog->count('*');
		$pager = new \Think\Page($cnt,10);
		$blogs = $this->blog->field("id,title,content,category,comment_num,label,author,add_time")->order('add_time desc')->limit($pager->firstRow.','.$pager->listRows)->select();
		$this->assign('blogs',$blogs);
		
		$pager->lastSuffix = false;//最后一页不显示为总页数  
        $pager->setConfig('header','<li class="disabled hwh-page-info"><a>共<em>%TOTAL_ROW%</em>条  <em>%NOW_PAGE%</em>/%TOTAL_PAGE%页</a></li>');  
        $pager->setConfig('prev','上一页');
        $pager->setConfig('next','下一页');  
        $pager->setConfig('last','末页');  
        $pager->setConfig('first','首页');  
        $pager->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');  
		$pager = $this->bootstrap_page_style($pager->show());//重点在这里  

		$this->assign('pager',$pager);

		// 最新文章
		$new_blogs = S('new_blogs');
		if(!$new_blogs){
			$new_blogs = $this->blog->field('id,title')->order('add_time desc')->limit(10)->select();
			S('new_blogs',$new_blogs,3600);
			
		}
		session('new_blogs',$new_blogs);

		// 栏目
		$cate = S('cate');
		if(!$cate){
			$cate = $this->cate->field('id,cate_name,text_num')->select();
			S('cate',$cate,3600);
			
		}
		$this->assign('cate',$cate);
		session('cate',$cate);

		// 最新评论
		$comment = S('comment');
		if(!$comment){
			$comment = $this->comment->field('user_id,blog_id,content')->order('add_time desc')->limit(10)->select();
			S('comment',$comment,3600);
			
		}
		session('comment',$comment);

		$this->display();
	}

	// 改变TP分页样式
	protected function bootstrap_page_style($page_html){  
	    if ($page_html) {  
	        $page_show = str_replace('<div>','<nav><ul class="pagination">',$page_html);  
	        $page_show = str_replace('</div>','</ul></nav>',$page_show);  
	  
	        $page_show = str_replace('<span class="current">','<li class="active"><a>',$page_show);  
	        $page_show = str_replace('</span>','</a></li>',$page_show);  
	  
	        $page_show = str_replace(array('<a class="num"','<a class="prev"','<a class="next"','<a class="end"','<a class="first"'),'<li><a',$page_show);  
	        $page_show = str_replace('</a>','</a></li>',$page_show);  
	    }  
	    return $page_show;  
	}

	// 查看留言
	public function liuyan(){
		$this->display();
	}
	
	// 查看说明
	public function about(){
		$this->display();
	}
}
