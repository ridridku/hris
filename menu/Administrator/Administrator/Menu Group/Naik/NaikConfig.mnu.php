<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class NaikConfigMenu extends AbstractHandlerMenu
{
  public $IdGroup = NULL;
  public $IsActive = NULL;
  public $IdMenu = NULL;
  public $Next = NULL;
  public function NaikConfigMenu($IdGroup = NULL,$IS_Active = NULL, $IdMenu = NULL){
	AbstractHandlerMenu::AbstractHandlerMenu();
	$this->IdGroup = $IdGroup;
	$this->IsActive = $IsActive;
	$this->IdMenu = $IdMenu;
  }
  public function Name(){return 'Proses Naik Configuration';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>