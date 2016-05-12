<?
class MapVideoSurveyMenu extends MenuInterface{
	public $Rect = array();
	public $FileName = NULL;
	public $MovId = NULL;
  	public function MapVideoSurveyMenu(){MenuInterface::MenuInterface();} 
	public function Name(){return 'Video ' . ($this->MovId + 1) ;}
  	public function MakeFrame(){return BlankTitledFrame::Instance();}
  	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
  	public function Path(){return __FILE__;}
  	public function ClassName(){return __CLASS__;}
  	public function MakeApplication(){return SimpajatanApplication::Instance();}
  	public function OnSetKey($key = array()){
		if(
			$key['svy_drp_ruas_jalan_movie.id_loc_road'] != NULL && 
			$key['svy_drp_ruas_jalan_movie.svy_time_stamp'] != NULL && 
			$key['svy_drp_ruas_jalan_movie.post'] != NULL && 
			$key['svy_drp_ruas_jalan_movie.mov_id'] != NULL && 
			$key['svy_drp_ruas_jalan_movie.offset'] != NULL  
		){
			$this->FileName =  
				UPLOAD_DIR . 'movie/' . 
				$key['svy_drp_ruas_jalan_movie.id_loc_road'] .'-'. 
				$key['svy_drp_ruas_jalan_movie.svy_time_stamp'] .'-'. 
				$key['svy_drp_ruas_jalan_movie.post'] .'-'. 
				$key['svy_drp_ruas_jalan_movie.offset'] .'-' . 
				$key['svy_drp_ruas_jalan_movie.mov_id'];
			$this->MovId = $key['svy_drp_ruas_jalan_movie.mov_id'];
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