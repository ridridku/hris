<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateInGroupMenu extends AbstractHandlerMenu{
	public $IdGroup = NULL;
	
	public function RequestCandidateInGroupMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Kandidat  Group In';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>