<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class InsertSurveyKondisiTepiJalanHandlerMenu extends AbstractHandlerMenu{
	public $SearchIDRuas = NULL;
	public $SearchTimeStamp = NULL;
	
	public function InsertSurveyKondisiTepiJalanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();			
	}
	public function Name(){return 'Proses Tambah Survey Kondisi Tepi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>