<?php
class SpecialAction extends Action{
	public function index(){
	   for($i=0;$i<10;$i++){
	   	  $res[$i]=rand(100,400);
	   }
	   $this->assign('height',$res);
       $this->display();
	}

	public function getMore(){
		for($i=0;$i<6;$i++){
			$res[$i]=rand(100,400);
		}
		$this->ajaxReturn($res);
	}
}
?>