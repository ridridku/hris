<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class TurunConfigMenu extends AbstractHandlerMenu
{
  public $IdGroup = NULL;
  public $ParentId = NULL;
  public $IdMenu = NULL;
  public $Next = NULL;
  public function TurunConfigMenu(
  	$IdGroup = NULL,
	$ParentId = NULL, 
	$IdMenu = NULL
  ){
	AbstractHandlerMenu::AbstractHandlerMenu();
	$this->IdGroup = $IdGroup;
	$this->ParentId = $ParentId;
	$this->IdMenu = $IdMenu;

	
  }
  public function Name(){return 'Proses Turun Configuration';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>