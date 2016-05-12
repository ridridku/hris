<?
class InfoMenu extends MenuInterface{
	public $Rect = array();
	public $IdRoad = NULL;
	public function InfoMenu(){MenuInterface::MenuInterface();}
	public function Name(){return 'Info';}
	public function Path(){return __FILE__;}
	public function ClassName(){return __CLASS__;}
	public function MakeFrame(){return BlankTitledFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}
  	public function OnSetKey($key = array()){
		if(
			$key['rect.width'] != NULL && 
			$key['rect.height'] != NULL  
		){
			$this->Rect['height'] =  $key['rect.height'];
			$this->Rect['width'] =  $key['rect.width'];
		}	
		if($this->Child() != NULL)	$this->Child()->OnSetKey($key);
	}
}	
?>