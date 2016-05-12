<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidatePilihanPropinsiLebarRuasMenu extends AbstractHandlerMenu{
	public $IdPropinsi = NULL;
	public function RequestCandidatePilihanPropinsiLebarRuasMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Piihan Propinsi';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>