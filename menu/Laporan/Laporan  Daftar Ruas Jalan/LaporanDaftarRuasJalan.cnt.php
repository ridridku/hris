<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'LaporanDaftarRuasJalan.rmd.php';

class LaporanDaftarRuasJalanContent extends CommonGridContent
{
	public function LaporanDaftarRuasJalanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new LaporanDaftarRuasJalanRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		return NULL;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){return array();}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "svy_ruas_jalan"),array('TABLE' => "mst_ruas_jalan")		
		);
	}

	public function Fields(){
		return array(
			
			array(
				'FIELD' => "svy_ruas_jalan.time_stamp",
				'ALIAS' => "Waktu ",
				'IS_SEARCHED' =>TRUE
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
				'FIELD' => "mst_ruas_jalan.kp_from",
				'ALIAS' => "Dari Km",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.kp_to",
				'ALIAS' => "Sampai Km",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.panjang",
				'ALIAS' => "Panjang",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.lebar",
				'ALIAS' => "Lebar",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_ruas_jalan.id__mst_ruas_jalan",
				'ALIAS' => "IdRuasJalan _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_ruas_jalan.time_stamp",
				'ALIAS' => "Time _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			)
		);	
	}

	public function Conditions(){
		return array(
			array(
				'CONDITION' => "svy_ruas_jalan.id__mst_ruas_jalan =  mst_ruas_jalan.id",
				'OPERATOR' => NULL
			)
		);
  	}		  
}
?>