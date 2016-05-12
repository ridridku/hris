<?
class PetaMenu extends MenuInterface{
	public function PetaMenu(){MenuInterface::MenuInterface();}
	public function Ref(){return NULL;}
	public function Name(){return 'Peta';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>