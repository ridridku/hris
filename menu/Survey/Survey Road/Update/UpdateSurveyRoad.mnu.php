<?php
class UpdateSurveyRoadMenu extends MenuInterface
{
  public $IdLocRoad = NULL;
  public $TimeStamp = NULL;
    
  public function UpdateSurveyRoadMenu(){
  	MenuInterface::MenuInterface();
  }
  public function OnSetKey($key = array()){
		if(	$key['id'] != NULL){
			$this->IdLocRoad = $key['id'];
			$this->TimeStamp = $key['time_stamp'];
		}
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}	
  public function Name(){return 'Update Survey Road';}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>