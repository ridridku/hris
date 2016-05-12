<?
class InsertLoginMenu extends MenuInterface
{

  public function InsertLoginMenu(){
	MenuInterface::MenuInterface();
  }
  public function Name(){return 'Insert Login';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>