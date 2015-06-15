<?php
class UserInfoWidget extends Widget{
   public function render($data){
       if(is_array($data)){
	     $var=$data;
	   }
       //判断是否登录
	   $mid=$_SESSION['mid'];
	   if($mid){
	       $var=$this->getUserInfo($mid);
	       $tpl='userinfo';
	   }else{
	       $tpl='unlogin';
	   }
       $content=$this->renderFile($tpl,$var);
	   return $content;
   }
   
   private function getUserInfo($uid){
       $user=M("User");
	   $user->find($uid);
   }
}

?>