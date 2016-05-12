<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterKabupaten.rmd.php';

class MasterKabupatenContent extends CommonGridContent
{
	public function MasterKabupatenContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new MasterKabupatenRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertMasterKabupatenMenu();
		$m->AddTail(clone($Par));
		$Link = array();
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Tambah';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		return $Link;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){return array(
			array('ORDER'=>'mst_kabupaten_or_kodya.id',
				  'DIRECTION'=>'DESC'
				
			)
		);
	}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "mst_kabupaten_or_kodya")		
		);
	}

	public function Fields(){
		return array(
			
			array(
				'FIELD' => "mst_kabupaten_or_kodya.name",
				'ALIAS' => "Nama",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT nama FROM mst_propinsi
					WHERE
						mst_kabupaten_or_kodya.id_mst_propinsi = mst_propinsi.id
				)",
				'ALIAS' => "Propinsi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_kabupaten_or_kodya.id",
				'ALIAS' => "Kode",
				'IS_SEARCHED' => false,
				'IS_HIDDEN'=>true
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