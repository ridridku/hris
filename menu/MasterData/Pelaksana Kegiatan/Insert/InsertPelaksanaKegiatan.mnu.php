<?php

class InsertPelaksanaKegiatanMenu extends MenuInterface
{
	public $IdStatus = '0';
	
	public function InsertPelaksanaKegiatanMenu(){
		MenuInterface::MenuInterface();
			$this->AddTail(new PelaksanaKegiatanMenu());

	}
	public function Name(){return 'Tambah Pelaksana Kegiatan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>