<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterKota.rmd.php';

class MasterKotaContent extends CommonGridContent
{
	public function MasterKotaContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new MasterKotaRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertMasterKotaMenu($p->Kode);
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
			array('TABLE' => "mst_kota")
		);
	}

	public function Fields(){
		return array(
			
			array(
				'FIELD' => "mst_kota.nama",
				'ALIAS' => "Nama",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT nama FROM mst_propinsi
					WHERE
						mst_kota.id__mst_propinsi = mst_propinsi.id
				)",
				'ALIAS' => "Propinsi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_kota.id",
				'ALIAS' => "Kode",
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