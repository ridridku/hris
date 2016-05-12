<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteLoginMenu extends AbstractHandlerMenu
{
  public $NamaUser = NULL;
  public $Next = NULL;
  public function DeleteLoginMenu($NamaUser = NULL){
	AbstractHandlerMenu::AbstractHandlerMenu();
	$this->NamaUser = $NamaUser;
  }
  public function Name(){return 'Proses Login Delete';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>