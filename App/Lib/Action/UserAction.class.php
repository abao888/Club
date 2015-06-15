<?php
class UserAction extends Action{
   public function login(){
      $this->display();
   }
   
   public function doLogin(){
     if($_POST['email']){
	   $map['email']=$_POST['email'];
	   $map['password']=md5($_POST['password']);
	   $user=M('user');
	   $re=$user->where($map)->find();
	   if($re){
	       
		  $_SESSION['isLogin']=1;
		  $_SESSION['mid']=$re;
		  $_SESSION['userinfo']=$re['username'];
			  
	      $this->success("登录成功！",U('Index/index')); 
	    }else{
	      $this->error("登录失败！");
	   } 
	 }else{
	      $this->error("登录失败！");
	 }
   }
   
   public function register(){
      $this->display();
   }
   
   public function doRegister(){
      if($_POST['username']){
	    $user=M('user');
		$re=$user->where(array('username'=>$_POST['username']))->find();
		if($re!=null){
		   $this->error('用户名已经注册过了');
		   return false;
		}else{
		   $data['username']=$_POST['username'];
		   $data['password']=md5($_POST['password']);
		   $data['email']=$_POST['email'];
		   $data['status']=0;
		   $data['create_time']=time();
		   $data['ip']=get_client_ip();
		   
		   $re=$user->add($data);
		   if($re){
		      $_SESSION['isLogin']=1;
			  $_SESSION['mid']=$re;
			  $_SESSION['userinfo']=$data['username'];
			  
			  $this->success('注册成功!',U('Index/index'));
		   
		   }else{
		      $this->error('注册失败！');
		   }
		}
	  }else{
	    $this->error("注册失败！");
	  }
   }
   
   //注销用户的登录
   public function layout(){
     unset($_SESSION['isLogin']);
	 unset($_SESSION['mid']);
	 unset($_SESSION['userinfo']);
	 $this->success("退出成功！",U('Index/index'));
   
   }
   
   //个人资料设置
   public function setinfo(){
     $this->display();
   }
   
   //头像设置
   public function setavatar(){
     $user=M('user');
	 $info=$user->find($_SESSION['mid']);
	 $this->assign('info',$info);
     $this->display();
   }
   
   //设置密码
   public function setpwd(){
      $this->display();
   }
   
   public function doSetpwd(){
     if($_POST['oldpwd']){
	   $user=M('user');
	   $map['id']=$_SESSION['mid'];
	   $map['password']=md5($_POST['oldpwd']);
	   $re=$user->where($map)->find();
	   if(!$re){
	     $this->error('请输入正确的密码');
	   }else{
	     $data['password']=md5($_POST['newpwd2']);
		 $re=$user->where(array('id'=>$_SESSION['mid']))->save($data);
		 
		 if($re){
		    unset($_SESSION['mid']);
			unset($_SESSION['isLogin']);
			unset($_SESSION['userinfo']);
			$this->success("修改成功",U('User/login'));
		 }else{
		    $this->error(error);
		 }
	   }
	 }else{
	    $this->error('原密码错误');
	 }
   
   }
   
   //不上传头像，系统会默认分配给你一张头像
   public function uploadAvatar(){
    if($_FILES){
	   import('ORG.Net.UploadFile');
	   $upload=new UploadFile();
	   $upload->maxSize=3145728;
	   $upload->allowExts=array('jpg','gif','png','jpeg');
	   $upload->savePath='./Uploads/';
	   
	   //生成缩略图
	   $upload->thumb=true;
	   $upload->thumbMaxWidth="100";
	   $upload->thumbMaxHeight="100";
	   
	   if(!$upload->upload()){
	     $this->error($upload->getErrorMsg());
	   }else{
	     $info=$upload->getUploadFileInfo();
		
		 $user=M('user');
		 $re=$user->where(array('id'=>$_SESSION['mid']))->save(array('avatar'=>$info[0]['savename']));
		 if($re){
		   $this->success('修改成功！',U('User/setavatar'));
		 }else{
		   $this->error('修改失败！');
		 }
	   }
	
	}else{
	  $this->error('请选择图片');
	}
   }
   
   //验证码
   public function verify(){
     import('ORG.Util.Image');
	 Image::buildImageVerify();
   }

   public function message(){
   	  $this->display();
   }

   public function issue(){
   	  $this->display();
   }

}
?>