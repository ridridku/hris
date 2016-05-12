<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class EditLoginHandlerMenu extends AbstractHandlerMenu
{
  public $Next = NULL;
  public $NamaUser = NULL;
  public $Password = NULL;
  public $Nip = NULL;
  public $IdGroup = NULL;
  public function EditLoginHandlerMenu($NamaUser = NULL, $Password = NULL, $Nip = NULL, $IdGroup = NULL){
  	AbstractHandlerMenu::AbstractHandlerMenu();
	$this->NamaUser = $NamaUser;
	$this->Password = $Password;
	$this->Nip = $Nip;
	$this->IdGroup = $IdGroup;
  }
  public function Name(){return 'Update Login Handler';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
  public function HasValidator(){return TRUE;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>