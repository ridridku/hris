<?php
class InsertSurveyPosisiJembatanHandlerContent extends ContentInterface{
	public function InsertSurveyPosisiJembatanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();
	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$CekQuery = $Conn->Execute("
			SELECT * FROM svy_posisi_jembatan
			WHERE
				id_mst_bridge = '". $_POST['NamaJembatan'] ."' AND
				id__mst_ruas_jalan = '" . $Par->SearchIDRuas ."'  AND
				timestamp = '". $Par->TimeStamp ."' AND
				post = '". $_POST['Post'] ."' AND
				offset = '". $_POST['Offset'] ."'
		");			
		if ($Conn->RowCount($CekQuery) == 0) {	
			$sql = "
				INSERT INTO svy_posisi_jembatan (
					id_mst_bridge,
					id__mst_ruas_jalan,
					timestamp,
					post,
					offset,
					
					
					span,
					width,
					free_board,
					deck,
					beams,
					side_rails,
					abutment,
					foundation,
					pavement,
					description
				) VALUES (
					'". $_POST['NamaJembatan'] ."',
					'". $Par->SearchIDRuas ."',
					'". $Par->TimeStamp ."',
					'". $_POST['Post'] ."',
					'". $_POST['Offset'] ."',
					
					NULLIF('".$_POST['span']."',''),
					NULLIF('".$_POST['width']."',''),
					NULLIF('".$_POST['free_board']."',''),
					NULLIF('".$_POST['deck']."','-1'),
					NULLIF('".$_POST['beams']."','-1'),																				
					NULLIF('".$_POST['side_rails']."','-1'),
					NULLIF('".$_POST['abutment']."','-1'),
					NULLIF('".$_POST['foundation']."','-1'),
					NULLIF('".$_POST['pavement']."','-1'),
					NULLIF('".$_POST['description']."','-1')					
				)
			"; 
			$Conn->Execute($sql);
		}
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(
			array(
				'id_mst_bridge'=> $_POST['NamaJembatan'],
				'id__mst_ruas_jalan'=> $Par->SearchIDRuas,
				'timestamp'=> $Par->TimeStamp,
				'post'=> $_POST['Offset'],
				'offset'=> $_POST['Offset']
			)	
		);
		$Par->Next->Process($v);
	}
	public function Path(){return __FILE__;}
}
?>