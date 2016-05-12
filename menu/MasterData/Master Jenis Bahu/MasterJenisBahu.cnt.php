<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterJenisBahu.rmd.php';

class MasterJenisBahuContent extends CommonGridContent{
	public function MasterJenisBahuContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new MasterJenisBahuRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}
	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertMasterJenisBahuMenu();
		$m->AddTail(clone($Par));
		$Link = array();
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Tambah';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
		return $Link;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){
		return array(
			array( 'ORDER'=>'mst_jenis_bahu.id',
				   'DIRECTION'=>'DESC'				
			),
			array( 'ORDER'=>'mst_jenis_bahu.id__mst_bahu_group',
				   'DIRECTION'=>'DESC'				
			)
		);
	}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "mst_jenis_bahu")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "mst_jenis_bahu.nama",
				'ALIAS' => "Nama Jenis Bahu",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_bahu_group.nama
					FROM mst_bahu_group
					WHERE
						mst_jenis_bahu.id__mst_bahu_group = mst_bahu_group.id
				)",
				'ALIAS' => "Nama Bahu",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_jenis_bahu.id",
				'ALIAS' => "ID Jenis Bahu",
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