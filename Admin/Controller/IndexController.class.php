<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller {
    protected $cate;
    protected $blog;

    public function __construct(){
        parent::__construct();
        $this->cate = D('Cate');
        $this->blog = D('Blog');
    }

    public function index(){
        $arr = ['你想做什么！','老实一点吧！','别乱动！'];
        shuffle($arr);
        $this->success($arr[0] , U('Home/User/index'),3);
    }

    // 添加日志
    public function add(){
    	if(IS_POST){
    		$data = I('POST.');
            if($data['addcategory'] == 'on'){ // 如果栏目是新加的
                $new['cate_name'] = $data['newcategory'];
                $new = $this->cate->create($new);
                $rs = $this->cate->add($new);
                if($rs){ // 新增栏目成功
                    $data['category'] = $this->cate->field('id')->where("cate_name='".$new['cate_name']."'")->find()['id'];
                }
            }
            $category = $data['category'];
            $data = $this->blog->create($data);
            // var_dump($data);exit;
            $rs = $this->blog->add($data);
            if(is_string($rs)){
                $this->cate->where("id=".$category)->setInc('text_num');
                echo '添加成功';
            }
    	}else{
            $category = $this->cate->field('id,cate_name')->select();
            $this->assign('cate', $category);
            $this->display();
        }
    }

    // 日志列表
    public function bloglist(){
        $bloglist = $this->blog->field('id,title,category,add_time')->order('add_time desc')->select();
        $cate = $this->cate->field('id,cate_name')->select();
        $this->assign('bloglist',$bloglist);
        $this->assign('cate',$cate);
        $this->display();
    }

    // 修改日志
    public function mod(){
        if(IS_GET){ // 查看日志
            $id = I('get.id');
            $data = $this->blog->field('id,title,category,content,label,author')->find($id);
            $cate = $this->cate->field('id,cate_name')->select();
            $this->assign('data',$data);
            $this->assign('cate',$cate);
            $this->display();
        }else if(IS_POST){ // 修改日志
            $data = I('post.');
            
            // 先减去原栏目上的文章数量
            $ori_cate = $this->blog->field('category')->find($data['id']);
            $this->cate->where("id=".$ori_cate['category'])->setDec('text_num');

            // 然后判断栏目是否为新增
            if($data['addcategory'] == 'on'){ // 新增
                $new['cate_name'] = $data['newcategory'];
                $new = $this->cate->create($new);
                $rs = $this->cate->add($new);
                if($rs){ // 新增成功 
                    $data['category'] = $this->cate->field('id')->where("cate_name='".$new['cate_name']."'")->find()['id'];
                }
            }
            // var_dump($data);exit;
            $category = $data['category'];
            $rs = $this->blog->where('id='.$data['id'])->save($data);
            if($rs){
                $rs = $this->cate->where('id='.$category)->setInc('text_num');
                if($rs){
                    echo '修改成功!';
                }
            }
        }
    }

    // 删除日志
    public function del(){
        if(IS_GET){
            $id = I('get.id');
            // 对应栏目下减少文章数量
            $category = $this->blog->field('category')->find($id)['category'];
            $this->cate->where('id='.$category)->setDec('text_num');
            // 删除文章
            $this->blog->where('id='.$id)->delete();
            echo '删除成功';
        }
    }

}