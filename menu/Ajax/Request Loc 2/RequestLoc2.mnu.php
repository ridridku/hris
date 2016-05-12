<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestLoc2Menu extends AbstractHandlerMenu
{
	public $IdLoc1 = NULL;
	public function RequestLoc2Menu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
		}
	public function Name(){return 'Request Loc 2';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function OnSetKey($key = array()){
		if(
			$key['loc_1.id'] != NULL  
		){
			$this->IdLoc1 = $key['loc_1.id'];
		}	
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}
}
?>