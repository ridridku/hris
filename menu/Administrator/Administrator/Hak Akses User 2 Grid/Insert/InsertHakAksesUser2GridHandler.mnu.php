<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class InsertHakAksesUser2GridHandlerMenu extends AbstractHandlerMenu
{
  public $Next = NULL;

  public function InsertHakAksesUser2GridHandlerMenu(){
  	AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function Name(){return 'Proses Tambah Grid Group';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
  public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>