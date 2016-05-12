<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteCityHandlerMenu extends AbstractHandlerMenu
{
	public $IdCity = NULL;
	public $Next = NULL;
	
	public function DeleteCityHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	
	public function Name(){return 'Proses Delete Location City' ;}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>