<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateBridgePointSurveyMenu extends AbstractHandlerMenu
{
	public $IdPoint = NULL;
	public function RequestCandidateBridgePointSurveyMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Candidate Jembatan Data Point Survey';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>