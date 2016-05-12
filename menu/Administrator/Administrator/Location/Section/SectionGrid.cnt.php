<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'SectionGrid.rmd.php';

class SectionGridContent extends CommonGridContent{

	public function SectionGridContent(){
		CommonGridContent::CommonGridContent();
	}
	public function MakeRowModifier(){return new SectionGridRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton(){
		$Par = $this->Parent();		
		
		$m = new InsertSectionMenu();
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
			array('TABLE' => "loc_section")
		);
	}
	public function Fields(){
		return array(
			array(
				'FIELD' => "loc_section.id",
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
								loc_city.name								
							FROM loc_city
							WHERE
								loc_city.id = loc_section.id_loc_city)",
				'ALIAS' => "City",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "loc_section.id",
				'ALIAS' => "IdSection _HIDE_",
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