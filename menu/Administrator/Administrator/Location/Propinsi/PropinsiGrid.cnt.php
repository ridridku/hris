<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'PropinsiGrid.rmd.php';

class PropinsiGridContent extends CommonGridContent{

	public function PropinsiGridContent(){
		CommonGridContent::CommonGridContent();
	}
	public function MakeRowModifier(){return new PropinsiGridRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton(){
		$Par = $this->Parent();		
		
		$m = new InsertPropinsiMenu();
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
			array('TABLE' => "mst_propinsi")
		);
	}
	public function Fields(){
		return array(
			array(
				'FIELD' => "mst_propinsi.id",
				'ALIAS' => "Kode",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_propinsi.nama",
				'ALIAS' => "Nama",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_balaibesar.nama								
					FROM mst_balaibesar
					WHERE
						mst_balaibesar.id = mst_propinsi.id__mst_balaibesar)",
				'ALIAS' => "Balai Besar",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_propinsi.id",
				'ALIAS' => "IdPropinsi _HIDE_",
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