<?php
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'LoginAdm.rmd.php';

class LoginAdmContent extends CommonGridContent{

	public function LoginAdmContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new LoginAdmRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton(){
		$Par = $this->Parent();		
		$m = new InsertLoginMenu();
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
			array('TABLE' => "sys_login"),
			array('TABLE' => "sys_group"),
			array('TABLE' => "sys_operator")
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "sys_login.user_name",
				'ALIAS' => "Nama User",
				'IS_SEARCHED' => true,
			),
			array(
				'FIELD' => "sys_group.nama",
				'ALIAS' => "Group",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_operator.name",
				'ALIAS' => "Nama Operator",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_login.id_group",
				'ALIAS' => "Id Group _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			),
			array(
				'FIELD' => "sys_login.id__sys_operator",
				'ALIAS' => "Nip _HIDE_",
				'IS_HIDDEN' => true,
				'IS_SEARCHED' => false
			)
		);
	}

	public function Conditions(){
		return array(
			array(
				'CONDITION' => "sys_login.id__sys_operator = sys_operator.id",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "sys_login.id_group = sys_group.id",
				'OPERATOR' => NULL
			)

		);
	}
}
?>