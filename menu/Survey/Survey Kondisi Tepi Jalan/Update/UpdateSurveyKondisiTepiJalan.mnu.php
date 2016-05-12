<?php
class UpdateSurveyKondisiTepiJalanMenu extends MenuInterface{
	public $IDRuas = NULL;
	public $TimeStamp = NULL;
	public $Post = NULL;
	public $Offset = NULL;
	public $IDLajur = NULL;
	public $UnixTimeSurvey = NULL;
	public $Next = NULL;	
	
	public function UpdateSurveyKondisiTepiJalanMenu(){
		MenuInterface::MenuInterface();
	}
	public function OnSetKey($key = array()){
		if(	
			$key['id__mst_ruas_jalan'] != NULL&&
			$key['timestamp'] != NULL&&
			$key['post'] != NULL&&
			$key['offset'] != NULL&&
			$key['id__mst_lajur'] != NULL
		){
			$this->IDRuas = $key['id__mst_ruas_jalan'];
			$this->TimeStamp = $key['timestamp'];
			$this->Post = $key['post'];
			$this->Offset = $key['offset'];
			$this->IDLajur = $key['id__mst_lajur'];
		}
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}	
	public function Name(){return 'Edit Survey Kondisi Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>