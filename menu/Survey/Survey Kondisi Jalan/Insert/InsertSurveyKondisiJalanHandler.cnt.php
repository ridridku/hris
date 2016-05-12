<?php
class InsertSurveyKondisiJalanHandlerContent extends ContentInterface{
	public function InsertSurveyKondisiJalanHandlerContent(){
		ContentInterface::ContentInterface();
	}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	/*	
		
		$KeyColumn[0] = 'id__mst_ruas_jalan';
		$KeyColumn[1] = 'timestamp';
		$KeyColumn[2] = 'post';
		$KeyColumn[3] = 'offset';
		$KeyColumn[4] = 'id__mst_lajur';
		$KeyValue[0] = $p->IdLocRoad;
		$KeyValue[1] = $p->TimeStamp;
		$KeyValue[2] = $_POST['Post'];
		$KeyValue[3] = $_POST['Offset'];
		$KeyValue[4] = $_POST['id__mst_lajur'];		
		$OldData = CommonQuery::ReadTable($db, 'svy_kondisi_ruas_jalan', $KeyColumn, $KeyValue);
		
	*/	
		$Query = "
			SELECT *
			FROM svy_kondisi_ruas_jalan
			WHERE
				id__mst_ruas_jalan = '".  $p->IdLocRoad ."' AND
				timestamp = '". $p->TimeStamp."' AND
				post = '". $_POST['Post'] ."' AND
				offset = '". $_POST['Offset'] ."'	 AND
				id__mst_lajur = '".$_POST['id__mst_lajur'] ."' ";	
		$rsl = $db->Execute($Query);
		if($db->RowCount($rsl) == 0){
			$Query = "
				INSERT INTO svy_kondisi_ruas_jalan (
					id__mst_ruas_jalan,
					timestamp,
					post,
					offset,
					id__mst_lajur,
					id__mst_kondisi_jalan
				) VALUES (
					'". $p->IdLocRoad ."',
					'". $p->TimeStamp ."',
					'". $_POST['Post'] ."',
					'". $_POST['Offset'] ."',
					'". $_POST['id__mst_lajur'] ."',
					'". $_POST['KondisiJalan'] ."'
				)
			";
			$db->Execute($Query);
		}
		$db->Execute("COMMIT;");
		
		$p->Next->IdRuasJalan = $p->IdLocRoad;
		$p->Next->Time = $p->TimeStamp;
		$p->Next->Post= $_POST['Post'];
		$p->Next->Offset= $_POST['Offset'];						
		$p->Next->IdLajur = $_POST['id__mst_lajur'];		
		$p->Next->Process($v);
	}
	public function Path(){return __FILE__;}
}
?>