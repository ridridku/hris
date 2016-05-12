<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'GridDataReferencePoint.rmd.php';

class GridDataReferencePointContent extends CommonGridContent{
	public function GridDataReferencePointContent(){CommonGridContent::CommonGridContent();}
	public function MakeRowModifier(){return new GridDataReferencePointRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}
	public function LinksButton(){
		$p = $this->Parent();
		$m = new InsertDataReferencePointMenu();
		$m->AddTail(clone($p));
		$Link = array();
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Tambah';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		return $Link;
	}
	public function TitleString(){return NULL;}
	public function OrderBy(){
		return array(
			array(
				'ORDER' => "mst_ruas_jalan.nama_ruas",
				'DIRECTION' => 'ASC'
			),
			array(
				'ORDER' => "svy_ruas_jalan.time_stamp",
				'DIRECTION' => 'ASC'
			)
		);
	}
	public function GroupBy(){return array();}
	
	public function Tables(){
		return array(
			array('TABLE' => 'svy_drp_ruas_jalan'),
			array('TABLE' => 'mst_ruas_jalan'),
			array('TABLE' => 'svy_ruas_jalan')
		);
	}
	
	public function Fields(){
		$Par = $this->Parent();
		$fields = array(
			array(
				'FIELD' => "mst_ruas_jalan.nama_ruas",
				'ALIAS' => "Ruas Jalan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.time_stamp",
				'ALIAS' => "Waktu Survey",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "CONCAT(svy_drp_ruas_jalan.post,'.',svy_drp_ruas_jalan.offset)",
				'ALIAS' => "Kilometer",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.gps_lat",
				'ALIAS' => "Latitude",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.gps_lon",
				'ALIAS' => "Longitude",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.gps_alt",
				'ALIAS' => "Altitude [m]",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.gps_elev",
				'ALIAS' => "Elev",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.id__mst_ruas_jalan",
				'ALIAS' => "id loc road _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan.time_stamp",
				'ALIAS' => "svy time stamp _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "UNIX_TIMESTAMP(svy_drp_ruas_jalan.time_stamp)",
				'ALIAS' => "svy unix time stamp _HIDE_",
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
		
		return $fields;
	}	

	public function Conditions(){
		$p = $this->Parent();
		$conditions = array(					
			array(
				'CONDITION' => "svy_drp_ruas_jalan.id__mst_ruas_jalan = mst_ruas_jalan.id",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_ruas_jalan.id__mst_ruas_jalan = svy_drp_ruas_jalan.id__mst_ruas_jalan",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "mst_ruas_jalan.id__mst_propinsi IN (
									SELECT 
										id 
									FROM 
										mst_propinsi 
									WHERE id__mst_balaibesar = '".$_SESSION[FrameworkSessionConstant::IdBidang]."')",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_ruas_jalan.time_stamp = svy_drp_ruas_jalan.time_stamp",
				'OPERATOR' => NULL
			)
		);
		
		return $conditions;
	}
}
?>