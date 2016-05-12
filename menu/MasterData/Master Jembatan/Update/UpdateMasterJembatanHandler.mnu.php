<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateMasterJembatanHandlerMenu extends AbstractHandlerMenu{
	public $Kode = NULL;
	public $IDJembatan = NULL;
	public $Next = NULL;
	
	public function UpdateMasterJembatanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Proses Edit Master Jembatan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>