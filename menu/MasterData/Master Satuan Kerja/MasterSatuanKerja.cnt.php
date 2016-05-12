<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'MasterSatuanKerja.rmd.php';

class MasterSatuanKerjaContent extends CommonGridContent
{
	public function MasterSatuanKerjaContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new MasterSatuanKerjaRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}
	public function RowPerPage(){
		$rowPerPage = floor(($_SESSION[FrameworkSessionConstant::WindowOuterHeight] - (160 + 63)) / 18);
		return $rowPerPage;
	}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertMasterSatuanKerjaMenu($p->Kode);
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
			array('TABLE' => "mst_satker")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Kode",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.nama",
				'ALIAS' => "Nama",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.alamat",
				'ALIAS' => "Alamat",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT nama FROM mst_propinsi
					WHERE
						mst_satker.id__mst_propinsi = mst_propinsi.id
				)",
				'ALIAS' => "Propinsi",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.email",
				'ALIAS' => "Email",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.telp",
				'ALIAS' => "Telp",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.fax",
				'ALIAS' => "Fax",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_tahun_anggaran.nama
					FROM mst_tahun_anggaran
					WHERE
						mst_satker.id__mst_tahun_anggaran = mst_tahun_anggaran.id							 
				)",
				'ALIAS' => "Tahun Anggaran",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.nama_ketua",
				'ALIAS' => "Ketua",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.nip_ketua",
				'ALIAS' => "NIP Ketua",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.nama_bendahara",
				'ALIAS' => "Bendahara",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.nip_bendahara",
				'ALIAS' => "NIP Bendahara",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.nama_atasan",
				'ALIAS' => "Atasan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.nip_atasan",
				'ALIAS' => "NIP Atasan",
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