<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateDetailPointSurveyMenu extends AbstractHandlerMenu
{
	public $IdPoint = NULL;
	public $Date = NULL;
	public function RequestCandidateDetailPointSurveyMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Candidate Detail Point Survey';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>