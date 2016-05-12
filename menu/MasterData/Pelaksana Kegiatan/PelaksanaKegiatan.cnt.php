<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'PelaksanaKegiatan.rmd.php';

class PelaksanaKegiatanContent extends CommonGridContent
{
	public function PelaksanaKegiatanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new PelaksanaKegiatanRowModifier();}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$Par = $this->Parent();		
		$m = new InsertPelaksanaKegiatanMenu($p->Kode);
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
			array('TABLE' => "mst_pelaksana_kegiatan")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "mst_pelaksana_kegiatan.id__mst_satker",
				'ALIAS' => "ID Satuan Kerja",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "(
					SELECT mst_tahun_anggaran.nama
					FROM mst_tahun_anggaran
					WHERE
						mst_pelaksana_kegiatan.id__mst_tahun_anggaran = mst_tahun_anggaran.id
				)",
				'ALIAS' => "Tahun Anggaran",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_pelaksana_kegiatan.id_pelaksana",
				'ALIAS' => "ID Pelaksana kegiatan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_pelaksana_kegiatan.nama",
				'ALIAS' => "Nama Pelaksana kegiatan",
				'IS_SEARCHED' => true
			),
			array(
				'FIELD' => "mst_pelaksana_kegiatan.id__mst_tahun_anggaran",
				'ALIAS' => "ID Tahun Anggaran _HIDE_",
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