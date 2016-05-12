<?php
class UpdateSurveyPerkerasanJalanMenu extends MenuInterface{
	public $IdRuasJalan = NULL;
	public $TimeStamp = NULL;
	public $Post = NULL;
	public $Offset = NULL;
	public $IdLajur = NULL;
	public $IdPerkerasan = NULL;
	public $Next = NULL;	
	
	public function UpdateSurveyPerkerasanJalanMenu(){
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
			$this->IdRuasJalan = $key['id__mst_ruas_jalan'];
			$this->TimeStamp = $key['timestamp'];
			$this->Post = $key['post'];
			$this->Offset = $key['offset'];
			$this->IdLajur = $key['id__mst_lajur'];
			$this->IdPerkerasan = $key['id__mst_perkerasan'];
		}
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}
	public function Name(){return 'Edit Survey Perkerasan Jalan';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>