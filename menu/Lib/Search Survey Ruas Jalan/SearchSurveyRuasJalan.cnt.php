<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'SearchSurveyRuasJalan.rmd.php';

class SearchSurveyRuasJalanContent extends CommonGridContent{

	public function SearchSurveyRuasJalanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new SearchSurveyRuasJalanRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}
	public function LinksButton(){return NULL;} 
 	public function TitleString(){return NULL;}
	public function OrderBy(){return array();}
	public function GroupBy(){return array();}
	public function Tables(){
		return array(
			array('TABLE' => "`svy_ruas_jalan`"),
			array('TABLE' => "`mst_ruas_jalan`")
		);
	}
	public function Fields(){
		return array(
			array(
				'FIELD' => "svy_ruas_jalan.id__mst_ruas_jalan",
				'ALIAS' => "ID Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "`mst_ruas_jalan`.nama_ruas",
				'ALIAS' => "Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "time_stamp",
				'ALIAS' => "Waktu Survey",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "deskripsi",
				'ALIAS' => "Deskripsi",
				'IS_SEARCHED' => true
			)
		);
	}
	public function Conditions(){
		return array(
			array(
				'CONDITION' => "`mst_ruas_jalan`.id = `svy_ruas_jalan`.id__mst_ruas_jalan",
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
	}
}
?>