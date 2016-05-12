<?
require_once 'Zend/Json/Encoder.php';
/**
 * @package Content
 */
class RequestCandidateDetailPointSurveyContent extends ContentInterface
{
  public function RequestCandidateDetailPointSurveyContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT * 
		FROM svy_drp_ruas_jalan
		WHERE
			id__mst_ruas_jalan = '".$p->IdPoint."' AND
			time_stamp = '". $p->Date ."'
	");
	$a = 0;
	while($rec = $db->FetchObject($rsl)){
		$DataPoint[$a]->gps_lat = $rec->gps_lat;
		$DataPoint[$a]->gps_lon = $rec->gps_lon;
		$DataPoint[$a]->gps_alt = $rec->gps_alt;
		$DataPoint[$a]->gps_elev = $rec->gps_elev;
		$DataPoint[$a]->description = 'Keterangan';

		$m = new TabViewMenu();
		$rslFoto = $db->Execute("
			SELECT *
			FROM svy_drp_ruas_jalan_image 
			WHERE 
				id__mst_ruas_jalan = '". $rec->id__mst_ruas_jalan ."' AND 
				time_stamp = '". $rec->time_stamp ."' AND 
				post = '". $rec->post ."' AND 
				offset = '". $rec->offset ."';
		");
		$rslMovie = $db->Execute("
			SELECT * 
			FROM svy_drp_ruas_jalan_movie 
			WHERE 
				id__mst_ruas_jalan = '". $rec->id__mst_ruas_jalan ."' AND 
				time_stamp = '". $rec->time_stamp ."' AND 
				post = '". $rec->post ."' AND 
				offset = '". $rec->offset ."';
		");
		$info = new InfoMenu();
		$info->IdRoad = $p->IdPoint;
		$info->OnSetKey(array(
			'svy_drp.id_loc_road' => $rec->id__mst_ruas_jalan,
			'svy_drp.svy_time_stamp' => $rec->time_stamp,
			'svy_drp.post' => $rec->post,
			'svy_drp.offset' => $rec->offset 
		));
		$m->Tabs[] = $info;
		while($recFoto = $db->FetchObject($rslFoto)){
			$foto = new FotoRuasJalanMenu();
			if(!is_null($recFoto->time_stamp)){
				$FotoTimeStamp = $recFoto->time_stamp;
				$FotoTimeStampTemp = explode(' ', $FotoTimeStamp);
				$FotoTimeFormat1 = explode('-', $FotoTimeStampTemp[0]);
				$FotoTimeFormat2 = explode(':', $FotoTimeStampTemp[1]);
				$FotoTimeFormatResult = $FotoTimeFormat1[0].$FotoTimeFormat1[1].$FotoTimeFormat1[2].$FotoTimeFormat2[0].$FotoTimeFormat2[1].$FotoTimeFormat2[2];
			}
			$foto->OnSetKey(array(
				'svy_drp_image.id_loc_road' => $recFoto->id__mst_ruas_jalan,
				'svy_drp_image.svy_time_stamp' => $FotoTimeFormatResult,
				'svy_drp_image.post' => $recFoto->post,
				'svy_drp_image.img_id' => $recFoto->img_id,
				'svy_drp_image.offset' => $recFoto->offset 
			));
			$m->Tabs[] = $foto;
		}
		while($recMovie = $db->FetchObject($rslMovie)){
			$movie = new MapVideoSurveyMenu();
			if(!is_null($recMovie->time_stamp)){
				$MovieTimeStamp = $recMovie->time_stamp;
				$MovieTimeStampTemp = explode(' ', $MovieTimeStamp);
				$MovieTimeFormat1 = explode('-', $MovieTimeStampTemp[0]);
				$MovieTimeFormat2 = explode(':', $MovieTimeStampTemp[1]);
				$MovieTimeFormatResult = $MovieTimeFormat1[0].$MovieTimeFormat1[1].$MovieTimeFormat1[2].$MovieTimeFormat2[0].$MovieTimeFormat2[1].$MovieTimeFormat2[2];
			}
			$movie->OnSetKey(array(
				'svy_drp_ruas_jalan_movie.id_loc_road' => $recMovie->id__mst_ruas_jalan,
				'svy_drp_ruas_jalan_movie.svy_time_stamp' => $MovieTimeFormatResult,
				'svy_drp_ruas_jalan_movie.post' => $recMovie->post,
				'svy_drp_ruas_jalan_movie.mov_id' => $recMovie->mov_id,
				'svy_drp_ruas_jalan_movie.offset' => $recMovie->offset 
			));
			$m->Tabs[] = $movie;
		}
		$m->OnSetKey(array(
			'rect.width' => 370,
			'rect.height' => 272
		));
		$DataPoint[$a]->popupRef = $m->Ref();
		$a++;
	}	
	echo Zend_Json_Encoder::encode($DataPoint);
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>