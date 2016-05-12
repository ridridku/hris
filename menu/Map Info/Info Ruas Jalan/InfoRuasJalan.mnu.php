<?
class InfoRuasJalanMenu extends MenuInterface{
	public $Rect = array();
	public $IdObject = NULL;
	
  	public function InfoRuasJalanMenu(){MenuInterface::MenuInterface();} 
  	public function Name(){return 'Informasi';}
  	public function MakeFrame(){return BlankTitledFrame::Instance();}
  	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function Path(){return __FILE__;}
  	public function ClassName(){return __CLASS__;}
  	public function MakeApplication(){return SimpajatanApplication::Instance();}
  	public function OnSetKey($key = array()){
		if(
			$key['rect.width'] != NULL && 
			$key['obj_list.id_object'] != NULL && 
			$key['rect.height'] != NULL  
		){
			$this->Rect['height'] =  $key['rect.height'];
			$this->Rect['width'] =  $key['rect.width'];
			$this->IdObject =  $key['obj_list.id_object'];
		}	
		if($this->Child() != NULL)	$this->Child()->OnSetKey($key);
	}
}  
?>