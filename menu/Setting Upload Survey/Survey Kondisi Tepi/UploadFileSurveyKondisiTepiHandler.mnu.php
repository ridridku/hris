<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UploadFileSurveyKondisiTepiHandlerMenu extends AbstractHandlerMenu{
	public $Next = NULL;
	
	public function UploadFileSurveyKondisiTepiHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Prosesing Handler';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>