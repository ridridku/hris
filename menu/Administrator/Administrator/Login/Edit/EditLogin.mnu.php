<?php
class EditLoginMenu extends MenuInterface{
	public $NamaUser;
  
	public function EditLoginMenu(){
		MenuInterface::MenuInterface();
	}
	public function Name(){return 'Update Login';}
	public function OnSetKey($key = array()){
		if(
			$key['user_name'] != NULL
		){
			$this->NamaUser = $key['user_name'];
		}
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