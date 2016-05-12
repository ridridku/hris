<?
require_once FW_DIR . '/constant/ComboBox.cst.php';

class DetailMasterJembatanContent extends ContentInterface{
 
  public function DetailMasterJembatanContent(){
	ContentInterface::ContentInterface();
  }
  private function GetDataDetailJembatan($db, $IDJembatan){  
	  $sql ="
				SELECT SQL_CALC_FOUND_ROWS mst_bridge.id , 
						(
							SELECT 	mst_propinsi.nama 
							FROM mst_propinsi 
							WHERE mst_propinsi.id IN(				
								SELECT mst_ruas_jalan.id__mst_propinsi
								FROM mst_ruas_jalan
								WHERE
									mst_bridge.id__mst_ruas_jalan = mst_ruas_jalan.id)
						)'propinsi',
						mst_bridge.nama , 
						( 
							SELECT mst_kota.nama 
							FROM mst_kota 
							WHERE mst_bridge.dari_lokasi = mst_kota.id 
						)'dari_lokasi' , 
						mst_bridge.km_pos , 
						( 
							SELECT mst_ruas_jalan.nama_ruas 
							FROM mst_ruas_jalan 
							WHERE mst_bridge.id__mst_ruas_jalan = mst_ruas_jalan.id 
						) 'nama_ruas', 
						mst_bridge.sffx , 
						( 
							SELECT mst_bridge_tipe_lintasan.nama 
							FROM mst_bridge_tipe_lintasan 
							WHERE mst_bridge.id__mst_bridge_tipe_lintasan = mst_bridge_tipe_lintasan.id 
						) 'lintasan', 
						mst_bridge.bentang , 
						mst_bridge.panjang , 
						mst_bridge.lebar , 
						mst_bridge.tahun_bangun , 
						mst_bridge.tipe_ba , 
						mst_bridge.tipe_bb , 
						mst_bridge.status , 						
						mst_bridge.start_gps_lat , 
						mst_bridge.end_gps_lat , 
						mst_bridge.start_gps_lon , 
						mst_bridge.end_gps_lon , 
						mst_bridge.start_gps_alt , 
						mst_bridge.end_gps_alt , 
						mst_bridge.start_gps_elev , 
						mst_bridge.end_gps_elev , 
						mst_bridge.jml_pier , 
						mst_bridge.jarak_pier_abutmen , 
						mst_bridge.jarak_pier_pier , 
						mst_bridge.lebar_median , 
						mst_bridge.lebar_trotoir , 
						mst_bridge.lebar_perkerasan , 
						mst_bridge.bahu_jalan, 
						mst_bridge.clearance,
						mst_bridge.keterangan
				FROM 
						mst_bridge
				WHERE mst_bridge.id = '". $IDJembatan ."' AND ((True) )";
#	  echo $sql;
	  $resUraian = $db->Execute($sql);
	  return $resUraian->GetRows();
  }
  public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();	
		$adodb = $db->MakeAdoDb();
		$DetailJembatan = $this->GetDataDetailJembatan($adodb, $p->IDJembatan);	
		
		$g = $p->MakeGuiFactory();
		$f= $g->MakeForm();
		
		$r = $g->MakeSubTitle();
		$r->TextToDisplay = 'DATA DETAIL JEMBATAN';
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$f->AddRowElement($r);
				
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Propinsi';
		$r->Value = $DetailJembatan[0]['propinsi'];		
		$f->AddRowElement($r);
		
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'ID Jembatan';
		$r->Value = $DetailJembatan[0]['id'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Nama Jembatan';
		$r->Value = $DetailJembatan[0]['nama'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Dari Lokasi';
		$r->Value = $DetailJembatan[0]['dari_lokasi'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'KM Lokasi';
		$r->Value = $DetailJembatan[0]['km_pos'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Ruas';
		$r->Value = $DetailJembatan[0]['nama_ruas'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'SFFX';
		$r->Value = $DetailJembatan[0]['sffx'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Tipe Lintasan';
		$r->Value = $DetailJembatan[0]['lintasan'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Jumlah Bentang';
		$r->Value = $DetailJembatan[0]['bentang'].' Buah';		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Panjang';
		$r->Value = $DetailJembatan[0]['panjang'].' meter';		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Lebar';
		$r->Value = $DetailJembatan[0]['lebar'].' meter';		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Tahun Bangun';
		$r->Value = $DetailJembatan[0]['tahun_bangun'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Tipe BA';
		$r->Value = $DetailJembatan[0]['tipe_ba'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Tipe BB';
		$r->Value = $DetailJembatan[0]['tipe_bb'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Status';
		$r->Value = $DetailJembatan[0]['status'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Jumlah Pier';
		$r->Value = $DetailJembatan[0]['jml_pier'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Jarak Pier Abutmen';
		$r->Value = $DetailJembatan[0]['jarak_pier_abutmen'].' meter';		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Jarak Pier  Pier';
		$r->Value = $DetailJembatan[0]['jarak_pier_pier'].' meter';		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Lebar Median';
		$r->Value = $DetailJembatan[0]['lebar_median'].' meter';		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Lebar Trotoir';
		$r->Value = $DetailJembatan[0]['lebar_trotoir'].' meter';		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Lebar Perkerasan';
		$r->Value = $DetailJembatan[0]['lebar_perkerasan'].' meter';		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Bahu Jalan';
		$r->Value = $DetailJembatan[0]['bahu_jalan'].' meter';	
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Clearance';
		$r->Value = $DetailJembatan[0]['clearance'].' meter';	
		$f->AddRowElement($r);
		
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'POSISI GPS Latitude';	
		$f->AddRowElement($r);
		
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Awal GPS Lat';
		$r->Value = $DetailJembatan[0]['start_gps_lat'];//.'&deg;';		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Akhir GPS Lat';
		$r->Value = $DetailJembatan[0]['end_gps_lat'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'POSISI GPS Longitude';	
		$f->AddRowElement($r);
		
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Awal GPS Lon';
		$r->Value = $DetailJembatan[0]['start_gps_lon'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Akhir GPS Lon';
		$r->Value = $DetailJembatan[0]['end_gps_lon'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'POSISI GPS Altitude';	
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Awal GPS Alt';
		$r->Value = $DetailJembatan[0]['start_gps_alt'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Akhir GPS Alt';
		$r->Value = $DetailJembatan[0]['end_gps_alt'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'POSISI GPS Elevent';	
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Awal GPS Elev';
		$r->Value = $DetailJembatan[0]['start_gps_elev'];		
		$f->AddRowElement($r);
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Akhir GPS Elev';
		$r->Value = $DetailJembatan[0]['end_gps_elev'];		
		$f->AddRowElement($r);
		
		
		$r = $g->MakeLabel();
		$r->TextToDisplay = 'Keterangan';
		$r->Value = $DetailJembatan[0]['keterangan'];		
		$f->AddRowElement($r);
		
		
	
		$f->Display($p, $v);
	}
  public function Path(){return __FILE__;}
  public function HaveDownloadButton(){return true;}
}













/*require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterJembatan.cnt.php';

class DetailMasterJembatanContent extends MasterJembatanContent{
	public function DetailMasterJembatanContent(){
		MasterJembatanContent::MasterJembatanContent();
	}
	public function Conditions(){
		$Par = $this->Parent();
		return array(
			array(
				'CONDITION' => "mst_bridge.id = '". $Par->IDJembatan ."'",
				'OPERATOR' => NULL
			)
		);
  	}		  
}*/
?>