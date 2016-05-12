<?
class CommonFilterLaporanMenu extends MenuInterface{
  public $IdPropinsi =  NULL;
  public $IdRuasJalan =  NULL;
  public function CommonFilterLaporanMenu(){MenuInterface::MenuInterface();}  
  public function Name(){return 'Monitoring';}
  public function MakeFrame(){return LeftEmptyDashboardFrame::Instance();}
  public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  public function Path(){return __FILE__;}
  public function ClassName(){return __CLASS__;}
  public function MakeApplication(){return SimpajatanApplication::Instance();}
}  
?>