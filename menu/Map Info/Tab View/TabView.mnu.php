<?
class TabViewMenu extends MenuInterface{
	public $Tabs = array();
	public $Rect = array();
	
  	public function TabViewMenu(){MenuInterface::MenuInterface();} 
  	public function Name(){return 'Tab View';}
  	public function MakeFrame(){return BlankTitledFrame::Instance();}
  	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function Path(){return __FILE__;}
  	public function ClassName(){return __CLASS__;}
  	public function MakeApplication(){return SimpajatanApplication::Instance();}
  	public function OnSetKey($key = array()){
		if(
			$key['rect.width'] != NULL && 
			$key['rect.height'] != NULL  
		){
			$this->Rect['height'] =  $key['rect.height'];
			$this->Rect['width'] =  $key['rect.width'];
		}	

		for($i=0; $i<count($this->Tabs); $i++){
			$this->Tabs[$i]->OnSetKey(array(
				'rect.width' => ($key['rect.width']),
				'obj_list.id_object' => $key['obj_list.id_object'], 
				'rect.height' => ($key['rect.height'] - 40)
			));
		}
		if($this->Child() != NULL)	$this->Child()->OnSetKey($key);
	}
}  
?>