<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'LocationRoad.rmd.php';

class LocationRoadContent extends CommonGridContent
{
	public function LocationRoadContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new LocationRoadRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertLocRoadMenu($p->IdRoad);
		$m->AddTail(clone($Par));

		$Link = array();
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Insert';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		return $Link;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){return array();}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "loc_road")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "loc_road.id",
				'ALIAS' => "Kode",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "loc_road.name",
				'ALIAS' => "Name",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								loc_section.name								
							FROM loc_section
							WHERE
								loc_section.id = loc_road.id_loc_section)",
				'ALIAS' => "Name Section",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								loc_city.name								
							FROM loc_city
							WHERE
								loc_city.id = loc_road.id_loc_city_from)",
				'ALIAS' => "From City",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								loc_city.name								
							FROM loc_city
							WHERE
								loc_city.id = loc_road.id_loc_city_to)",
				'ALIAS' => "To City",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								rod_status.name								
							FROM rod_status
							WHERE
								rod_status.id = loc_road.id_rod_status)",
				'ALIAS' => "Status",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								rod_function.name								
							FROM rod_function
							WHERE
								rod_function.id = loc_road.id_rod_function)",
				'ALIAS' => "Fungsi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "loc_road.id",
				'ALIAS' => "IdRoad _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			)
		);	
	}

	public function Conditions(){
		return array(
			array(
				'CONDITION' => "True",
				'OPERATOR' => NULL
			)
		);
  	}		  
}
?>