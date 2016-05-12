<?php
require_once 'lib/excel_reader2.php'; 
class UploadFileSurveyPerkerasanHandlerContent extends ContentInterface
{
  public function UploadFileSurveyPerkerasanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$excel_file = $_FILES['excel_file'];
	if($excel_file)$excel_file = $_FILES['excel_file']['tmp_name'];
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
#	$db->Execute("DELETE FROM svy_perkerasan_jalan");
	
	
	$data = new Spreadsheet_Excel_Reader($excel_file);
	$baris = $data->rowcount($sheet_index=0); 	
	$column = $data->colcount($sheet_index=0); 
	if($baris == 0)$baris = 100000;
	for ($i=2; $i<=$baris; $i++){ 	
		if($data->val($i, 1) != null){
			  $id_ruas = $data->val($i, 1); 
			  $nama_ruas = $data->val($i,2); 				  
			  $format_date = $data->val($i, 3); 	  
			  $tgl = explode('-',$format_date);
			  $tahun_waktu = explode(' ',$tgl[2]);
			  $timestamp = $tahun_waktu[0].'-'.$tgl[1].'-'.$tgl[0].' '.$tahun_waktu[1];
			 
			  $post = $data->val($i, 4); 
			  $offset = $data->val($i, 5); 
			  $search_lajur = $data->val($i,6); 
			  $DataLajur = $this->ReadTable($db, 'mst_lajur', array('nama'), array($search_lajur));	
			  $lebar = $data->val($i, 7); 		 
			  $search_perkerasan = $data->val($i, 8); 
			  $DataPerkerasan = $this->ReadTable($db, 'mst_perkerasan', array('nama'), array($search_perkerasan));
			  
			  #keterangan mst ruas jalan
			  $dari_km = $data->val($i,9);
			  $sampai_km = $data->val($i,10);
			  $awal = $data->val($i,11);
			  $akhir = $data->val($i,12);	
			  $FieldColumn[0] = 'id';
			  $FieldColumn[1] = 'nama_ruas';
			  $FieldColumn[2] = 'kp_from';
			  $FieldValue[0] = $id_ruas;
			  $FieldValue[1] = $nama_ruas;
			  $FieldValue[2] = $dari_km;
			  
			 
			   #insert Master Ruas Jalan
			   $rsl = $db->Execute("
				SELECT * FROM mst_ruas_jalan 
				WHERE 
						id = '". $id_ruas ."'");	
			   if($db->RowCount($rsl)== 0){
					$Query = "INSERT INTO mst_ruas_jalan (id,nama_ruas,kp_from,kp_to,awal_ruas,akhir_ruas) 
						VALUES ('".$id_ruas."','".$nama_ruas."',".($dari_km==null? 0 : $dari_km).",".($sampai_km==null? 0 : $sampai_km).",'".$awal."','".$akhir."')";
					$db->Execute($Query);
				}
			  
			  #insert waktu survey Jalan
			  $rsl = $db->Execute("
				SELECT * FROM svy_ruas_jalan 
				WHERE 
						id__mst_ruas_jalan = '". $id_ruas ."' AND
						time_stamp = '".$timestamp."' ");	
			  if($db->RowCount($rsl)== 0){
					$db->Execute("INSERT INTO svy_ruas_jalan (id__mst_ruas_jalan,time_stamp) VALUES ('$id_ruas','$timestamp')");
				}
			  
			  #insertdata
			  $rsl = $db->Execute("
				SELECT * FROM svy_perkerasan_jalan 
				WHERE 
						id__mst_ruas_jalan = '". $id_ruas ."' AND
						timestamp = '".$timestamp."' AND
						post = '". $post ."' AND
						offset = '". $offset ."' AND
						id__mst_lajur = '". $DataLajur['id'] ."' AND
						id__mst_perkerasan = '".$DataPerkerasan['id']."'
				");
			  if($db->RowCount($rsl)== 0){	
				 $sql = "INSERT INTO 
							svy_perkerasan_jalan(id__mst_ruas_jalan,timestamp,post,offset,id__mst_lajur,lebar,id__mst_perkerasan)
						  VALUES (
								'$id_ruas', '$timestamp', '$post','$offset','".$DataLajur['id']."','$lebar','".$DataPerkerasan['id']."');";
#				  echo '<br>'. $sql;
				  $db->Execute($sql);
			}		  			  	
		}
	}
	$db->Execute("COMMIT;");
	$p->Next->Process($v);  
  }
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
  private function ReadTable(DatabaseInterface $db, $TableName, $KeyColumn = array(), $KeyName = array()){
		$Condition = '';
		if(is_array($KeyColumn) && is_array($KeyName)){
			if(count($KeyColumn) == count($KeyName)){
				if(count($KeyColumn) == 1){
					$Condition = $Condition . $KeyColumn[0] ." LIKE '%". $KeyName[0] ."%'";
				}
				
			}
			$Query = $db->Execute("
				SELECT
					*
				FROM
					`". $TableName ."`
				WHERE
					". $Condition ."
			");
		}
		$Field = $db->FetchArray($Query);
		return $Field;
	}
}
?>