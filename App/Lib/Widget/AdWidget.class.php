<?php
class AdWidget extends Widget{
	public function render($data){
	   if(false){
	   	 $tpl='ad1';
	   }else{
	   	 $tpl='ad2';
	   }
       $content=$this->renderFile($tpl);
	   return $content;
	}
}