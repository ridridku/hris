<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'PaketKegiatan.rmd.php';

class PaketKegiatanContent extends CommonGridContent
{
	public function PaketKegiatanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new PaketKegiatanRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return true;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertPaketKegiatanMenu($p->Kode);
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
				'ALIAS' => "Paket ID",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Tahun Anggaran",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Nama Paket",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Jenis Pekerjaan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Tipe Kontrak",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Panjang Efektif",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Panjang Fungsional",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Dana APBN",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Dana PLN",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Adendum APBN",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Adendum PLN",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Pinjaman Luar Negeri",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Nomor",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Nomor Kontrak",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Tanggal Kontrak",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Nilai Kontrak",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Tanggal SPMK",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Masa Pelaksana",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Masa Pemeliharaan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Tanggal PHO",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Tanggal FHO",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.id",
				'ALIAS' => "Konsultan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_satker.nama",
				'ALIAS' => "Kontraktor",
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