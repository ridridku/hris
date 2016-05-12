<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidatePropinsiMenu extends AbstractHandlerMenu{
	public $Kode = NULL;
	
	public function RequestCandidatePropinsiMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Kandidat Propinsi';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>