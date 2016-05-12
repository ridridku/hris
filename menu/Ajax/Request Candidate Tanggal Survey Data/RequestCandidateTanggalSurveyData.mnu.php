<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestCandidateTanggalSurveyDataMenu extends AbstractHandlerMenu
{
	public $IdJalan = NULL;
  public function RequestCandidateTanggalSurveyDataMenu(){
	AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function Name(){return 'Request Kandidat ';}
  public function Path(){return __FILE__;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>