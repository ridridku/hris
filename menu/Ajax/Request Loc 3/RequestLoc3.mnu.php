<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestLoc3Menu extends AbstractHandlerMenu
{
	public $IdLoc2 = NULL;
	public function RequestLoc3Menu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
		}
	public function Name(){return 'Request Loc 3';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function OnSetKey($key = array()){
		if(
			$key['loc_2.id'] != NULL  
		){
			$this->IdLoc2 = $key['loc_2.id'];
		}	
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}
}
?>