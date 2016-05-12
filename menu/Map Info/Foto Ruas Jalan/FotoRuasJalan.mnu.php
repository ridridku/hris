<?
class FotoRuasJalanMenu extends MenuInterface{
	public $Rect = array();
	public $FileName = NULL;
	public $ImgId = NULL;
  	public function FotoRuasJalanMenu(){MenuInterface::MenuInterface();} 
  	public function Name(){return 'Foto ' . $this->ImgId;}
  	public function MakeFrame(){return BlankTitledFrame::Instance();}
  	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function Path(){return __FILE__;}
  	public function ClassName(){return __CLASS__;}
  	public function MakeApplication(){return SimpajatanApplication::Instance();}
  	public function OnSetKey($key = array()){
		if(
			$key['svy_drp_image.id_loc_road'] != NULL && 
			$key['svy_drp_image.svy_time_stamp'] != NULL && 
			$key['svy_drp_image.post'] != NULL && 
			$key['svy_drp_image.img_id'] != NULL && 
			$key['svy_drp_image.offset'] != NULL  
		){
			$this->FileName =  
				UPLOAD_DIR . 
				$key['svy_drp_image.id_loc_road'] .'-'. 
				$key['svy_drp_image.svy_time_stamp'] .'-'. 
				$key['svy_drp_image.post'] .'-'. 
				$key['svy_drp_image.offset'] .'-' . 
				$key['svy_drp_image.img_id'];
			$this->ImgId = $key['svy_drp_image.img_id'];
		}	
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