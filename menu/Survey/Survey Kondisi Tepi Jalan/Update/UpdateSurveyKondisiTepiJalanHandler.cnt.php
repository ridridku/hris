<?php
class UpdateSurveyKondisiTepiJalanHandlerContent extends ContentInterface{
	public function UpdateSurveyKondisiTepiJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$QUERY = "
			UPDATE svy_kondisi_tepi_jalan SET
					`post` = '" . $_POST['Post'] ."',
					`offset` = '" . $_POST['Offset'] ."',
					`id__mst_lajur` = '" . $_POST['NamaLajur'] ."',
					`lebar` = NULLIF('" . $_POST['lebar'] ."', ''),
					`id__mst_jenis_bahu` = NULLIF('" . $_POST['JenisBahu'] ."', ''),
					`id__mst_kondisi_jalan` = NULLIF('" . $_POST['KondisiBahu'] ."', '')
			WHERE
				`id__mst_ruas_jalan` = '" . $Par->IDRuas ."'  AND
				`timestamp` = '". $Par->TimeStamp ."' AND
				`post` = '" . $Par->Post ."'  AND
				`offset` = '" . $Par->Offset ."'  AND
				`id__mst_lajur` = '" . $Par->IDLajur ."'
		";		
		$Conn->Execute($QUERY);

		if(!empty($_FILES['file_upload_1']['name'])){
			move_uploaded_file($_FILES['file_upload_1']['tmp_name'], UPLOAD_DIR.'Tepi Jalan/'.
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-1'
			);
			chmod(
				UPLOAD_DIR. 'Tepi Jalan/'.
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-1'
				, 0777
			);
			$KeyColumn[0] = 'id__mst_ruas_jalan';
			$KeyColumn[1] = 'timestamp';
			$KeyColumn[2] = 'post';
			$KeyColumn[3] = 'offset';
			$KeyColumn[4] = 'id__mst_lajur';		
			$KeyColumn[5] = 'img_id';
			$KeyValue[0] = $Par->IDRuas;
			$KeyValue[1] = $Par->TimeStamp;
			$KeyValue[2] = $Par->Post;
			$KeyValue[3] = $Par->Offset;
			$KeyValue[4] = $Par->IDLajur;
			$KeyValue[5] = 1;
			$OldData = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
			if(!$OldData){
				$Conn->Execute("
					INSERT INTO `svy_kondisi_tepi_jalan_image` (
						`id__mst_ruas_jalan`,
						`timestamp`,
						`post`,
						`offset`,
						`id__mst_lajur`,
						`img_id`,
						`file_type`,
						`file_size`,
						`file_name`
					) VALUES (
						'". $Par->IDRuas ."',
						'". $Par->TimeStamp ."',
						'". $Par->Post ."',
						'". $Par->Offset ."',
						'". $Par->IDLajur ."',
						'". 1 ."',
						'". $_FILES['file_upload_1']['type'] ."',
						'". $_FILES['file_upload_1']['size'] ."',
						'". $_FILES['file_upload_1']['name'] ."'
					)
				");
			}
			else{
				$Conn->Execute("
					UPDATE `svy_kondisi_tepi_jalan_image` SET
						`file_type` = NULLIF('". $_FILES['file_upload_1']['type'] ."', ''),
						`file_size` = NULLIF('". $_FILES['file_upload_1']['size'] ."', ''),
						`file_name` = NULLIF('". $_FILES['file_upload_1']['name'] ."', '')
					WHERE
						`id__mst_ruas_jalan` = '" . $Par->IDRuas ."'  AND
						`timestamp` = '". $Par->TimeStamp ."' AND
						`post` = '" . $Par->Post ."'  AND
						`offset` = '" . $Par->Offset ."'  AND
						`id__mst_lajur` = '" . $Par->IDLajur ."' AND
						`img_id` = '". 1 ."'
				");
			}
		}
		if(!empty($_FILES['file_upload_2']['name'])){
			move_uploaded_file($_FILES['file_upload_2']['tmp_name'], UPLOAD_DIR. 'Tepi Jalan/' .
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-2'
			);
			chmod(
				UPLOAD_DIR. 'Tepi Jalan/' .
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-2'
				, 0777
			);			
			$KeyColumn[0] = 'id__mst_ruas_jalan';
			$KeyColumn[1] = 'timestamp';
			$KeyColumn[2] = 'post';
			$KeyColumn[3] = 'offset';
			$KeyColumn[4] = 'id__mst_lajur';		
			$KeyColumn[5] = 'img_id';
			$KeyValue[0] = $Par->IDRuas;
			$KeyValue[1] = $Par->TimeStamp;
			$KeyValue[2] = $Par->Post;
			$KeyValue[3] = $Par->Offset;
			$KeyValue[4] = $Par->IDLajur;
			$KeyValue[5] = 2;
			$OldData = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
			if(!$OldData){
				$Conn->Execute("
					INSERT INTO `svy_kondisi_tepi_jalan_image` (
						`id__mst_ruas_jalan`,
						`timestamp`,
						`post`,
						`offset`,
						`id__mst_lajur`,
						`img_id`,
						`file_type`,
						`file_size`,
						`file_name`
					) VALUES (
						'". $Par->IDRuas ."',
						'". $Par->TimeStamp ."',
						'". $Par->Post ."',
						'". $Par->Offset ."',
						'". $Par->IDLajur ."',
						'". 2 ."',
						'". $_FILES['file_upload_2']['type'] ."',
						'". $_FILES['file_upload_2']['size'] ."',
						'". $_FILES['file_upload_2']['name'] ."'
					)
				");
			}
			else{
				$Conn->Execute("
					UPDATE `svy_kondisi_tepi_jalan_image` SET
						`file_type` = NULLIF('". $_FILES['file_upload_2']['type'] ."', ''),
						`file_size` = NULLIF('". $_FILES['file_upload_2']['size'] ."', ''),
						`file_name` = NULLIF('". $_FILES['file_upload_2']['name'] ."', '')
					WHERE
						`id__mst_ruas_jalan` = '" . $Par->IDRuas ."'  AND
						`timestamp` = '". $Par->TimeStamp ."' AND
						`post` = '" . $Par->Post ."'  AND
						`offset` = '" . $Par->Offset ."'  AND
						`id__mst_lajur` = '" . $Par->IDLajur ."' AND
						`img_id` = '". 2 ."'
				");
			}
		}
		if(!empty($_FILES['file_upload_3']['name'])){
			move_uploaded_file($_FILES['file_upload_3']['tmp_name'], UPLOAD_DIR. 'Tepi Jalan/' .
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-3'
			);
			chmod(
				UPLOAD_DIR. 'Tepi Jalan/' .
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-3', 0777
			);			
			$KeyColumn[0] = 'id__mst_ruas_jalan';
			$KeyColumn[1] = 'timestamp';
			$KeyColumn[2] = 'post';
			$KeyColumn[3] = 'offset';
			$KeyColumn[4] = 'id__mst_lajur';		
			$KeyColumn[5] = 'img_id';
			$KeyValue[0] = $Par->IDRuas;
			$KeyValue[1] = $Par->TimeStamp;
			$KeyValue[2] = $Par->Post;
			$KeyValue[3] = $Par->Offset;
			$KeyValue[4] = $Par->IDLajur;
			$KeyValue[5] = 3;
			$OldData = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
			if(!$OldData){
				$Conn->Execute("
					INSERT INTO `svy_kondisi_tepi_jalan_image` (
						`id__mst_ruas_jalan`,
						`timestamp`,
						`post`,
						`offset`,
						`id__mst_lajur`,
						`img_id`,
						`file_type`,
						`file_size`,
						`file_name`
					) VALUES (
						'". $Par->IDRuas ."',
						'". $Par->TimeStamp ."',
						'". $Par->Post ."',
						'". $Par->Offset ."',
						'". $Par->IDLajur ."',
						'". 3 ."',
						'". $_FILES['file_upload_3']['type'] ."',
						'". $_FILES['file_upload_3']['size'] ."',
						'". $_FILES['file_upload_3']['name'] ."'
					)
				");
			}
			else{
				$Conn->Execute("
					UPDATE `svy_kondisi_tepi_jalan_image` SET
						`file_type` = NULLIF('". $_FILES['file_upload_3']['type'] ."', ''),
						`file_size` = NULLIF('". $_FILES['file_upload_3']['size'] ."', ''),
						`file_name` = NULLIF('". $_FILES['file_upload_3']['name'] ."', '')
					WHERE
						`id__mst_ruas_jalan` = '" . $Par->IDRuas ."'  AND
						`timestamp` = '". $Par->TimeStamp ."' AND
						`post` = '" . $Par->Post ."'  AND
						`offset` = '" . $Par->Offset ."'  AND
						`id__mst_lajur` = '" . $Par->IDLajur ."' AND
						`img_id` = '". 3 ."'
				");
			}
		}
		if(!empty($_FILES['file_upload_4']['name'])){
			move_uploaded_file($_FILES['file_upload_4']['tmp_name'], UPLOAD_DIR. 'Tepi Jalan/' .
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-4'
			);
			chmod(
				UPLOAD_DIR. 'Tepi Jalan/' .
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-4', 0777
			);			
			$KeyColumn[0] = 'id__mst_ruas_jalan';
			$KeyColumn[1] = 'timestamp';
			$KeyColumn[2] = 'post';
			$KeyColumn[3] = 'offset';
			$KeyColumn[4] = 'id__mst_lajur';		
			$KeyColumn[5] = 'img_id';
			$KeyValue[0] = $Par->IDRuas;
			$KeyValue[1] = $Par->TimeStamp;
			$KeyValue[2] = $Par->Post;
			$KeyValue[3] = $Par->Offset;
			$KeyValue[4] = $Par->IDLajur;
			$KeyValue[5] = 4;
			$OldData = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
			if(!$OldData){
				$Conn->Execute("
					INSERT INTO `svy_kondisi_tepi_jalan_image` (
						`id__mst_ruas_jalan`,
						`timestamp`,
						`post`,
						`offset`,
						`id__mst_lajur`,
						`img_id`,
						`file_type`,
						`file_size`,
						`file_name`
					) VALUES (
						'". $Par->IDRuas ."',
						'". $Par->TimeStamp ."',
						'". $Par->Post ."',
						'". $Par->Offset ."',
						'". $Par->IDLajur ."',
						'". 4 ."',
						'". $_FILES['file_upload_4']['type'] ."',
						'". $_FILES['file_upload_4']['size'] ."',
						'". $_FILES['file_upload_4']['name'] ."'
					)
				");
			}
			else{
				$Conn->Execute("
					UPDATE `svy_kondisi_tepi_jalan_image` SET
						`file_type` = NULLIF('". $_FILES['file_upload_4']['type'] ."', ''),
						`file_size` = NULLIF('". $_FILES['file_upload_4']['size'] ."', ''),
						`file_name` = NULLIF('". $_FILES['file_upload_4']['name'] ."', '')
					WHERE
						`id__mst_ruas_jalan` = '" . $Par->IDRuas ."'  AND
						`timestamp` = '". $Par->TimeStamp ."' AND
						`post` = '" . $Par->Post ."'  AND
						`offset` = '" . $Par->Offset ."'  AND
						`id__mst_lajur` = '" . $Par->IDLajur ."' AND
						`img_id` = '". 4 ."'
				");
			}
		}
		if(!empty($_FILES['file_upload_5']['name'])){
			move_uploaded_file($_FILES['file_upload_5']['tmp_name'], UPLOAD_DIR. 'Tepi Jalan/' .
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-5'
			);
			chmod(
				UPLOAD_DIR. 'Tepi Jalan/' .
				$Par->IDRuas .'-'.
				$Par->UnixTimeSurvey .'-'.
				$Par->Post .'-'.
				$Par->Offset .'-'.
				$Par->IDLajur .
				'-5', 0777
			);			
			$KeyColumn[0] = 'id__mst_ruas_jalan';
			$KeyColumn[1] = 'timestamp';
			$KeyColumn[2] = 'post';
			$KeyColumn[3] = 'offset';
			$KeyColumn[4] = 'id__mst_lajur';		
			$KeyColumn[5] = 'img_id';
			$KeyValue[0] = $Par->IDRuas;
			$KeyValue[1] = $Par->TimeStamp;
			$KeyValue[2] = $Par->Post;
			$KeyValue[3] = $Par->Offset;
			$KeyValue[4] = $Par->IDLajur;
			$KeyValue[5] = 5;
			$OldData = CommonQuery::ReadTable($Conn, 'svy_kondisi_tepi_jalan_image', $KeyColumn, $KeyValue);
			if(!$OldData){
				$Conn->Execute("
					INSERT INTO `svy_kondisi_tepi_jalan_image` (
						`id__mst_ruas_jalan`,
						`timestamp`,
						`post`,
						`offset`,
						`id__mst_lajur`,
						`img_id`,
						`file_type`,
						`file_size`,
						`file_name`
					) VALUES (
						'". $Par->IDRuas ."',
						'". $Par->TimeStamp ."',
						'". $Par->Post ."',
						'". $Par->Offset ."',
						'". $Par->IDLajur ."',
						'". 5 ."',
						'". $_FILES['file_upload_5']['type'] ."',
						'". $_FILES['file_upload_5']['size'] ."',
						'". $_FILES['file_upload_5']['name'] ."'
					)
				");
			}
			else{
				$Conn->Execute("
					UPDATE `svy_kondisi_tepi_jalan_image` SET
						`file_type` = NULLIF('". $_FILES['file_upload_5']['type'] ."', ''),
						`file_size` = NULLIF('". $_FILES['file_upload_5']['size'] ."', ''),
						`file_name` = NULLIF('". $_FILES['file_upload_5']['name'] ."', '')
					WHERE
						`id__mst_ruas_jalan` = '" . $Par->IDRuas ."'  AND
						`timestamp` = '". $Par->TimeStamp ."' AND
						`post` = '" . $Par->Post ."'  AND
						`offset` = '" . $Par->Offset ."'  AND
						`id__mst_lajur` = '" . $Par->IDLajur ."' AND
						`img_id` = '". 5 ."'
				");
			}
		}		
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(
			array(
				'id__mst_ruas_jalan'=>$Par->IDRuas,
				'timestamp'=>$Par->TimeStamp,
				'post'=>$_POST['Post'],
				'offset'=>$_POST['Offset'],
				'id__mst_lajur'=>$_POST['NamaLajur']
			)
		);
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
}
?>