<?php
class PostAction extends Action{
	public function index(){
		$data=M('post')->where(id>0)->select();
		var_dump($data);
		$this->display($data);
	}

    //职业版块
	public function career(){
       $this->display();
	}

}