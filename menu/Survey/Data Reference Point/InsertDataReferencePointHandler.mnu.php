<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class InsertDataReferencePointHandlerMenu extends AbstractHandlerMenu
{
  public $Next = NULL;
  public $IdLocRoad = NULL;
  public $TimeStamp = NULL;
  public function InsertDataReferencePointHandlerMenu(){
  	AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function IdLocRoadSearched(){return $this->IdLocRoad;}
  public function Name(){return 'Insert Data Reference Point Process';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
  public function HasValidator(){return TRUE;}
  public function MakeApplication(){return SimpajatanApplication::Instance();}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>