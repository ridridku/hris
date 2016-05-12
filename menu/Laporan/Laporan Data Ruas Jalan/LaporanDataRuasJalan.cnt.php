<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'LaporanDataRuasJalan.rmd.php';

class LaporanDataRuasJalanContent extends CommonGridContent
{
	public function LaporanDataRuasJalanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new LaporanDataRuasJalanRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$Par = $this->Parent();
	
		$m = new PrintedDataRuasJalanMenu();
#		$m->AddTail(clone($Par));
		$Link = array();
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Cetak';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		return $Link;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){return array();}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "svy_drp_ruas_jalan"),array('TABLE' => "mst_ruas_jalan")		
		);
	}

	public function Fields(){
		return array(
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
				'FIELD' => "svy_drp_ruas_jalan.post",
				'ALIAS' => "Post ",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.offset",
				'ALIAS' => "OffSet ",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.id__mst_ruas_jalan",
				'ALIAS' => "IdRuasJalan _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.time_stamp",
				'ALIAS' => "Time _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.post",
				'ALIAS' => "Post _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.offset",
				'ALIAS' => "OffSet _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			)
		);	
	}

	public function Conditions(){
		$p= $this->Parent();
		return array(
			array(
				'CONDITION' => "mst_ruas_jalan.id__mst_propinsi IN (
									SELECT 
										id 
									FROM 
										mst_propinsi 
									WHERE id__mst_balaibesar = '".$_SESSION[FrameworkSessionConstant::IdBidang]."'
								)",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_drp_ruas_jalan.id__mst_ruas_jalan =  mst_ruas_jalan.id",
				'OPERATOR' => NULL
			)
		);
  	}		  
}
?>