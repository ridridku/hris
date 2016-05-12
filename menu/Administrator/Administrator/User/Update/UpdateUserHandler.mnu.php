<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateUserHandlerMenu extends AbstractHandlerMenu
{
	public $Kode = NULL;
	public $IdStatus = NULL;
	public $Next = NULL;
	
	public function UpdateUserHandlerMenu($Kode = NULL, $IdStatus = NULL){
		AbstractHandlerMenu::AbstractHandlerMenu();
			$this->Kode = $Kode;
			$this->IdStatus = $IdStatus;
	}
	public function Name(){return 'Proses Update Officer List';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>