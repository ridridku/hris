<?
require_once 'Zend/Json/Encoder.php';
/**
 * @package Content
 */
class RequestCandidateBridgeDetailSurveyContent extends ContentInterface
{
  public function RequestCandidateBridgeDetailSurveyContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$d->Id = get_class($p);

	$rsl = $db->Execute("
		SELECT * 
		FROM mst_bridge
		WHERE
			id = '".$p->IdPoint."' AND
			id__mst_ruas_jalan = '".$p->IdRuas."'
	");
	$a = 0;
	while($rec = $db->FetchObject($rsl)){
		$DataPoint[$a]->gps_lat = $rec->start_gps_lat;
		$DataPoint[$a]->gps_lon = $rec->start_gps_lon;
		$DataPoint[$a]->gps_alt = $rec->start_gps_alt;
		$DataPoint[$a]->gps_elev = $rec->start_gps_elev;
		$DataPoint[$a]->description = 'Keterangan';
		
		$m = new TabViewMenu();
		$info = new InfoJembatanMenu();
		$info->IdBridge = $p->IdPoint;
		$m->Tabs[] = $info;
		
		$QueJembatanSurvey = $db->Execute("
			SELECT *
			FROM svy_posisi_jembatan
			WHERE
				id_mst_bridge = '". $rec->id ."' AND
				id__mst_ruas_jalan = '". $rec->id__mst_ruas_jalan ."' AND 
				timestamp = '". $p->Date ."';
		");
		while($QueJembatanField = $db->FetchObject($QueJembatanSurvey)){
			$rslFoto = $db->Execute("
				SELECT *
				FROM svy_posisi_jembatan_image
				WHERE
					id_mst_bridge = '". $rec->id ."' AND
					id__mst_ruas_jalan = '". $rec->id__mst_ruas_jalan ."' AND 
					timestamp = '". $p->Date ."' AND
					post = '". $QueJembatanField->post ."' AND
					offset = '". $QueJembatanField->offset ."';
			");
			while($recFoto = $db->FetchObject($rslFoto)){
				$foto = new FotoJembatanMenu();
				if(!is_null($recFoto->timestamp)){
					$FotoTimeStamp = $recFoto->timestamp;
					$FotoTimeStampTemp = explode(' ', $FotoTimeStamp);
					$FotoTimeFormat1 = explode('-', $FotoTimeStampTemp[0]);
					$FotoTimeFormat2 = explode(':', $FotoTimeStampTemp[1]);
					$FotoTimeFormatResult = $FotoTimeFormat1[0].$FotoTimeFormat1[1].$FotoTimeFormat1[2].$FotoTimeFormat2[0].$FotoTimeFormat2[1].$FotoTimeFormat2[2];
				}
				$foto->OnSetKey(array(
					'svy_drp_image.id_mst_bridge' => $recFoto->id_mst_bridge,
					'svy_drp_image.id_loc_road' => $recFoto->id__mst_ruas_jalan,
					'svy_drp_image.svy_time_stamp' => $FotoTimeFormatResult,
					'svy_drp_image.post' => $recFoto->post,
					'svy_drp_image.img_id' => $recFoto->img_id,
					'svy_drp_image.offset' => $recFoto->offset 
				));
				$m->Tabs[] = $foto;
			}
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