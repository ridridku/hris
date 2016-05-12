<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateBridgeDateSurveyMenu extends AbstractHandlerMenu
{
	public $IdPoint = NULL;
	public $IdRuas = NULL;
	public function RequestCandidateBridgeDateSurveyMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Candidate Jembatan Date Survey';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>