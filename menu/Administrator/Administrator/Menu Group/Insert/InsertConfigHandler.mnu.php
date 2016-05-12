<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class InsertConfigHandlerMenu extends AbstractHandlerMenu
{
  public $Next = NULL;
  public function InsertConfigHandlerMenu(){
	AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function Name(){return 'Insert Configuration Handler';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
  public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>