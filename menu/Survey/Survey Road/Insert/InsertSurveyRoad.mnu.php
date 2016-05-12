<?php

class InsertSurveyRoadMenu extends MenuInterface
{	public $Kode = NULL;
	public function InsertSurveyRoadMenu(){
		MenuInterface::MenuInterface();
	}
	public function IdPencarianSearched(){return $this->Kode;}			
	public function Name(){return 'Insert Survey Road';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>