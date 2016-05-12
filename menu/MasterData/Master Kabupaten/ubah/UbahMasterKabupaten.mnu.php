<?php
class UbahMasterKabupatenMenu extends MenuInterface{
	public $IdKabupaten = NULL;
    
	public function UbahMasterKabupatenMenu(){
		MenuInterface::MenuInterface();
	}
	public function OnSetKey($key = array()){
		if(	
		   	$key['id'] != NULL 
		){
			$this->IdKabupaten = $key['id'];
		}
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}	
	public function Name(){return 'Ubah Data Kabupaten';}
	public function Path(){return __FILE__;}
	public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
}
?>