<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestLoc5Menu extends AbstractHandlerMenu
{
	public $IdLoc4 = NULL;
	public function RequestLoc5Menu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
		}
	public function Name(){return 'Request Loc 5';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function OnSetKey($key = array()){
		if(
			$key['loc_4.id'] != NULL  
		){
			$this->IdLoc4 = $key['loc_4.id'];
		}	
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}
}
?>