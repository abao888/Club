<?php
// 本类由系统自动生成，仅供测试用途
class AdminAction extends Action {

	private $post=null;
	private $user=null;
	private $comment=null;
    private $categroy=null;

    protected function _initialize(){
      if($_SESSION['isLogin']!=1){
    		$this->error('请登录',U('User/login'));
    	}

    	$this->post=M('post');
    	$this->user=M('user');
    	$this->comment=M('comment');
    	$this->categroy=M('categroy');

    }
    public function index(){
         $this->assign('index','class="active"');
	     $this->display();
    }
 
    public function topiclist(){
    	import('ORG.Util.Page');
    	//总数量
    	$counts=$this->post->count();
    	$page=new Page($counts,3);
    	//生成 下一页 上一页等
    	$lists=$this->post->limit($page->firstRow.','.$page->listRows)->oreder('create_date desc')->select();
    	//格式化数据
    	foreach ($lists as $key => $val) {
    		$userinfo=$this->user->field('username')->finde($val['uid']);
    		$categroyinfo=$this->categroy->find($val['type_id']);
    		$lists[$key]['username']=$userinfo;
    		$lists[$key]['typename']=$categroyinfo?$categroyinfo['username']:'分类';
    	}
    	//对content字符串截取
        //$list

    	//dump();
    	$this->assign('page',$pages);
    	$this->assign('lists',$lists);

    	$this->assign('topiclist','class="active"');
    	$this->display();
    }

}