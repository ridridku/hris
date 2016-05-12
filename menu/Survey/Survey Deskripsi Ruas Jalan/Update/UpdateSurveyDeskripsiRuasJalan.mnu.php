<?php
class UpdateSurveyDeskripsiRuasJalanMenu extends MenuInterface{
	public $IDRuas = NULL;
	public $WaktuSurvey = NULL;
	public $Post = NULL;
	public $Offset = NULL;
	public $IdLajur = NULL;
	
    
	public function UpdateSurveyDeskripsiRuasJalanMenu(){
		MenuInterface::MenuInterface();
	}
	public function OnSetKey($key = array()){
		if(	
		   	$key['id__mst_ruas_jalan'] != NULL &&
			$key['timestamp'] != NULL &&
			$key['post'] != NULL &&
			$key['offset'] != NULL &&
			$key['id__mst_lajur'] != NULL
		){
			$this->IDRuas = $key['id__mst_ruas_jalan'];
			$this->WaktuSurvey = $key['timestamp'];
			$this->Post = $key['post'];
			$this->Offset = $key['offset'];
			$this->IdLajur = $key['id__mst_lajur'];
		}
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}	
	public function Name(){return 'Update Survey Deskripsi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>