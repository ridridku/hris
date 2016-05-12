<?php
class EditHakAksesUser2GridMenu extends MenuInterface
{
  public $IdGroup = NULL;
  public $IdMenu = NULL;
  public $IdMenuClass = NULL;
  
  public function EditHakAksesUser2GridMenu(){
  	MenuInterface::MenuInterface();
  }
  public function Name(){return 'Ubah Role Group';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>