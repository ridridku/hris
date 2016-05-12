<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestLoc4Menu extends AbstractHandlerMenu
{
	public $IdLoc3 = NULL;
	public function RequestLoc4Menu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
		}
	public function Name(){return 'Request Loc 4';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function OnSetKey($key = array()){
		if(
			$key['loc_3.id'] != NULL  
		){
			$this->IdLoc3 = $key['loc_3.id'];
		}	
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}
}
?>