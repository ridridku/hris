<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestStatusLocationMenu extends AbstractHandlerMenu
{
	public $IdLocType = NULL;
	public $ParamToCek = array();
	public function RequestStatusLocationMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
	}
	public function Name(){return 'Request Status Location';}
	public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function OnSetKey($key = array()){
		if(
			$key['id_loc_type'] != NULL && 
			$key['param_to_cek'] != NULL  
		){
			$this->IdLocType = $key['id_loc_type'];
			$this->ParamToCek = $key['param_to_cek'];
		}	
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}
}
?>