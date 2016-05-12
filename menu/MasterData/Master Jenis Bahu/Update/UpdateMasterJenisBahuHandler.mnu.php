<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateMasterJenisBahuHandlerMenu extends AbstractHandlerMenu{
	public $IDJenisBahu = NULL;
	public $Next = NULL;
	
	public function UpdateMasterJenisBahuHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Proses Edit Master Jenis Bahu';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>