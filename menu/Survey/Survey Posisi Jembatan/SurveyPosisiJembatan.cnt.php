<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'SurveyPosisiJembatan.rmd.php';

class SurveyPosisiJembatanContent extends CommonGridContent{

	public function SurveyPosisiJembatanContent(){
		CommonGridContent::CommonGridContent();
	}
	public function MakeRowModifier(){return new SurveyPosisiJembatanRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton(){
		$Par = $this->Parent();		
		
		$m = new InsertSurveyPosisiJembatanMenu();
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
			array('TABLE' => "svy_posisi_jembatan"),
			array('TABLE' => "mst_ruas_jalan")
		);
	}
	public function Fields(){
		return array(
			array(
				'FIELD' => "svy_posisi_jembatan.id_mst_bridge",
				'ALIAS' => "ID Jembatan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_bridge.nama
					FROM mst_bridge
					WHERE
						svy_posisi_jembatan.id_mst_bridge = mst_bridge.id
				)",
				'ALIAS' => "Nama Jembatan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_posisi_jembatan.id__mst_ruas_jalan",
				'ALIAS' => "ID Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.nama_ruas",
				'ALIAS' => "Nama Ruas",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "DT_IndonesiaDateTime(svy_posisi_jembatan.timestamp)",
				'ALIAS' => "Waktu Survey",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "CONCAT(svy_posisi_jembatan.post,'.',svy_posisi_jembatan.offset)",
				'ALIAS' => "Kilometer",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "CONCAT(svy_posisi_jembatan.span,' (m)')",
				'ALIAS' => "SPAN",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "CONCAT(svy_posisi_jembatan.width,' (m) ')",
				'ALIAS' => "WIDTH",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "CONCAT(svy_posisi_jembatan.free_board,' (m)')",
				'ALIAS' => "FREEBOARD",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT 
						singkatan
					FROM
						mst_required
					WHERE
						mst_required.id = svy_posisi_jembatan.deck)",
				'ALIAS' => "DECK",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT 
						singkatan
					FROM
						mst_required
					WHERE
						mst_required.id =svy_posisi_jembatan.beams)",
				'ALIAS' => "BEAMS",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT 
						singkatan
					FROM
						mst_required
					WHERE
						mst_required.id  = svy_posisi_jembatan.side_rails)",
				'ALIAS' => "SIDERAILS",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT 
						singkatan
					FROM
						mst_required
					WHERE
						mst_required.id = svy_posisi_jembatan.abutment)",
				'ALIAS' => "ABUTMENT",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT 
						singkatan
					FROM
						mst_required
					WHERE
						mst_required.id = svy_posisi_jembatan.foundation)",
				'ALIAS' => "FOUNDATION",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT 
						singkatan
					FROM
						mst_required
					WHERE
						mst_required.id =svy_posisi_jembatan.pavement)",
				'ALIAS' => "PAVEMENT",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_posisi_jembatan.id_mst_bridge",
				'ALIAS' => "IDJembatan _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "svy_posisi_jembatan.id__mst_ruas_jalan",
				'ALIAS' => "IDRuas _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "UNIX_TIMESTAMP(svy_posisi_jembatan.timestamp)",
				'ALIAS' => "UnixTimeSurvey _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "svy_posisi_jembatan.timestamp",
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
				'CONDITION' => "svy_posisi_jembatan.id__mst_ruas_jalan = mst_ruas_jalan.id",
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