<?php
class UpdateSurveyPosisiJembatanMenu extends MenuInterface{
	public $IDJembatan = NULL;
	public $IDRuas = NULL;
	public $WaktuSurvey = NULL;
	public $Post = NULL;
	public $Offset = NULL;
	public $UnixTimeSurvey = NULL;
	
	public function UpdateSurveyPosisiJembatanMenu(){
		MenuInterface::MenuInterface();
	}
	public function OnSetKey($key = array()){
		if(	
  		    $key['id_mst_bridge'] != NULL&&
		   	$key['id__mst_ruas_jalan'] != NULL&&
			$key['timestamp'] != NULL&&
			$key['post'] != NULL&&
			$key['offset'] != NULL
		){
			$this->IDJembatan = $key['id_mst_bridge'];
			$this->IDRuas = $key['id__mst_ruas_jalan'];
			$this->WaktuSurvey = $key['timestamp'];
			$this->Post = $key['post'];
			$this->Offset = $key['offset'];
		}
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}	
	public function Name(){return 'Update Survey Posisi Jembatan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>