<? 
require_once 'Zend/Json/Encoder.php';

class LaporanVideoSurveyContent extends ContentInterface{
  public function VideoSurveyContent(){ContentInterface::ContentInterface();}
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
  	$db = $this->Parent()->MakeDatabase();
/*	
	$Movie = new DownloadToViewMovieHandlerMenu();
	$Movie->IdRuasJalan = $p->IdRuasJalan; 
	$photo->Time = $p->Time;
	$Movie->UnixTime = $p->UnixTime;
	$Movie->Post = $p->Post;
	$Movie->OffSet = $p->OffSet;
	$Movie->IdMovie = $p->IdMovie;
	ContentInterface::Assign('video', $Movie->Ref());
*/	

	
	$Query = "
	  SELECT
	  	file_type,
		file_size,
		file_name
	  FROM svy_drp_ruas_jalan_movie
	  WHERE 
		 id__mst_ruas_jalan = '". $p->IdRuasJalan ."' AND
		 time_stamp = '".$p->Time."' AND
		 post = '".$p->Post."' AND
		 offset = '".$p->OffSet."' AND
		 mov_id =  '".$p->IdMovie."'
	";
	$rsl = $db->Execute($Query);
	$OldData = $db->FetchArray($rsl);
	if($OldData['file_name'] != NULL){
	$filename = UPLOAD_DIR . 'movie/' .$p->IdRuasJalan.'-'. $p->UnixTime.'-'. $p->Post.'-'. $p->OffSet.'-'.$p->IdMovie.'.flv';
  	ContentInterface::Assign('video', $filename);
	}
	
	
	$m = new GridDataSurveyVideoJalanMenu();
	$m->IdPropinsi = $p->IdPropinsi;
	$m->IdRuasJalan = $p->IdRuasJalan;
	$m->Time = $p->Time;
	$m->Post = $p->Post;
	$m->OffSet = $p->OffSet;
	
	ContentInterface::Assign('Selesai', $m->Ref());
	
  	ContentInterface::Assign('YuiRelatifPath', YUI_RELATIF_PATH);
  	ContentInterface::Assign('width', 500);
  	ContentInterface::Assign('height', 500);
	ContentInterface::Show($v);
	ContentInterface::Display();
  }
  public function Path(){return __FILE__;}
}
?>
