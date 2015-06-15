<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    
	private $post=null;
	private $category=null;
	
    //初始化方法
	public function __initialize(){
	   $this->post=M('post');
	   $this->category=M('category');
	
	}
	
	
    public function index(){
	  $this->display();
    }
	
	public function about(){
      $this->display();
	}

}