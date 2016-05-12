<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteConfigMenu extends AbstractHandlerMenu
{
  public $IdGroup = NULL;
  public $IsActive = NULL;
  public $IdMenu = NULL;
  public $Next = NULL;
  public function DeleteConfigMenu($IdGroup = NULL,$IsActive = NULL, $IdMenu = NULL){
	AbstractHandlerMenu::AbstractHandlerMenu();
	$this->IdGroup = $IdGroup;
	$this->IsActive = $IsActive;
	$this->IdMenu = $IdMenu;
  }
  public function Name(){return 'Proses Hapus Configuration';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>