<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateJenisBahuMenu extends AbstractHandlerMenu
{
	public $IdGroupBahu = NULL;
  public function RequestCandidateJenisBahuMenu(){
	AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function Name(){return 'Request Kandidat ';}
  public function Path(){return __FILE__;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>