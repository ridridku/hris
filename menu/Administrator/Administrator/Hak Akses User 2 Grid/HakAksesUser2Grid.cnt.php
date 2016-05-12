<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'HakAksesUser2Grid.rmd.php';
require_once Framework::ThisFolder(__FILE__) . 'HakAksesUser2Grid.rft.php';

class HakAksesUser2GridContent extends CommonGridContent{
	
	public function HakAksesUser2GridContent(){
		CommonGridContent::CommonGridContent();
	}
	public function MakeRowModifier(){return new HakAksesUser2GridRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return false;}
	public function LinksButton(){
		$Par = $this->Parent();
	
		$m = new InsertHakAksesUser2GridMenu();
		$m->AddTail(clone($Par));
		$Link = array();
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Tambah';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		return $Link;
	}
	
	public function TitleString(){return NULL;}
	public function OrderBy(){
		return array(
			array(
				'ORDER' => "sys_group.nama",
				'DIRECTION' => 'ASC'
			) 
		);
	}
	public function GroupBy(){return array();}
	
	public function Tables(){
		return array(
			array('TABLE' => 'sys_data_grid'),
			array('TABLE' => 'sys_menu'),
			array('TABLE' => 'sys_group')
		);
	}
	
	public function Fields(){
		$Par = $this->Parent();				
		$fields = array(
			array(
				'FIELD' => "sys_group.nama",
				'ALIAS' => "Nama Group",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_menu.description",
				'ALIAS' => "Menu Name _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_group.id",
				'ALIAS' => "IdGroup _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "sys_menu.id",
				'ALIAS' => "IdMenu _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "sys_menu.object",
				'ALIAS' => "Object _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "sys_menu.id_menu_class",
				'ALIAS' => "IdMenuClass _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "sys_menu.description",
				'ALIAS' => "Description _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => true
			)

		);
		
		return $fields;
	
	}	

	public function Conditions(){
		$Par = $this->Parent();		
		$conditions = array(					
			array(
				'CONDITION' => "sys_data_grid.id__sys_menu_grid = sys_menu.id_menu_class",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "sys_group.id = sys_data_grid.id__sys_group",
				'OPERATOR' => NULL
			)
		);
		
		return $conditions;	
	
	}
}
?>