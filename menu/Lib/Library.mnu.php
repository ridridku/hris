<?php
class LibraryMenu extends MenuInterface{
	public function LibraryMenu(){
		MenuInterface::MenuInterface();
	}  
	public function Name(){return 'Library';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
}  
?>