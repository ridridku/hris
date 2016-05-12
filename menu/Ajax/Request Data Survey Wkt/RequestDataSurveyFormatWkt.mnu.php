<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestDataSurveyFormatWktMenu extends AbstractHandlerMenu
{
	public $IdRuasJalan = NULL;
	public $IdPropinsi = NULL;
	public function RequestDataSurveyFormatWktMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Data Survey Format WKT';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>