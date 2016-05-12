<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterPropinsi.rmd.php';

class MasterPropinsiContent extends CommonGridContent
{
	public function MasterPropinsiContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new MasterPropinsiRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertMasterPropinsiMenu($p->Kode);
		$Link = array();
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Tambah';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		return $Link;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){
		return array(
			array(
				'ORDER'=>'mst_propinsi.id',
				'DIRECTION'=>'DESC'
			)
		);
	
	}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "mst_propinsi")		
		);
	}

	public function Fields(){
		return array(
			
			array(
				'FIELD' => "mst_propinsi.nama",
				'ALIAS' => "Nama",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT nama FROM mst_balaibesar
					WHERE
						mst_propinsi.id__mst_balaibesar = mst_balaibesar.id
				)",
				'ALIAS' => "Balai Besar",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_propinsi.id",
				'ALIAS' => "Kode",
				'IS_SEARCHED' => false,
				'IS_HIDDEN'=>true,
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