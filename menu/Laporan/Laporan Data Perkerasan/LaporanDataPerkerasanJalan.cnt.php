<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'LaporanDataPerkerasanJalan.rmd.php';

class LaporanDataPerkerasanJalanContent extends CommonGridContent
{
	public function LaporanDataPerkerasanJalanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new LaporanDataPerkerasanJalanRowModifier();}
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
					FROM svy_perkerasan_jalan
					WHERE id__mst_ruas_jalan = '".$p->IdRuasJalan."'
				)
			GROUP BY name
		");
		$r->Mandatory = true;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);	
		
		
		$r = $Gui->MakeComboBox();
		$r->TextToDisplay = 'Lajur';
		$r->Name = 'lajur';
		$r->FromQuery($db, "
			SELECT
				id AS id,
				nama AS name
			FROM 
				mst_lajur
			WHERE
				id IN('1','2','3','4')
			
		");
		$r->ItemSelected  = $p->IdLajur;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
		
		$r = $Gui->MakeBottomButton();
		$f->AddRowElement($r);
		
		$f->Action = new LaporanDataPerkerasanJalanHandlerMenu();
		$f->Action->IdPropinsi = $p->IdPropinsi;
		$f->Action->IdRuasJalan = $p->IdRuasJalan;

		$f->Action->Next = new LaporanDataPerkerasanJalanMenu();
		

		
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
		$m = new LaporanDataPerkerasanJalanMenu();
		$m->IdPropinsi = $p->IdPropinsi;				
		$m->IdRuasJalan = $p->IdRuasJalan;
		$m->Time  = $p->Time ;
		$m->IdLajur = $p->IdLajur;
		
		$Grafik = new GrafikDataPerkerasanMenu();
#		$Grafik = new CetakGrafikPerkerasanJalanMenu();		
		$Grafik->IdPropinsi = $p->IdPropinsi;				
		$Grafik->IdRuasJalan = $p->IdRuasJalan;
		$Grafik->Waktu  = $p->Time ;
		$Grafik->IdLajur = $p->IdLajur;
		$Grafik->Cetak = false;
		$m->AddTail($Grafik);
		

		$Link[0][RowModifierConstant::BottomLink__Name] = 'Grafik';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $Grafik->Ref();
#		$Link[0][RowModifierConstant::BottomLink__NewWindow] = true;



#		$cetak = new GrafikDataPerkerasanMenu();
		$cetak = new CetakGrafikPerkerasanJalanMenu();
		$cetak->IdPropinsi = $p->IdPropinsi;				
		$cetak->IdRuasJalan = $p->IdRuasJalan;
		$cetak->Waktu  = $p->Time ;
		$cetak->IdLajur = $p->IdLajur;
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
			array('TABLE' => "svy_perkerasan_jalan"),array('TABLE' => "mst_ruas_jalan")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "CONCAT(svy_perkerasan_jalan.post,' / ',svy_perkerasan_jalan.offset)",
				'ALIAS' => "Km Awal / Km Akhir ",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "(SELECT nama
							 FROM mst_perkerasan
							 WHERE
							 	mst_perkerasan.id  = svy_perkerasan_jalan.id__mst_perkerasan)",
				'ALIAS' => "Jenis Perkerasan",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "svy_perkerasan_jalan.tahun",
				'ALIAS' => "Tahun",
				'IS_SEARCHED' => TRUE
			),			
			array(
				'FIELD' => "svy_perkerasan_jalan.id__mst_ruas_jalan",
				'ALIAS' => "IdRuasJalan _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_perkerasan_jalan.timestamp",
				'ALIAS' => "Time _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_perkerasan_jalan.post",
				'ALIAS' => "Post _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_perkerasan_jalan.offset",
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
				'CONDITION' => "svy_perkerasan_jalan.id__mst_ruas_jalan = '".$p->IdRuasJalan."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_perkerasan_jalan.timestamp = '".$p->Time."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_perkerasan_jalan.id__mst_lajur = '".$p->IdLajur."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_perkerasan_jalan.id__mst_ruas_jalan =  mst_ruas_jalan.id",
				'OPERATOR' => NULL
			)
		);
  	}			  
}
?>