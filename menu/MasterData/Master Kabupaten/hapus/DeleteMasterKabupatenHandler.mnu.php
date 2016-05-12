<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteMasterKabupatenHandlerMenu extends AbstractHandlerMenu{
	public $IdKabupaten = NULL;
	public $Next = NULL;
	
	public function DeleteMasterKabupatenHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}	
	public function Name(){return 'Proses ' ;}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>