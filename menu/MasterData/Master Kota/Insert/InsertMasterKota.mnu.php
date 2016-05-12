<?php

class InsertMasterKotaMenu extends MenuInterface
{
	public $IdStatus = '0';
	
	public function InsertMasterKotaMenu(){
		MenuInterface::MenuInterface();
			$this->AddTail(new MasterKotaMenu());

	}
	public function Name(){return 'Tambah Master Propinsi';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>