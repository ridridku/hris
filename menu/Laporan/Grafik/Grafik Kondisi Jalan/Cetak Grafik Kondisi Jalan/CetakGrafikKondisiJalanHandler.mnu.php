<?php 
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class CetakGrafikKondisiJalanHandlerMenu extends AbstractHandlerMenu{
	public $IdPropinsi = NULL;
	public $IdRuasJalan = NULL;
	public $Waktu = NULL;
	public function CetakGrafikKondisiJalanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Grafik Handler';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}

?>