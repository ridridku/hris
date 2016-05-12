<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'ConfigGroup.rmd.php';

class ConfigGroupContent extends CommonGridContent
{

	public function ConfigGroupContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new ConfigGroupRowModifier();}
	public function MakeRowFilter(){return NULL;}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton(){
		$Par = $this->Parent();  	
		$m = new InsertConfigMenu();
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
			),
			array(
				'ORDER' => "MISC_OrderIndeks(sys_menu.id)",
				'DIRECTION' => 'ASC'
			),
			array(
				'ORDER' => "IF(sys_menu_group.order_index IS NULL, 0, sys_menu_group.order_index)",
				'DIRECTION' => 'ASC'
			)

		);
	}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "sys_menu"),
			array('TABLE' => "sys_menu_group"),
			array('TABLE' => "sys_group")
		);
	}
	
	public function Fields(){
		return array(
			array(
				'FIELD' => "sys_group.nama",
				'ALIAS' => "Group",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "MISC_OrderIndeks(sys_menu.id)",
				'ALIAS' => "Order 3",
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "IF(sys_menu_group.order_index IS NULL, 0, sys_menu_group.order_index)",
				'ALIAS' => "Order 1",
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "sys_menu_group.id__sys_group",
				'ALIAS' => "IdGroup _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "sys_menu.description",
				'ALIAS' => "Menu Description _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_menu_group.is_active",
				'ALIAS' => "IsActive _HIDE_",
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
				'FIELD' => "sys_menu_group.id__sys_parent",
				'ALIAS' => "ParentId _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "sys_menu.object",
				'ALIAS' => "Object _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			)
		);
	}

	public function Conditions(){
		return array(
			array(
				'CONDITION' => "sys_menu.id = sys_menu_group.id__sys_menu",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "sys_group.id = sys_menu_group.id__sys_group",
				'OPERATOR' => NULL
			)
		);
	}
}
?>