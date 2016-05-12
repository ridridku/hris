<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateBridgeProvinceSurveyMenu extends AbstractHandlerMenu
{
	public function RequestCandidateBridgeProvinceSurveyMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Candidate Jembatan Data Provinsi Survey';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>