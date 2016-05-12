<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteSurveyPerkerasanJalanHandlerMenu extends AbstractHandlerMenu{
	public $IdRuasJalan = NULL;
	public $TimeStamp = NULL;
	public $Post = NULL;
	public $Offset = NULL;
	public $IdLajur = NULL;
	public $IdPerkerasan = NULL;
	public $Next = NULL;
	
	public function DeleteSurveyPerkerasanJalanHandlerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	
	public function Name(){return 'Proses Delete ...' ;}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>