<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class LaporanDeskripsiRuasJalanHandlerMenu extends AbstractHandlerMenu{
	public $IdPropinsi = NULL;
	public $IdRuasJalan = NULL;
	public function LaporanDeskripsiRuasJalanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Laporan Handler';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}

?>