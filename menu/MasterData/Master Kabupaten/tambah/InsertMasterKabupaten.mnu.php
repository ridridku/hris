<?php

class InsertMasterKabupatenMenu extends MenuInterface
{
	public $IdKabupaten = NULL;
	
	public function InsertMasterKabupatenMenu(){
		MenuInterface::MenuInterface();
#			$this->AddTail(new MasterPropinsiMenu());

	}
	public function Name(){return 'Tambah Data Kabupaten';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>