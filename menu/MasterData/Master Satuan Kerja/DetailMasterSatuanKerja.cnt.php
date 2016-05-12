<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterSatuanKerja.cnt.php';

class DetailMasterSatuanKerjaContent extends MasterSatuanKerjaContent{
	public function MasterSatuanKerjaContent(){
		MasterSatuanKerjaContent::MasterSatuanKerjaContent();
	}
	public function Conditions(){
		$Par = $this->Parent();
		return array(
			array(
				'CONDITION' => "mst_satker.id = '". $Par->Kode ."'",
				'OPERATOR' => NULL
			)
		);
  	}		  
}
?>