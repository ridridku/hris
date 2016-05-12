<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteSurveyKondisiTepiJalanHandlerMenu extends AbstractHandlerMenu{
	public $IDRuas = NULL;
	public $TimeStamp = NULL;
	public $Post = NULL;
	public $Offset = NULL;
	public $IDLajur = NULL;
	public $Next = NULL;
	
	public function DeleteSurveyKondisiTepiJalanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	
	public function Name(){return 'Proses Delete Survey Kondisi Tepi Jalan' ;}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>