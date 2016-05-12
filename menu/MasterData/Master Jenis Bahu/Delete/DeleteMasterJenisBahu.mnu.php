<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteMasterJenisBahuMenu extends AbstractHandlerMenu{
	public $IDJenisBahu = NULL;
	public $Next = NULL;
	
	public function DeleteMasterJenisBahuMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}	
	public function Name(){return 'Proses Delete Master Jenis Bahu';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>