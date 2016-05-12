<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateDataPointSurveyMenu extends AbstractHandlerMenu
{
	public $IdPropinsi = NULL;
	public function RequestCandidateDataPointSurveyMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Candidate Data Point Survey';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>