<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'LaporanPosisiJembatan.rmd.php';

class LaporanPosisiJembatanContent extends CommonGridContent
{
	public function LaporanPosisiJembatanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new LaporanPosisiJembatanRowModifier();}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		
		$Gui = $p->MakeGuiFactory();
		$f = $Gui->MakeForm();
		
		
		$r = $Gui->MakeSubTitle();
		$r->TextToDisplay = 'Filter';
		$f->AddRowElement($r);
		
		$r = $Gui->MakeComboBox();
		$r->Name = 'tanggal_survey';
		$r->TextToDisplay = 'Tanggal Survey';
		$r->ItemSelected = $p->Time;
		$r->FromQuery($db,"
			SELECT 
				svy_ruas_jalan.time_stamp AS id, 
				svy_ruas_jalan.time_stamp AS name 
			FROM 
				 svy_ruas_jalan 
			WHERE
				svy_ruas_jalan.id__mst_ruas_jalan = '".$p->IdRuasJalan."' AND
				svy_ruas_jalan.time_stamp IN(
					SELECT timestamp 
					FROM svy_posisi_jembatan
					WHERE id__mst_ruas_jalan = '".$p->IdRuasJalan."'
				)
			GROUP BY name
		");
		$r->Mandatory = true;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);	
		
		
		
		$r = $Gui->MakeBottomButton();
		$f->AddRowElement($r);
		
		$f->Action = new LaporanPosisiJembatanHandlerMenu();
		$f->Action->IdPropinsi = $p->IdPropinsi;
		$f->Action->IdRuasJalan = $p->IdRuasJalan;

		$f->Action->Next = new LaporanPosisiJembatanMenu();
		

		
		echo '<table align="left" width="100%" border="0" cellspacing="0" cellpadding="0">';
		echo '<tr><td>';
		echo '</td></tr>';
		echo '<tr><td>';
		echo '</td></tr>';
		echo '<tr><td>';
		$f->Display($p, $v);
		echo '</td></tr>';
		echo '<tr><td>';
		CommonGridContent::Show($v);
		echo '</td></tr>';
		echo '</table>';
	}
  	public function Path(){return __FILE__;}
	public function IsHaveScrollBar(){return false;}
	public function ScrollBarWidth(){return 0;}
	public function IsHaveSearch(){return true;}
	public function IsHavePaging(){return true;}
	public function IsHaveDownload(){return true;}

	public function LinksButton() {
		$p = $this->Parent();
		$db = $p->MakeDatabase();
			
		$Link = array();
		$m = new LaporanPosisiJembatanMenu();
		$m->IdPropinsi = $p->IdPropinsi;				
		$m->IdRuasJalan = $p->IdRuasJalan;
		$m->Time  = $p->Time ;
		$Grafik = new GrafikJembatanPosisiMenu();
		$Grafik->IdPropinsi = $p->IdPropinsi;				
		$Grafik->IdRuasJalan = $p->IdRuasJalan;
		$Grafik->Time  = $p->Time ;
		$m->AddTail($Grafik);

		$Link[0][RowModifierConstant::BottomLink__Name] = 'Grafik';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
#		$Link[0][RowModifierConstant::BottomLink__NewWindow] = true;


		$cetak = new GrafikJembatanPosisiMenu();
		$cetak->IdPropinsi = $p->IdPropinsi;	
		$cetak->IdRuasJalan = $p->IdRuasJalan;
		$cetak->Time  = $p->Time ;
		$cetak->Cetak = true;
		$Link[1][RowModifierConstant::BottomLink__Name] = 'Cetak';
		$Link[1][RowModifierConstant::BottomLink__RefLink] = $cetak->Ref();
		$Link[1][RowModifierConstant::BottomLink__NewWindow] = true;
		
		return $Link;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){return array();}
	public function GroupBy(){return array();}
	public function Tables(){
		return array(
			array('TABLE' => "mst_bridge"),
			array('TABLE' => "svy_posisi_jembatan"),
			array('TABLE' => "mst_ruas_jalan"),
					
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "svy_posisi_jembatan.id_mst_bridge",
				'ALIAS' => "Kode Jembatan ",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "mst_bridge.nama",
				'ALIAS' => "Nama Jembatan",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "CONCAT('Km.',svy_posisi_jembatan.post,'.',svy_posisi_jembatan.offset)",
				'ALIAS' => "Km. Lokasi ",
				'IS_SEARCHED' => TRUE
			)/*,
			array(
				'FIELD' => "(SELECT mst_propinsi.nama
							 FROM mst_ruas_jalan, mst_propinsi
							 WHERE
							 	svy_posisi_jembatan.id__mst_ruas_jalan  = mst_ruas_jalan.id AND
								mst_ruas_jalan.id__mst_propinsi = mst_propinsi.id
				)",
				'ALIAS' => "Propinsi",
				'IS_SEARCHED' => TRUE
			)*/,
			array(
				'FIELD' => "(SELECT 
								name 
							 FROM 
							 	mst_kabupaten_or_kodya
							 WHERE
								mst_bridge.id_mst_kabupaten_or_kodya = mst_kabupaten_or_kodya.id
				)",
				'ALIAS' => "Kabupaten",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "(SELECT 
								mst_type_bridge.nama 
							 FROM 
							 	mst_type_bridge 
							 WHERE 
								mst_type_bridge.id = mst_bridge.id_mst_type_bridge
				)",
				'ALIAS' => "Type Jembatan ",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "mst_bridge.bentang",
				'ALIAS' => "Jumlah Bentang",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "mst_bridge.keterangan",
				'ALIAS' => "Keterangan",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "mst_bridge.tahun_bangun",
				'ALIAS' => "Tahun Bangun",
				'IS_SEARCHED' => TRUE
			),			
			array(
				'FIELD' => "svy_posisi_jembatan.id__mst_ruas_jalan",
				'ALIAS' => "IdRuasJalan _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_posisi_jembatan.timestamp",
				'ALIAS' => "Time _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_posisi_jembatan.post",
				'ALIAS' => "Post _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_posisi_jembatan.offset",
				'ALIAS' => "OffSet _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			)
		);	
	}

	public function Conditions(){
		$p = $this->Parent();
		return array(
			array(
				'CONDITION' => "svy_posisi_jembatan.id__mst_ruas_jalan = mst_ruas_jalan.id",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "mst_ruas_jalan.id__mst_propinsi = '".$p->IdPropinsi."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_posisi_jembatan.timestamp = '".$p->Time."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_posisi_jembatan.id__mst_ruas_jalan = '".$p->IdRuasJalan."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_posisi_jembatan.id_mst_bridge = mst_bridge.id",
				'OPERATOR' =>  NULL
			)
		);
  	}			  
}
?>