<?php

class InsertSurveyKondisiJalanMenu extends MenuInterface
{	public $IdLocRoad = NULL;
	public function InsertSurveyKondisiJalanMenu(){
		MenuInterface::MenuInterface();
	}
	public function IdPencarianSearched(){return $this->IdLocRoad;}			
	public function Name(){return 'Insert Survey Kondisi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>