<?php
class UpdateSurveyPosisiJembatanHandlerContent extends ContentInterface{
	public function UpdateSurveyPosisiJembatanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		
		$Query = $Conn->Execute("
			UPDATE svy_posisi_jembatan SET
				timestamp = '". $Par->WaktuSurvey ."',
				post = '". $_POST['Post'] ."',
				offset = '". $_POST['Offset'] ."',
				
				
				span = NULLIF('".$_POST['span']."',''),
				width= NULLIF('".$_POST['width']."',''),
				free_board = NULLIF('".$_POST['free_board']."',''),
				deck = NULLIF('".$_POST['deck']."','-1'),
				beams = NULLIF('".$_POST['beams']."','-1'),
				side_rails = NULLIF('".$_POST['side_rails']."','-1'),
				abutment = NULLIF('".$_POST['abutment']."','-1'),
				foundation = NULLIF('".$_POST['foundation']."','-1'),
				pavement = NULLIF('".$_POST['pavement']."','-1'),
				keterangan = NULLIF('".$_POST['keterangan']."','')
			WHERE
				id_mst_bridge = '". $Par->IDJembatan ."' AND
				id__mst_ruas_jalan = '". $Par->IDRuas ."' AND
				timestamp = '". $Par->WaktuSurvey ."' AND
				post = '". $Par->Post ."' AND
				offset = '". $Par->Offset ."'
		");
		
		for($i=1; $i<=5; $i++){
		if(!empty($_FILES[('file_upload_' . $i)]['name'])){			
			move_uploaded_file($_FILES['file_upload_'.$i]['tmp_name'], UPLOAD_DIR. 'Jembatan/'.$Par->IDJembatan.'-'.$Par->IDRuas.'-'.$Par->UnixTimeSurvey.'-'.$Par->Post .'-'.$Par->Offset.'-'.$i);
			chmod(UPLOAD_DIR. 'Jembatan/'.$Par->IDJembatan.'-'.$Par->IDRuas.'-'.$Par->UnixTimeSurvey.'-'.$Par->Post .'-'.$Par->Offset.'-'.$i, 0777);
			
			$KeyColumn[0] = 'id_mst_bridge';
			$KeyColumn[1] = 'id__mst_ruas_jalan';
			$KeyColumn[2] = 'timestamp';
			$KeyColumn[3] = 'post';
			$KeyColumn[4] = 'offset';
			$KeyColumn[5] = 'img_id';
			$KeyValue[0] = $Par->IDJembatan;
			$KeyValue[1] = $Par->IDRuas;
			$KeyValue[2] = $Par->WaktuSurvey;
			$KeyValue[3] = $Par->Post;
			$KeyValue[4] = $Par->Offset;
			$KeyValue[5] = $i;
			$OldData = CommonQuery::ReadTable($Conn, 'svy_posisi_jembatan_image', $KeyColumn, $KeyValue);
			if(!$OldData){
				$sql = "
					INSERT INTO svy_posisi_jembatan_image (
						id_mst_bridge,
						id__mst_ruas_jalan,
						timestamp,
						post,
						offset,
						img_id,
						file_type,
						file_size,
						file_name
					) VALUES (
						'". $Par->IDJembatan ."',
						'". $Par->IDRuas ."',
						'". $Par->WaktuSurvey ."',
						'". $Par->Post ."',
						'". $Par->Offset ."',
						'". $i ."',
						'". $_FILES['file_upload_'.$i]['type'] ."',
						'". $_FILES['file_upload_'.$i]['size'] ."',
						'". $_FILES['file_upload_'.$i]['name'] ."'
					)
				";
				$Conn->Execute($sql);
			}
			else{
				$sql = "
					UPDATE svy_posisi_jembatan_image SET
						file_type = NULLIF('". $_FILES['file_upload_'.$i]['type'] ."', ''),
						file_size = NULLIF('". $_FILES['file_upload_'.$i]['size'] ."', ''),
						file_name = NULLIF('". $_FILES['file_upload_'.$i]['name'] ."', '')
					WHERE
						id_mst_bridge = '" . $Par->IDJembatan ."'  AND
						id__mst_ruas_jalan = '". $Par->IDRuas ."' AND
						timestamp = '" . $Par->WaktuSurvey ."'  AND
						post = '" . $Par->Post ."'  AND
						offset = '" . $Par->Offset ."' AND
						img_id = '". $i ."'
				"; 
				$Conn->Execute($sql);
			}
		}
	}
		
	
		$Conn->Execute("COMMIT;");
		/*$Par->Next->OnSetKey(
			array(
				'id_mst_bridge' => $Par->IDJembatan,
				'id__mst_ruas_jalan' => $Par->IDRuas,
				'timestamp' => $TimeStamp,
				'post' => $_POST['Post'],
				'offset' => $_POST['Offset']
			)
		);*/		
		$Par->Next->IDJembatan = $Par->IDJembatan;
		$Par->Next->IDRuas = $Par->IDJembatan;
		$Par->Next->WaktuSurvey = $Par->WaktuSurvey;
		$Par->Next->Post = $Par->Post;
		$Par->Next->OffSet = $Par->OffSet;
		$Par->Next->UnixTimeSurvey = $Par->UnixTimeSurvey;
		
		$Par->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}

?>