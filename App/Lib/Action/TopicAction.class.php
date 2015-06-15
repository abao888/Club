<?php
/*
*主题类
*/
class TopicAction extends Action{
	public function index(){
		$this->display();
	}

	//添加话题
	public function addtopic(){
	  if($_SESSION['isLogin']!=1){
	     $this->error("请登录以后再发布新话题",U('User/login'));
	  }else{
	     $re=M('category')->field('name')->select();
		 $this->assign('typelist',$re);
	     $this->display();
	  }
	}

		//添加处理发表的话题
	public function doAddNewTopic(){
	  if($_POST['title']){
	    $data['title']=$_POST['title'];
		$data['content']=$_POST['content'];
		$data['tag']=array('1','2','3');
		$data['type_id']=$_POST['type'];  //话题类型 分类ID
		$data['comment_count']=0;  //评论总量
		$data['create_date']=time(); //创建时间
		$data['hits']=0;  //点击数  
		
		$post=M('post');
		$re=$post->add($data);
		//dump($data);
		
		if($re){
		  $this->success('发布新话题成功',U('Topic/topic_detail'));
		}else{
		  $this->error('发布失败！');
		}
	  }else{
	      $this->error('发布失败！没有填写标题');
	  }
	}
	
	//显示话题的详细信息 用户可以浏览和评论 转发
	public function topic_detail(){
	   $id=$_POST['id'];
	   if(!$id){
	     $this->error('当前话题不存在或者已经删除！',U('Topic/addtopic'));
	   }else{
	   //查询数据库，判断返回的数据是否正确
	   $re=M('post')->find($id);
	   dump($re);
	   
	   }
	   //$this->display();
	}
}