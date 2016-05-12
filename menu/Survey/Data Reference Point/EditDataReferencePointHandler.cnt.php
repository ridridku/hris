<?
require_once FW_DIR .  '/lib/CommonQuery.php';

class EditDataReferencePointHandlerContent extends ContentInterface
{
  public function EditDataReferencePointHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
	$db = $p->MakeDatabase();
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$db->Execute("
		UPDATE `svy_drp_ruas_jalan` SET
			`gps_lat` = NULLIF('". $_POST['gps_lat'] ."', ''),
			`gps_lon` = NULLIF('". $_POST['gps_lon'] ."', ''),
			`gps_alt` = NULLIF('". $_POST['gps_alt'] ."', ''),
			`gps_elev` = NULLIF('". $_POST['gps_elev'] ."', '')
		WHERE
			(`id__mst_ruas_jalan` = '". $p->IdRoad ."') AND
			(`time_stamp` = '". $p->TimeSurvey ."') AND
			(`post` = '". $p->Post ."') AND
			(`offset` = '". $p->Offset ."')
	");
	if(!empty($_FILES['file_upload_1']['name'])){
		move_uploaded_file($_FILES['file_upload_1']['tmp_name'], UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-1');
		chmod(UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-1', 0777);
		$KeyColumn[0] = 'id__mst_ruas_jalan';
		$KeyColumn[1] = 'time_stamp';
		$KeyColumn[2] = 'post';
		$KeyColumn[3] = 'offset';
		$KeyColumn[4] = 'img_id';
		$KeyValue[0] = $p->IdRoad;
		$KeyValue[1] = $p->TimeSurvey;
		$KeyValue[2] = $p->Post;
		$KeyValue[3] = $p->Offset;
		$KeyValue[4] = 1;
		$OldData = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
		if(!$OldData){
			$db->Execute("
				INSERT INTO `svy_drp_ruas_jalan_image` (
					`id__mst_ruas_jalan`,
					`time_stamp`,
					`post`,
					`offset`,
					`img_id`,
					`file_type`,
					`file_size`,
					`file_name`
				) VALUES (
					'". $p->IdRoad ."',
					'". $p->TimeSurvey ."',
					'". $p->Post ."',
					'". $p->Offset ."',
					'". 1 ."',
					'". $_FILES['file_upload_1']['type'] ."',
					'". $_FILES['file_upload_1']['size'] ."',
					'". $_FILES['file_upload_1']['name'] ."'
				)
			");
		}
		else{
			$db->Execute("
				UPDATE `svy_drp_ruas_jalan_image` SET
					`file_type` = NULLIF('". $_FILES['file_upload_1']['type'] ."', ''),
					`file_size` = NULLIF('". $_FILES['file_upload_1']['size'] ."', ''),
					`file_name` = NULLIF('". $_FILES['file_upload_1']['name'] ."', '')
				WHERE
					(`id__mst_ruas_jalan` = '". $p->IdRoad ."') AND
					(`time_stamp` = '". $p->TimeSurvey ."') AND
					(`post` = '". $p->Post ."') AND
					(`offset` = '". $p->Offset ."') AND
					(`img_id` = '". 1 ."')
			");
		}
	}
	
	if(!empty($_FILES['file_upload_2']['name'])){
		move_uploaded_file($_FILES['file_upload_2']['tmp_name'], UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-2');
		chmod(UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-2', 0777);
		$KeyColumn[0] = 'id__mst_ruas_jalan';
		$KeyColumn[1] = 'time_stamp';
		$KeyColumn[2] = 'post';
		$KeyColumn[3] = 'offset';
		$KeyColumn[4] = 'img_id';
		$KeyValue[0] = $p->IdRoad;
		$KeyValue[1] = $p->TimeSurvey;
		$KeyValue[2] = $p->Post;
		$KeyValue[3] = $p->Offset;
		$KeyValue[4] = 2;
		$OldData = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
		if(!$OldData){
			$db->Execute("
				INSERT INTO `svy_drp_ruas_jalan_image` (
					`id__mst_ruas_jalan`,
					`time_stamp`,
					`post`,
					`offset`,
					`img_id`,
					`file_type`,
					`file_size`,
					`file_name`
				) VALUES (
					'". $p->IdRoad ."',
					'". $p->TimeSurvey ."',
					'". $p->Post ."',
					'". $p->Offset ."',
					'". 2 ."',
					'". $_FILES['file_upload_2']['type'] ."',
					'". $_FILES['file_upload_2']['size'] ."',
					'". $_FILES['file_upload_2']['name'] ."'
				)
			");
		}
		else{
			$db->Execute("
				UPDATE `svy_drp_ruas_jalan_image` SET
					`file_type` = NULLIF('". $_FILES['file_upload_2']['type'] ."', ''),
					`file_size` = NULLIF('". $_FILES['file_upload_2']['size'] ."', ''),
					`file_name` = NULLIF('". $_FILES['file_upload_2']['name'] ."', '')
				WHERE
					(`id__mst_ruas_jalan` = '". $p->IdRoad ."') AND
					(`time_stamp` = '". $p->TimeSurvey ."') AND
					(`post` = '". $p->Post ."') AND
					(`offset` = '". $p->Offset ."') AND
					(`img_id` = '". 2 ."')
			");
		}
	}
	
	if(!empty($_FILES['file_upload_3']['name'])){
		move_uploaded_file($_FILES['file_upload_3']['tmp_name'], UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-3');
		chmod(UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-3', 0777);
		$KeyColumn[0] = 'id__mst_ruas_jalan';
		$KeyColumn[1] = 'time_stamp';
		$KeyColumn[2] = 'post';
		$KeyColumn[3] = 'offset';
		$KeyColumn[4] = 'img_id';
		$KeyValue[0] = $p->IdRoad;
		$KeyValue[1] = $p->TimeSurvey;
		$KeyValue[2] = $p->Post;
		$KeyValue[3] = $p->Offset;
		$KeyValue[4] = 3;
		$OldData = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
		if(!$OldData){
			$db->Execute("
				INSERT INTO `svy_drp_ruas_jalan_image` (
					`id__mst_ruas_jalan`,
					`time_stamp`,
					`post`,
					`offset`,
					`img_id`,
					`file_type`,
					`file_size`,
					`file_name`
				) VALUES (
					'". $p->IdRoad ."',
					'". $p->TimeSurvey ."',
					'". $p->Post ."',
					'". $p->Offset ."',
					'". 3 ."',
					'". $_FILES['file_upload_3']['type'] ."',
					'". $_FILES['file_upload_3']['size'] ."',
					'". $_FILES['file_upload_3']['name'] ."'
				)
			");
		}
		else{
			$db->Execute("
				UPDATE `svy_drp_ruas_jalan_image` SET
					`file_type` = NULLIF('". $_FILES['file_upload_3']['type'] ."', ''),
					`file_size` = NULLIF('". $_FILES['file_upload_3']['size'] ."', ''),
					`file_name` = NULLIF('". $_FILES['file_upload_3']['name'] ."', '')
				WHERE
					(`id__mst_ruas_jalan` = '". $p->IdRoad ."') AND
					(`time_stamp` = '". $p->TimeSurvey ."') AND
					(`post` = '". $p->Post ."') AND
					(`offset` = '". $p->Offset ."') AND
					(`img_id` = '". 3 ."')
			");
		}
	}
	
	if(!empty($_FILES['file_upload_4']['name'])){
		move_uploaded_file($_FILES['file_upload_4']['tmp_name'], UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-4');
		chmod(UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-4', 0777);
		$KeyColumn[0] = 'id__mst_ruas_jalan';
		$KeyColumn[1] = 'time_stamp';
		$KeyColumn[2] = 'post';
		$KeyColumn[3] = 'offset';
		$KeyColumn[4] = 'img_id';
		$KeyValue[0] = $p->IdRoad;
		$KeyValue[1] = $p->TimeSurvey;
		$KeyValue[2] = $p->Post;
		$KeyValue[3] = $p->Offset;
		$KeyValue[4] = 4;
		$OldData = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
		if(!$OldData){
			$db->Execute("
				INSERT INTO `svy_drp_ruas_jalan_image` (
					`id__mst_ruas_jalan`,
					`time_stamp`,
					`post`,
					`offset`,
					`img_id`,
					`file_type`,
					`file_size`,
					`file_name`
				) VALUES (
					'". $p->IdRoad ."',
					'". $p->TimeSurvey ."',
					'". $p->Post ."',
					'". $p->Offset ."',
					'". 4 ."',
					'". $_FILES['file_upload_4']['type'] ."',
					'". $_FILES['file_upload_4']['size'] ."',
					'". $_FILES['file_upload_4']['name'] ."'
				)
			");
		}
		else{
			$db->Execute("
				UPDATE `svy_drp_ruas_jalan_image` SET
					`file_type` = NULLIF('". $_FILES['file_upload_4']['type'] ."', ''),
					`file_size` = NULLIF('". $_FILES['file_upload_4']['size'] ."', ''),
					`file_name` = NULLIF('". $_FILES['file_upload_4']['name'] ."', '')
				WHERE
					(`id__mst_ruas_jalan` = '". $p->IdRoad ."') AND
					(`time_stamp` = '". $p->TimeSurvey ."') AND
					(`post` = '". $p->Post ."') AND
					(`offset` = '". $p->Offset ."') AND
					(`img_id` = '". 4 ."')
			");
		}
	}
	
	if(!empty($_FILES['file_upload_5']['name'])){
		move_uploaded_file($_FILES['file_upload_5']['tmp_name'], UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-5');
		chmod(UPLOAD_DIR. $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset .'-5', 0777);
		$KeyColumn[0] = 'id__mst_ruas_jalan';
		$KeyColumn[1] = 'time_stamp';
		$KeyColumn[2] = 'post';
		$KeyColumn[3] = 'offset';
		$KeyColumn[4] = 'img_id';
		$KeyValue[0] = $p->IdRoad;
		$KeyValue[1] = $p->TimeSurvey;
		$KeyValue[2] = $p->Post;
		$KeyValue[3] = $p->Offset;
		$KeyValue[4] = 5;
		$OldData = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_image', $KeyColumn, $KeyValue);
		if(!$OldData){
			$db->Execute("
				INSERT INTO `svy_drp_ruas_jalan_image` (
					`id__mst_ruas_jalan`,
					`time_stamp`,
					`post`,
					`offset`,
					`img_id`,
					`file_type`,
					`file_size`,
					`file_name`
				) VALUES (
					'". $p->IdRoad ."',
					'". $p->TimeSurvey ."',
					'". $p->Post ."',
					'". $p->Offset ."',
					'". 5 ."',
					'". $_FILES['file_upload_5']['type'] ."',
					'". $_FILES['file_upload_5']['size'] ."',
					'". $_FILES['file_upload_5']['name'] ."'
				)
			");
		}
		else{
			$db->Execute("
				UPDATE `svy_drp_ruas_jalan_image` SET
					`file_type` = NULLIF('". $_FILES['file_upload_5']['type'] ."', ''),
					`file_size` = NULLIF('". $_FILES['file_upload_5']['size'] ."', ''),
					`file_name` = NULLIF('". $_FILES['file_upload_5']['name'] ."', '')
				WHERE
					(`id__mst_ruas_jalan` = '". $p->IdRoad ."') AND
					(`time_stamp` = '". $p->TimeSurvey ."') AND
					(`post` = '". $p->Post ."') AND
					(`offset` = '". $p->Offset ."') AND
					(`img_id` = '". 5 ."')
			");
		}
	}


	for($i=0; $i<5; $i++){
		if(!empty($_FILES[('movie_upload_' . $i)]['name'])){
			move_uploaded_file(
				$_FILES[('movie_upload_' . $i)]['tmp_name'], 
				UPLOAD_DIR . 'movie/' . $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset . '-' . $i . '.flv'
			);
			chmod(UPLOAD_DIR . 'movie/' . $p->IdRoad .'-'. $p->UnixTimeSurvey .'-'. $p->Post .'-'. $p->Offset . '-' . $i . '.flv', 0777);
			$KeyColumn[0] = 'id__mst_ruas_jalan';
			$KeyColumn[1] = 'time_stamp';
			$KeyColumn[2] = 'post';
			$KeyColumn[3] = 'offset';
			$KeyColumn[4] = 'mov_id';
			$KeyValue[0] = $p->IdRoad;
			$KeyValue[1] = $p->TimeSurvey;
			$KeyValue[2] = $p->Post;
			$KeyValue[3] = $p->Offset;
			$KeyValue[4] = $i;
			$OldData = CommonQuery::ReadTable($db, 'svy_drp_ruas_jalan_movie', $KeyColumn, $KeyValue);
			if(!$OldData){
				$db->Execute("
					INSERT INTO `svy_drp_ruas_jalan_movie` (
						`id__mst_ruas_jalan`,
						`time_stamp`,
						`post`,
						`offset`,
						`mov_id`,
						`file_type`,
						`file_size`,
						`file_name`
					) VALUES (
						'". $p->IdRoad ."',
						'". $p->TimeSurvey ."',
						'". $p->Post ."',
						'". $p->Offset ."',
						'". $i ."',
						'". $_FILES[('movie_upload_' . $i)]['type'] ."',
						'". $_FILES[('movie_upload_' . $i)]['size'] ."',
						'". $_FILES[('movie_upload_' . $i)]['name'] ."'
					)
				");
			}
			else{
				$db->Execute("
					UPDATE `svy_drp_ruas_jalan_movie` SET
						`file_type` = NULLIF('". $_FILES[('movie_upload_' . $i)]['type'] ."', ''),
						`file_size` = NULLIF('". $_FILES[('movie_upload_' . $i)]['size'] ."', ''),
						`file_name` = NULLIF('". $_FILES[('movie_upload_' . $i)]['name'] ."', '')
					WHERE
						(`id__mst_ruas_jalan` = '". $p->IdRoad ."') AND
						(`time_stamp` = '". $p->TimeSurvey ."') AND
						(`post` = '". $p->Post ."') AND
						(`offset` = '". $p->Offset ."') AND
						(`mov_id` = '". $i ."')
				");
			}
		}
	}
	$db->Execute("COMMIT;");
	$p->Next->Process($v);
  }
  public function Path(){return __FILE__;}
}
?>