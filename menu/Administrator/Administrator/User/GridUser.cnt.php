<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'GridUser.rmd.php';

class GridUserContent extends CommonGridContent
{
	public function GridUserContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new GridUserRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertUserMenu($p->Kode);
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
			array('TABLE' => "sys_operator")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "sys_operator.id",
				'ALIAS' => "NIP",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_operator.name",
				'ALIAS' => "Nama",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_operator.address",
				'ALIAS' => "Alamat",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_operator.telp",
				'ALIAS' => "Telepon",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_operator.email",
				'ALIAS' => "Email",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "sys_operator.sms",
				'ALIAS' => "SMS",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_balaibesar.nama 
					FROM mst_balaibesar 
					WHERE mst_balaibesar.id = sys_operator.id_mst_balaibesar)",
				'ALIAS' => "Bidang",
				'IS_SEARCHED' => true
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