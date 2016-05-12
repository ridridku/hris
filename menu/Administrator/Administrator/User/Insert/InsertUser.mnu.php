<?php

class InsertUserMenu extends MenuInterface
{
	public $IdStatus = '0';
	
	public function InsertUserMenu(){
		MenuInterface::MenuInterface();
			$this->AddTail(new GridUserMenu());

	}
	public function Name(){return 'Tambah Operator';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>