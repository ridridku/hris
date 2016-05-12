<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestOuterSymbologyMenu extends AbstractHandlerMenu
{
	public $IdOuterLayer = NULL;
	public function RequestOuterSymbologyMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Outer Symbology';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>