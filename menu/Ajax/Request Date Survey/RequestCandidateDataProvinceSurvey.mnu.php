<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateDataProvinceSurveyMenu extends AbstractHandlerMenu
{
	public function RequestCandidateDataProvinceSurveyMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Candidate Data Provinsi Survey';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>