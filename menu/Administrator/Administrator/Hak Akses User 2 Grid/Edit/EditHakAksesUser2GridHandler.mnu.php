<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class EditHakAksesUser2GridHandlerMenu extends AbstractHandlerMenu
{
  
  public $IdGroup = NULL;
  public $IdMenu= NULL;
  public $IdMenuClass = NULL;
  public $Next = NULL;
  public function EditHakAksesUser2GridHandlerMenu(){
  	AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function Name(){return 'Proses Ubah Hak Akses Kolom';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
  public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>