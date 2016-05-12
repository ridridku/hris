<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'LaporanDeskripsiRuasJalan.rmd.php';


class LaporanDeskripsiRuasJalanContent extends CommonGridContent
{
	public function LaporanDeskripsiRuasJalanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new LaporanDeskripsiRuasJalanRowModifier();}
	public function Show(ValidatorInterface $v){
		$p = $this->Parent();
		$db = $p->MakeDatabase();
		
		$Gui = $p->MakeGuiFactory();
		$f = $Gui->MakeForm();
		$f->FormName = 'form_laporan';
		
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
				svy_ruas_jalan.id__mst_ruas_jalan = '".$p->IdRuasJalan."'AND
				svy_ruas_jalan.time_stamp IN(
					SELECT timestamp 
					FROM svy_deskripsi_ruas_jalan
					WHERE id__mst_ruas_jalan = '".$p->IdRuasJalan."'
				)
			GROUP BY name
		");
		$r->Mandatory = true;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
	
		$r = $Gui->MakeBottomButton();
		$f->AddRowElement($r);
		
		$f->Action = new LaporanDeskripsiRuasJalanHandlerMenu();
		$f->Action->IdPropinsi = $p->IdPropinsi;
		$f->Action->IdRuasJalan = $p->IdRuasJalan;
		
		$f->Action->Next = new LaporanDeskripsiRuasJalanMenu();
		
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
		$m = new LaporanDeskripsiRuasJalanMenu();
		$m->IdPropinsi = $p->IdPropinsi;				
		$m->IdRuasJalan = $p->IdRuasJalan;
		$m->Time  = $p->Time ;		
		
		$Grafik = new GrafikDeskripsiRuasJalanMenu();
		$Grafik->IdRuasJalan = $p->IdRuasJalan;
		$Grafik->Waktu  = $p->Time ;
		$Grafik->Cetak = false;
		$m->AddTail($Grafik);
		
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Grafik';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
#		$Link[0][RowModifierConstant::BottomLink__NewWindow] = true;
		
		
		
		$cetak = new GrafikDeskripsiRuasJalanMenu();
		$cetak->IdRuasJalan = $p->IdRuasJalan;
		$cetak->Waktu  = $p->Time ;
		$cetak->Cetak = true;
		$Link[1][RowModifierConstant::BottomLink__Name] = 'Cetak';
		$Link[1][RowModifierConstant::BottomLink__RefLink] = $cetak->Ref();
		$Link[1][RowModifierConstant::BottomLink__NewWindow] = true;
		
		return $Link;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){return array(
	
		);
	}
	public function GroupBy(){return array();}

	public function Tables(){
		return array(
			array('TABLE' => "svy_deskripsi_ruas_jalan"),array('TABLE' => "mst_ruas_jalan")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "CONCAT (svy_deskripsi_ruas_jalan.post,' / ',svy_deskripsi_ruas_jalan.offset)",
				'ALIAS' => "Km Awal / Km Akhir",
				'IS_SEARCHED' => TRUE
			),	
			array(
				'FIELD' => "(SELECT nama
							 FROM mst_lajur
							 WHERE
							 	mst_lajur.id  = svy_deskripsi_ruas_jalan.id__mst_lajur)",
				'ALIAS' => "Lajur ",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "ROUND(svy_deskripsi_ruas_jalan.Lebar,2)",
				'ALIAS' => "Lebar ",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "(SELECT nama
							 FROM mst_jenis_bahu
							 WHERE
							 	mst_jenis_bahu.id  = svy_deskripsi_ruas_jalan.id__mst_jenis_bahu)",
				'ALIAS' => "Bahu ",
				'IS_SEARCHED' => TRUE
			),		
			array(
				'FIELD' => "svy_deskripsi_ruas_jalan.id__mst_ruas_jalan",
				'ALIAS' => "IdRuasJalan _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_deskripsi_ruas_jalan.timestamp",
				'ALIAS' => "Time _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_deskripsi_ruas_jalan.post",
				'ALIAS' => "Post _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_deskripsi_ruas_jalan.offset",
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
				'CONDITION' => "mst_ruas_jalan.id__mst_propinsi = '".$p->IdPropinsi."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_deskripsi_ruas_jalan.id__mst_ruas_jalan = '".$p->IdRuasJalan."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_deskripsi_ruas_jalan.timestamp = '".$p->Time."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_deskripsi_ruas_jalan.id__mst_ruas_jalan =  mst_ruas_jalan.id",
				'OPERATOR' => NULL
			)
		);
  	}		  
}

	
?>