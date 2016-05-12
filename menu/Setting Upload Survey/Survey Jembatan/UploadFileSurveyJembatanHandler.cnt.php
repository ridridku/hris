<?
/**
 * @package Content
 */
require_once 'lib/excel_reader2.php';  
class UploadFileSurveyJembatanHandlerContent extends ContentInterface
{
  public function UploadFileSurveyJembatanHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$excel_file = $_FILES['excel_file'];
	if($excel_file)$excel_file = $_FILES['excel_file']['tmp_name'];
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
#	$db->Execute("DELETE FROM svy_posisi_jembatan");
	
	
	$data = new Spreadsheet_Excel_Reader($excel_file);// membaca file excel yang diupload	
	$baris = $data->rowcount($sheet_index=0); 	// membaca jumlah baris dari data excel
	$column = $data->colcount($sheet_index=0); 
	if($baris == 0)$baris = 100000;
	for ($i=2; $i<=$baris; $i++){ 	
		if($data->val($i, 1) != null){
			  $id_bridge = $data->val($i, 1);  	
			  $nama_jembatan = $data->val($i,2);
			  
			  $id_ruas = $data->val($i,3);
			  $nama_ruas = $data->val($i,4);
			  
			  $format_date = $data->val($i, 5); 	  
			  $tgl = explode('-',$format_date);
			  $tahun_waktu = explode(' ',$tgl[2]);
			  $timestamp = $tahun_waktu[0].'-'.$tgl[1].'-'.$tgl[0].' '.$tahun_waktu[1];
			  $post_offset = explode('.', $data->val($i, 6));
			  $post = $post_offset[0]; 
			  $offset = $post_offset[1]; 
			  if($offset==null)$offset = 0;
			  #keterangan mst ruas jalan
			  $dari_km = $data->val($i,7);
			  $sampai_km = $data->val($i,8);
			  $awal = $data->val($i,9);
			  $akhir = $data->val($i,10);	
			   #insert Master Ruas Jalan
			   
			  
			  #keterangan tambahan 
			   $span = $data->val($i,11);	
			   $width = $data->val($i,12);
			   $free_board = $data->val($i,13);			   				   

			   $deck = $data->val($i,14);
			   $datadeck = CommonDataQuery::ReadTable($db, 'mst_required', array('singkatan'), array($deck));	
			   	
			   $beams = $data->val($i,15);
			   $databeams = CommonDataQuery::ReadTable($db, 'mst_required', array('singkatan'), array($beams));		
			   
			   $side_rail = $data->val($i,16);			   				   
			   $dataside_rail = CommonDataQuery::ReadTable($db, 'mst_required', array('singkatan'), array($side_rail));	

			   $abutment = $data->val($i,17);
			   $dataabutment = CommonDataQuery::ReadTable($db, 'mst_required', array('singkatan'), array($abutment));	
			   	
			   $foundation = $data->val($i,18);
			   $datafoundation = CommonDataQuery::ReadTable($db, 'mst_required', array('singkatan'), array($foundation));
			   
			   $pavement = $data->val($i,19);			   				   
			   $datapavement = CommonDataQuery::ReadTable($db, 'mst_required', array('singkatan'), array($pavement));
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
				
			 #insert Master Jembatan
			  $rsl = $db->Execute("
				SELECT * FROM mst_bridge 
				WHERE 
						id = '". $id_bridge ."'");	
			  if($db->RowCount($rsl)== 0){
					$db->Execute("INSERT INTO mst_bridge (id,nama,id__mst_ruas_jalan) 
						VALUES ('$id_bridge','$nama_jembatan','$id_ruas')");
				}
				
			  
			  #insert Data
			  $rsl = $db->Execute("
				SELECT * FROM svy_posisi_jembatan 
				WHERE 
						id_mst_bridge = '".$id_bridge."' AND
						id__mst_ruas_jalan = '". $id_ruas ."' AND
						timestamp = '".$timestamp."' AND
						post = '". $post ."' AND
						offset = '". $offset ."' 
				");
	
			if($db->RowCount($rsl) == 0){		  
				  $sql = "INSERT INTO 
							svy_posisi_jembatan(id_mst_bridge,id__mst_ruas_jalan,timestamp,post,offset,
							span,
							width,
							free_board,
							
							deck,
							beams,
							side_rails,
							abutment,
							foundation,
							pavement
							)
						  VALUES (
								'$id_bridge','$id_ruas', '$timestamp', '$post','$offset',
								'$span',
								'$width',
								'$free_board'
								'".$datadeck['id']."',	
								'".$databeams['id']."',	
								'".$dataside_rails['id']."',	
								'".$dataabutment['id']."',	
								'".$datafoundation['id']."',	
								'".$datapavement['id']."',	
								);";
#				echo $sql.'<br>';
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