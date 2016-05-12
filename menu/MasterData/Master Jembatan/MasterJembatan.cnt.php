<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterJembatan.rmd.php';

class MasterJembatanContent extends CommonGridContent
{
	public function MasterJembatanContent(){
		CommonGridContent::CommonGridContent();
	}
	public function RowPerPage(){
		$rowPerPage = floor(($_SESSION[FrameworkSessionConstant::WindowOuterHeight] - (160 + 63)) / 18);
		return $rowPerPage;
	}
	public function MakeRowModifier(){return new MasterJembatanRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return false;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertMasterJembatanMenu($p->Kode);
		$Link = array();
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Tambah';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		
		
		$m = new PrintedMasterJembatanOdtMenu($p->Kode);
		$Link[1][RowModifierConstant::BottomLink__Name] = 'Cetak';
		$Link[1][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		
		
		return $Link;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){return array();}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "mst_bridge"),	
			array('TABLE' => "mst_ruas_jalan")
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "mst_bridge.id",
				'ALIAS' => "ID Jembatan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.nama",
				'ALIAS' => "Nama Jembatan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_kota.nama
					FROM mst_kota
					WHERE
						mst_bridge.dari_lokasi = mst_kota.id
				)",
				'ALIAS' => "Dari Lokasi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.km_pos",
				'ALIAS' => "KM Lokasi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_ruas_jalan.nama_ruas
					FROM mst_ruas_jalan
					WHERE
						mst_bridge.id__mst_ruas_jalan = mst_ruas_jalan.id
				)",
				'ALIAS' => "Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.sffx",
				'ALIAS' => "SFFX",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_bridge_tipe_lintasan.nama
					FROM mst_bridge_tipe_lintasan
					WHERE
						mst_bridge.id__mst_bridge_tipe_lintasan = mst_bridge_tipe_lintasan.id
				)",
				'ALIAS' => "Tipe Lintasan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.bentang",
				'ALIAS' => "Jumlah Bentang",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.panjang",
				'ALIAS' => "Panjang",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.lebar",
				'ALIAS' => "Lebar",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.tahun_bangun",
				'ALIAS' => "Tahun Bangun",
				'IS_SEARCHED' => true
			)/*,
			array(
				'FIELD' => "mst_bridge.tipe_ba",
				'ALIAS' => "Tipe BA",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.tipe_bb",
				'ALIAS' => "Tipe BB",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.status",
				'ALIAS' => "Status",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.start_gps_lat",
				'ALIAS' => "Awal GPS Lat",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.end_gps_lat",
				'ALIAS' => "AKhir GPS Lat",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.start_gps_lon",
				'ALIAS' => "Awal GPS Lon",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.end_gps_lon",
				'ALIAS' => "Akhir GPS Lon",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.start_gps_alt",
				'ALIAS' => "Awal GPS Alt",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.end_gps_alt",
				'ALIAS' => "Akhir GPS Alt",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.start_gps_elev",
				'ALIAS' => "Awal GPS Elev",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.end_gps_elev",
				'ALIAS' => "Akhir GPS Elev",
				'IS_SEARCHED' => true
			),
			
			
			array(
				'FIELD' => "mst_bridge.jml_pier",
				'ALIAS' => "Jumlah Pier",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.jarak_pier_abutmen",
				'ALIAS' => "Jarak Pier Abutmen",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.jarak_pier_pier",
				'ALIAS' => "Jarak Pier-Pier",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.lebar_median",
				'ALIAS' => "Lebar Median",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.lebar_trotoir",
				'ALIAS' => "Lebar Trotoir",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.lebar_perkerasan",
				'ALIAS' => "Lebar Perkerasan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_bridge.bahu_jalan",
				'ALIAS' => "Bahu Jalan",
				'IS_SEARCHED' => true
			)*/
		);	
	}

	public function Conditions(){
		return array(
			array(
				'CONDITION' => "`mst_bridge`.`id__mst_ruas_jalan` = mst_ruas_jalan.id",
				'OPERATOR' => null
			)
		);
  	}		  
}
?>