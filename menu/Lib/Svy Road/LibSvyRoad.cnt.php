<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'LibSvyRoad.rmd.php';

class LibSvyRoadContent extends CommonGridContent{
	public function LibSvyRoadContent(){CommonGridContent::CommonGridContent();}
	public function MakeRowModifier(){return new LibSvyRoadRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}
	public function LinksButton(){
		return NULL;
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
			array('TABLE' => 'svy_ruas_jalan'),
			array('TABLE' => 'mst_ruas_jalan')
		);
	}
	
	public function Fields(){
		$p = $this->Parent();
		$fields = array(
			array(
				'FIELD' => "mst_ruas_jalan.nama_ruas",
				'ALIAS' => "Ruas Jalan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_ruas_jalan.time_stamp",
				'ALIAS' => "Waktu Survey",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_ruas_jalan.id",
				'ALIAS' => "id loc road _HIDE_",
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
				'CONDITION' => "svy_ruas_jalan.id__mst_ruas_jalan = mst_ruas_jalan.id",
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
		return $conditions;
	}
}
?>