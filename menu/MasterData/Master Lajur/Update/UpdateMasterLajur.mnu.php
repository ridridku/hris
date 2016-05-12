<?php
class UpdateMasterLajurMenu extends MenuInterface{
  	public $IDLajur = NULL;
	
	public function UpdateMasterLajurMenu(){MenuInterface::MenuInterface();}
	public function Name(){return 'Edit Master Lajur Jalan';}
	public function OnSetKey($key = array()){
		if($key['id'] != NULL)$this->IDLajur = $key['id'];
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>