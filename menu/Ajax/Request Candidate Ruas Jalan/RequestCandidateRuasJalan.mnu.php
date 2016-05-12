<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateRuasJalanMenu extends AbstractHandlerMenu
{
	public $IdCity = NULL;
	
	public function RequestCandidateRuasJalanMenu(){AbstractHandlerMenu::AbstractHandlerMenu();}
	public function Name(){return 'Request Kandidat Ruas Jalan';}
	public function OnSetKey($key = array()){
		if(
			$key['loc_city.id'] != NULL 
		){
			$this->IdCity = $key['loc_city.id'];
		}
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}	
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>