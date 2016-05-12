<?
class PetaIndoMenu extends MenuInterface{
	public function PetaIndoMenu(){MenuInterface::MenuInterface();}
	public function Name(){return 'Peta Wilayah';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeFrame(){return LeftEmptyDashboardFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>