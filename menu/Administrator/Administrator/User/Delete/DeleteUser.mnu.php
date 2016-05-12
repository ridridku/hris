<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteUserMenu extends AbstractHandlerMenu
{
	public $Kode = NULL;
	public $Next = NULL;
	
	public function DeleteUserMenu($Kode = NULL){
		AbstractHandlerMenu::AbstractHandlerMenu();
			$this->Kode = $Kode;
	}
	
	public function Name(){return 'Proses Delete Officer List';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>