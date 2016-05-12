<?php

class InsertSurveyDeskripsiRuasJalanMenu extends MenuInterface
{	public $IdLocRoad = NULL;
	public $TimeStamp = NULL;
	public function InsertSurveyDeskripsiRuasJalanMenu(){
		MenuInterface::MenuInterface();
	}
	public function IdPencarianSearched(){return $this->IdLocRoad;}		
	public function Name(){return 'Insert Survey Deskripsi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>