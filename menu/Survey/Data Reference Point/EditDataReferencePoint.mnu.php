<?
class EditDataReferencePointMenu extends MenuInterface
{
  public $IdRoad = NULL;
  public $TimeSurvey = NULL;
  public $Post = NULL;
  public $Offset = NULL;
  public $UnixTimeSurvey = NULL;
  public function EditDataReferencePointMenu(){
  	MenuInterface::MenuInterface();
  }
  public function Name(){return 'Edit Data Reference Point';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
  public function MakeApplication(){return SimpajatanApplication::Instance();}
  public function MakeFrame(){return SimpajatanFrame::Instance();}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>