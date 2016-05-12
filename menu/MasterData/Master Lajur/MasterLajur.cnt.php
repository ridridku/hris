<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterLajur.rmd.php';

class MasterLajurContent extends CommonGridContent{
	public function MasterLajurContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new MasterLajurRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}
	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertMasterLajurMenu();
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
			array('TABLE' => "mst_lajur")		
		);
	}

	public function Fields(){
		return array(			
			array(
				'FIELD' => "mst_lajur.nama",
				'ALIAS' => "Nama Lajur",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_lajur.deskripsi",
				'ALIAS' => "Keterangan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_lajur.order",
				'ALIAS' => "Order",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_lajur.id",
				'ALIAS' => "ID Lajur",
				'IS_SEARCHED' => false,
				'IS_HIDDEN' => true
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