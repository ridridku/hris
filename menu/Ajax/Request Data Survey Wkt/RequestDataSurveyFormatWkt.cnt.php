<?
require_once 'Zend/Json/Encoder.php';
/**
 * @package Content
 */
class RequestDataSurveyFormatWktContent extends ContentInterface
{
  public function RequestDataSurveyFormatWktContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$d->Id = get_class($p);
	$db->Execute("SET group_concat_max_len = 102400");
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	
	$m = new TabViewMenu();
	//image
	$SurveyQuery = $db->Execute("
		SELECT
			*
		FROM
			`svy_ruas_jalan`
		WHERE
			`svy_ruas_jalan`.id__mst_ruas_jalan = '". $p->IdRuasJalan ."'
	");
	$SurveyNbRow = $db->RowCount($SurveyQuery);
	for($i; $i<$SurveyNbRow; $i++){
		$SurveyField = $db->FetchObject($SurveyQuery);
		$PointQuery = $db->Execute("
			SELECT * 
			FROM svy_drp_ruas_jalan
			WHERE
				id__mst_ruas_jalan = '". $p->IdRuasJalan ."' AND
				time_stamp = '". $SurveyField->time_stamp ."'
		");
		$a = 0;
		while($PointResult = $db->FetchObject($PointQuery)){
			/*
			$DataPoint[$a]->gps_lat = $PointResult->gps_lat;
			$DataPoint[$a]->gps_lon = $PointResult->gps_lon;
			$DataPoint[$a]->gps_alt = $PointResult->gps_alt;
			$DataPoint[$a]->gps_elev = $PointResult->gps_elev;
			$DataPoint[$a]->description = 'Keterangan';
			*/
			/*
			$rslFoto = $db->Execute("
				SELECT *
				FROM svy_drp_ruas_jalan_image 
				WHERE 
					id__mst_ruas_jalan = '". $PointResult->id__mst_ruas_jalan ."' AND 
					time_stamp = '". $PointResult->time_stamp ."' AND 
					post = '". $PointResult->post ."' AND 
					offset = '". $PointResult->offset ."';
			");
			$rslMovie = $db->Execute("
				SELECT * 
				FROM svy_drp_ruas_jalan_movie 
				WHERE 
					id__mst_ruas_jalan = '". $PointResult->id__mst_ruas_jalan ."' AND 
					time_stamp = '". $PointResult->time_stamp ."' AND 
					post = '". $PointResult->post ."' AND 
					offset = '". $PointResult->offset ."';
			");
			$info = new InfoMenu();
			$info->IdRoad = $p->IdRuasJalan;
			$info->OnSetKey(array(
				'svy_drp.id_loc_road' => $PointResult->id__mst_ruas_jalan,
				'svy_drp.svy_time_stamp' => $PointResult->time_stamp,
				'svy_drp.post' => $PointResult->post,
				'svy_drp.offset' => $PointResult->offset 
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
				$movie = new VideoSurveyMenu();
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
			*/
			$rsl = $db->Execute("
				SELECT CONCAT(`svy_drp_ruas_jalan`.gps_lon, ' ', `svy_drp_ruas_jalan`.gps_lat) AS wkt
				FROM
					`svy_drp_ruas_jalan`
				WHERE
					`svy_drp_ruas_jalan`.id__mst_ruas_jalan = '". $p->IdRuasJalan ."' AND
					`svy_drp_ruas_jalan`.time_stamp = '". $SurveyField->time_stamp ."'
			");
			$b = 0;
			while($rec = $db->FetchObject($rsl)){
				$DataWkt[$a + $b]->wkt = 'POINT('. $rec->wkt .')';
				$DataWkt[$a + $b]->popupRef = /*$m->Ref();*/ NULL;
				$DataWkt[$a + $b]->color = 'blue';
				$b++;
			}
			$a++;
		}
		
	}
	
	echo Zend_Json_Encoder::encode($DataWkt);
	$db->Execute("COMMIT;");
  }
  public function Path(){return __FILE__;}
}
?>