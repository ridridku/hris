<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateSurveyKondisiTepiJalanHandlerMenu extends AbstractHandlerMenu{  
	public $IDRuas = NULL;
	public $TimeStamp = NULL;
	public $Post = NULL;
	public $Offset = NULL;
	public $IDLajur = NULL;
	public $UnixTimeSurvey = NULL;	
	public $Next = NULL;
	
	public function UpdateSurveyKondisiTepiJalanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Proses Edit Survey Kondisi Tepi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>