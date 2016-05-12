<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'CityGrid.rmd.php';

class CityGridContent extends CommonGridContent{

	public function CityGridContent(){
		CommonGridContent::CommonGridContent();
	}
	public function MakeRowModifier(){return new CityGridRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton(){
		$Par = $this->Parent();		
		
		$m = new InsertCityMenu();
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
			array('TABLE' => "loc_city")
		);
	}
	public function Fields(){
		return array(
			array(
				'FIELD' => "loc_city.id",
				'ALIAS' => "Kode",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "name",
				'ALIAS' => "Nama",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(SELECT 
								loc_province.name								
							FROM loc_province
							WHERE
								loc_province.id = loc_city.id_loc_province)",
				'ALIAS' => "Propinsi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "loc_city.id",
				'ALIAS' => "IdCity _HIDE_",
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