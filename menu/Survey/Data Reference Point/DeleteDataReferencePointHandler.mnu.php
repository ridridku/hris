<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class DeleteDataReferencePointHandlerMenu extends AbstractHandlerMenu
{
  public $Next = NULL;
  public $IdRoad = NULL;
  public $TimeSurvey = NULL;
  public $Post = NULL;
  public $Offset = NULL;
  public $UnixTimeSurvey = NULL;
  public function DeleteDataReferencePointHandlerMenu(){
  	AbstractHandlerMenu::AbstractHandlerMenu();
  }
  public function Name(){return 'Delete Data Reference Point Process';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
  public function HasValidator(){return TRUE;}
  public function MakeApplication(){return SimpajatanApplication::Instance();}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>