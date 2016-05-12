<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateKilometerRoadPointSurveyFormatWktMenu extends AbstractHandlerMenu
{
	public $IdPropinsi = NULL;
	public $IdRuasJalan = NULL;
	public function RequestCandidateKilometerRoadPointSurveyFormatWktMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Candidate Kilometer Ruas Jalan';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>