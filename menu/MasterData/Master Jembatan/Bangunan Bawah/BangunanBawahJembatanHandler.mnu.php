<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class BangunanBawahJembatanHandlerMenu extends AbstractHandlerMenu{
	public $IdJembatan = NULL;
	
	public function BangunanBawahJembatanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Proses Handler Jembatan Bangunan Bawah';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>