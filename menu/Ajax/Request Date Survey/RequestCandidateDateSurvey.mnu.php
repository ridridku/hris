<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateDateSurveyMenu extends AbstractHandlerMenu
{
	public $IdParent = NULL;
	public function RequestCandidateDateSurveyMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Candidate Date Survey';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>