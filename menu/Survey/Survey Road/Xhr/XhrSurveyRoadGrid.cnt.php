<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'XhrSurveyRoadGrid.rmd.php';

class XhrSurveyRoadGridContent extends CommonGridContent{

	public function XhrSurveyRoadGridContent(){
		CommonGridContent::CommonGridContent();
	}
	public function MakeRowModifier(){return new XhrSurveyRoadGridRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}
	public function RowPerPage(){return 3;}

	public function LinksButton(){
		$Par = $this->Parent();		
		
		$m = new InsertSurveyRoadMenu();
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
			array('TABLE' => "svy_road")
		);
	}
	public function Fields(){
		return array(
			array(
				'FIELD' => "(SELECT 
								loc_road.name								
							FROM loc_road
							WHERE
								loc_road.id = svy_road.id_loc_road)",
				'ALIAS' => "Road",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "time_stamp",
				'ALIAS' => "Time Survey",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								sys_operator.name								
							FROM sys_operator
							WHERE
								sys_operator.id = svy_road.id_sys_operator)",
				'ALIAS' => "Operator",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								uni_distance.name								
							FROM uni_distance
							WHERE
								uni_distance.id = svy_road.id_uni_distance_road)",
				'ALIAS' => "Distance Road[Km]",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								uni_distance.name								
							FROM uni_distance
							WHERE
								uni_distance.id = svy_road.id_uni_speed_vehicle)",
				'ALIAS' => "Speed Vehicle[Km]",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								uni_distance.name								
							FROM uni_distance
							WHERE
								uni_distance.id = svy_road.id_uni_distance_chainage)",
				'ALIAS' => "Chainage[Km]",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								uni_distance.name								
							FROM uni_distance
							WHERE
								uni_distance.id = svy_road.id_uni_distance_length)",
				'ALIAS' => "Length[Km]",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								uni_distance.name								
							FROM uni_distance
							WHERE
								uni_distance.id = svy_road.id_uni_distance_altitude)",
				'ALIAS' => "Altitude[m]",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "svy_road.id_loc_road",
				'ALIAS' => "IdLocRoad _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "svy_road.time_stamp",
				'ALIAS' => "TimeStamp _HIDE_",
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
  	}}

?>