<?
/**
 * @package Content
 */
require_once 'lib/excel_reader2.php';
class UploadFileSurveyDeskripsiJalanHandlerContent extends ContentInterface
{
  public function UploadFileSurveyDeskripsiJalanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$excel_file = $_FILES['excel_file'];
	if($excel_file)$excel_file = $_FILES['excel_file']['tmp_name'];
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
#	$db->Execute("DELETE FROM svy_deskripsi_ruas_jalan");
	
	
	$data = new Spreadsheet_Excel_Reader($excel_file);// membaca file excel yang diupload	
	$baris = $data->rowcount($sheet_index=0); 	// membaca jumlah baris dari data excel
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
			  $DataLajur = CommonDataQuery::ReadTable($db, 'mst_lajur', array('nama'), array($search_lajur));			 
			  $lebar = $data->val($i, 7);
			  
			  #keterangan mst ruas jalan
			  $dari_km = $data->val($i,8);
			  $sampai_km = $data->val($i,9);
			  $awal = $data->val($i,10);
			  $akhir = $data->val($i,11);	
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
			  
			  #insert Deskripsi ruas Jalan
			  $rsl = $db->Execute("
				SELECT * FROM svy_deskripsi_ruas_jalan 
				WHERE 
						id__mst_ruas_jalan = '". $id_ruas ."' AND
						timestamp = '".$timestamp."' AND
						post = '". $post ."' AND
						offset = '". $offset ."' AND
						id__mst_lajur = '". $DataLajur['id'] ."'
				");
	
			if($db->RowCount($rsl)== 0){		  
				  $sql = "INSERT INTO 
							svy_deskripsi_ruas_jalan(id__mst_ruas_jalan,timestamp,post,offset,id__mst_lajur,lebar)
						  VALUES (
								'$id_ruas', '$timestamp', '$post','$offset','".$DataLajur['id']."','$lebar');";
				  $db->Execute($sql);
				}
			
		}
	}
	$db->Execute("COMMIT;");
	$p->Next->Process($v);  
  }
  public function Path(){return __FILE__;}
}
?>