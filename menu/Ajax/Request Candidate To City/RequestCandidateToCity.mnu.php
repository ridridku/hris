<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateToCityMenu extends AbstractHandlerMenu
{
	public $IdState = NULL;
	public function RequestCandidateToCityMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
		}
	public function Name(){return 'Request Kandidat Kota';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>