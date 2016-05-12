<?php
class InsertSurveyKondisiTepiJalanHandlerContent extends ContentInterface{
	public function InsertSurveyKondisiTepiJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$Par = $this->Parent();
		$Conn = $Par->MakeDatabase();	
		$Conn->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
		$CekQuery = $Conn->Execute("
			SELECT * FROM `svy_kondisi_tepi_jalan`
			WHERE
				`id__mst_ruas_jalan` = '" . $Par->SearchIDRuas ."'  AND
				`timestamp` = '". $Par->SearchTimeStamp ."' AND
				`post` = '" . $_POST['Post'] ."'  AND
				`offset` = '" . $_POST['Offset'] ."'  AND
				`id__mst_lajur` = '" . $_POST['NamaLajur'] ."'				
		");		
		if ($Conn->RowCount($CekQuery) == 0) {
			$Conn->Execute("
				INSERT INTO `svy_kondisi_tepi_jalan` (
					`id__mst_ruas_jalan`,
					`timestamp`,
					`post`,
					`offset`,
					`id__mst_lajur`,
					`lebar`,
					`id__mst_jenis_bahu`,
					`id__mst_kondisi_jalan`
				) VALUES (
					'" . $Par->SearchIDRuas ."',
					'" . $Par->SearchTimeStamp ."',
					'" . $_POST['Post'] ."',
					'" . $_POST['Offset'] ."',
					'" . $_POST['NamaLajur'] ."',
					NULLIF('" . $_POST['lebar'] ."', ''),
					NULLIF('" . $_POST['JenisBahu'] ."', ''),
					NULLIF('" . $_POST['KondisiBahu'] ."', '')
				)						 
			");
		}
		$Conn->Execute("COMMIT;");
		$Par->Next->OnSetKey(
			array(
				'id__mst_ruas_jalan'=>$Par->SearchIDRuas,
				'timestamp'=>$Par->SearchTimeStamp,
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