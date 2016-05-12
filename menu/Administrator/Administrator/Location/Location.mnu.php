<?
class LocationMenu extends MenuInterface{
	public function LocationMenu(){MenuInterface::MenuInterface();}
	public function Ref(){return NULL;}
	public function Name(){return 'Master Location';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
}
?>