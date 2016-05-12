<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateOuterLayerMenu extends AbstractHandlerMenu
{
	public $IdParent = NULL;
	public function RequestCandidateOuterLayerMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
		}
	public function Name(){return 'Request Candidate Province';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>