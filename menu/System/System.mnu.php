<?php
class SystemMenu extends MenuInterface{
	public function SystemMenu(){
		MenuInterface::MenuInterface();
	}  
	public function Name(){return 'System';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
}  
?>