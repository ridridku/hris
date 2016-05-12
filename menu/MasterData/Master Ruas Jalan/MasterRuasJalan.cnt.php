<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterRuasJalan.rmd.php';

class MasterRuasJalanContent extends CommonGridContent{
	public function MasterRuasJalanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new MasterRuasJalanRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}
	public function RowPerPage(){
		$rowPerPage = floor(($_SESSION[FrameworkSessionConstant::WindowOuterHeight] - (160 + 63)) / 18);
		return 15;
	}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertMasterRuasJalanMenu($p->Kode);
		$Link = array();
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Tambah';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		return $Link;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){return array();}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "mst_ruas_jalan")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "mst_ruas_jalan.id",
				'ALIAS' => "ID Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.ruas",
				'ALIAS' => "Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.sffx",
				'ALIAS' => "SFFX",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.kota",
				'ALIAS' => "Kota",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.nama_ruas",
				'ALIAS' => "Nama Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.lokasi",
				'ALIAS' => "Lokasi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "CONCAT(mst_ruas_jalan.kp_from, ' - ', mst_ruas_jalan.kp_to)",
				'ALIAS' => "Kilometer",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.panjang",
				'ALIAS' => "Panjang",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.panjang_kepmen",
				'ALIAS' => "Panjang Max",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.lebar",
				'ALIAS' => "Lebar",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.aadt",
				'ALIAS' => "AADT",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.awal_ruas",
				'ALIAS' => "Awal Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.akhir_ruas",
				'ALIAS' => "Akhir Ruas",
				'IS_SEARCHED' => true
			)/*,
			array(
				'FIELD' => "mst_ruas_jalan.mst",
				'ALIAS' => "MST",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_propinsi.nama
					FROM mst_propinsi
					WHERE
						mst_ruas_jalan.id__mst_propinsi = mst_propinsi.id
				)",
				'ALIAS' => "Propinsi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_status_jalan.nama
					FROM mst_status_jalan
					WHERE
						mst_ruas_jalan.id__mst_status_jalan = mst_status_jalan.id
				)",
				'ALIAS' => "Status",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_fungsi.nama
					FROM mst_fungsi
					WHERE
						mst_ruas_jalan.id__mst_fungsi = mst_fungsi.id
				)",
				'ALIAS' => "Fungsi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_lintas.nama
					FROM mst_lintas
					WHERE
						mst_ruas_jalan.id__mst_lintas = mst_lintas.id
				)",
				'ALIAS' => "Lintas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_tipe_jalan.nama
					FROM mst_tipe_jalan
					WHERE
						mst_ruas_jalan.id__mst_tipe_jalan = mst_tipe_jalan.id
				)",
				'ALIAS' => "Type",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.pos_start_bt",
				'ALIAS' => "Start BT",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.pos_start_ls",
				'ALIAS' => "Start LS",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.pos_start_h",
				'ALIAS' => "Start H",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.pos_end_bt",
				'ALIAS' => "Akhir BT",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.pos_end_ls",
				'ALIAS' => "Akhir LS",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.pos_end_h",
				'ALIAS' => "Akhir H",
				'IS_SEARCHED' => true
			)*/,
			array(
				'FIELD' => "mst_ruas_jalan.keterangan",
				'ALIAS' => "Keterangan",
				'IS_SEARCHED' => true
			)
		);	
	}

	public function Conditions(){
		return array(
			array(
				'CONDITION' => "mst_ruas_jalan.id__mst_propinsi IN (
									SELECT 
										id 
									FROM 
										mst_propinsi 
									WHERE id__mst_balaibesar = '".$_SESSION[FrameworkSessionConstant::IdBidang]."'
			)",
				'OPERATOR' => NULL
			)
		);
  	}		  
}
?>