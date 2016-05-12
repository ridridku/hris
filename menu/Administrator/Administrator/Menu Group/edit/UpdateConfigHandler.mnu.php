<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class UpdateConfigHandlerMenu extends AbstractHandlerMenu
{
  public $IdGroup = NULL;
  public $IdMenu = NULL;
  public $Next = NULL;
  public function UpdateConfigHandlerMenu($IdGroup = NULL, $IdMenu = NULL){
	$this->IdGroup =$IdGroup;
	$this->IdMenu = $IdMenu;
	AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function Name(){return 'Update Configuration Handler';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
  public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>