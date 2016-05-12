<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'SurveyKondisiTepiJalan.rmd.php';

class SurveyKondisiTepiJalanContent extends CommonGridContent{

	public function SurveyKondisiTepiJalanContent(){
		CommonGridContent::CommonGridContent();
	}
	public function MakeRowModifier(){return new SurveyKondisiTepiJalanRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton(){
		$Par = $this->Parent();
		$m = new InsertSurveyKondisiTepiJalanMenu();
		$m->AddTail(clone($Par));
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
			array('TABLE' => "svy_kondisi_tepi_jalan"),
			array('TABLE'=>"mst_ruas_jalan")
		);
	}
	public function Fields(){
		return array(
			array(
				'FIELD' => "id__mst_ruas_jalan",
				'ALIAS' => "ID Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.nama_ruas",
				'ALIAS' => "Nama Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "DT_IndonesiaDateTime(timestamp)",
				'ALIAS' => "Waktu Survey",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "post",
				'ALIAS' => "Kilometer Awal",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "offset",
				'ALIAS' => "Kilometer Akhir",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_lajur.nama
					FROM mst_lajur
					WHERE
						mst_lajur.id = svy_kondisi_tepi_jalan.id__mst_lajur
				)",
				'ALIAS' => "Lajur",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_kondisi_tepi_jalan.lebar",
				'ALIAS' => "Lebar",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_jenis_bahu.nama
					FROM mst_jenis_bahu
					WHERE
						svy_kondisi_tepi_jalan.id__mst_jenis_bahu = mst_jenis_bahu.id 
				)",
				'ALIAS' => "Jenis Bahu",
				'IS_HIDDEN' => false,
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_kondisi_jalan.nama
					FROM mst_kondisi_jalan
					WHERE
						id__mst_kondisi_jalan = mst_kondisi_jalan.id
				)",
				'ALIAS' => "Kondisi Jalan",
				'IS_HIDDEN' => false,
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "id__mst_lajur",
				'ALIAS' => "IDLajur _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "UNIX_TIMESTAMP(timestamp)",
				'ALIAS' => "UnixTimeSurvey _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "timestamp",
				'ALIAS' => "WaktuSurvey _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "post",
				'ALIAS' => "Post _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "offset",
				'ALIAS' => "OffSet _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			)	
		);
	}
	public function Conditions(){
		return array(
			array(
				'CONDITION' => "mst_ruas_jalan.id = svy_kondisi_tepi_jalan.id__mst_ruas_jalan",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "mst_ruas_jalan.id__mst_propinsi IN (
									SELECT 
										id 
									FROM 
										mst_propinsi 
									WHERE id__mst_balaibesar = '".$_SESSION[FrameworkSessionConstant::IdBidang]."')",
				'OPERATOR' => NULL
			)
		);
  	}}

?>