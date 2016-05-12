<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestLoc1Menu extends AbstractHandlerMenu
{
	public function RequestLoc1Menu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
		}
	public function Name(){return 'Request Loc 1';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>