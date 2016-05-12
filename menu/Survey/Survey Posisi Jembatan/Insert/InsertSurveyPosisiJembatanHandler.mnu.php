<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class InsertSurveyPosisiJembatanHandlerMenu extends AbstractHandlerMenu{
	public $SearchIDRuas = NULL;
	public $TimeStamp = NULL;
	
	public function InsertSurveyPosisiJembatanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();	
	}
	public function Name(){return 'Proses Insert Survey Kodisi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>