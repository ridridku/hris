<?
/**
 * @package Content
 */
require_once 'lib/excel_reader2.php';   
class UploadFileSurveyKondisiTepiHandlerContent extends ContentInterface
{
  public function UploadFileSurveyKondisiTepiHandlerContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
	$p = $this->Parent();
	$db = $p->MakeDatabase();
	
	$excel_file = $_FILES['excel_file'];
	if($excel_file)$excel_file = $_FILES['excel_file']['tmp_name'];
	$db->Execute("START TRANSACTION WITH CONSISTENT SNAPSHOT;");
	$db->Execute("DELETE FROM svy_kondisi_tepi_jalan");
	
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
			  $DataLajur = CommonDataQuery::ReadTable($db, 'mst_lajur', array('nama'), array($search_lajur));	
			  $lebar = $data->val($i, 7); 	
			  if($lebar==null)$lebar =0;	 
			  $search_bahu = $data->val($i, 8); 
			  $DataBahu = CommonDataQuery::ReadTable($db, 'mst_jenis_bahu', array('nama'), array($search_bahu));
			  $search_kondisi = $data->val($i,9);
			  $DataKondisi = CommonDataQuery::ReadTable($db, 'mst_kondisi_jalan', array('nama'), array($search_kondisi));
			  
			  #keterangan mst ruas jalan
			  $dari_km = $data->val($i,10);
			  $sampai_km = $data->val($i,11);
			  $awal = $data->val($i,12);
			  $akhir = $data->val($i,13);	
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
				SELECT * FROM svy_kondisi_tepi_jalan 
				WHERE 
						id__mst_ruas_jalan = '". $id_ruas ."' AND
						timestamp = '".$timestamp."' AND
						post = '". $post ."' AND
						offset = '". $offset ."' AND
						id__mst_lajur = '". $DataLajur['id'] ."'
				");
	
			if($db->RowCount($rsl)== 0){	
				 $sql = "INSERT INTO 
							svy_kondisi_tepi_jalan(id__mst_ruas_jalan,timestamp,post,offset,id__mst_lajur,lebar,id__mst_jenis_bahu,id__mst_kondisi_jalan)
						  VALUES (
								'$id_ruas', '$timestamp', '$post','$offset','".$DataLajur['id']."','$lebar','".$DataBahu['id']."','".$DataKondisi['id']."');";
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