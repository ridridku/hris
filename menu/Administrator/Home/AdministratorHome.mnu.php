<?php
class AdministratorHomeMenu extends MenuInterface{
	public function AdministratorHomeMenu(){
		MenuInterface::MenuInterface();
	}  
	public function Name(){return 'Home';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
}  
?>