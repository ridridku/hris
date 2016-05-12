<?php
require_once FW_DIR .  '/menu/AbstractHandler.mnu.php';

class RequestDataTransaksiMenu extends AbstractHandlerMenu
{
	public $IdTransaksi = NULL;
	public function RequestDataTransaksiMenu(){
		AbstractHandlerMenu::AbstractHandlerMenu();
		}
	public function Name(){return 'Request Data Transaksi';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function OnSetKey($key = array()){
		if(
			$key['loc_type.id'] != NULL  
		){
			$this->IdTransaksi = $key['loc_type.id'];
		}	
		if($this->Child() != NULL)$this->Child()->OnSetKey($key);
	}
}
?>