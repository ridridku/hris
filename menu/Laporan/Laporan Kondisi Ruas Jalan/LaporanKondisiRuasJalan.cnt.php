<?
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'LaporanKondisiRuasJalan.rmd.php';

class LaporanKondisiRuasJalanContent extends CommonGridContent
{
	public function LaporanKondisiRuasJalanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new LaporanKondisiRuasJalanRowModifier();}
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
					FROM svy_kondisi_ruas_jalan
					WHERE id__mst_ruas_jalan = '".$p->IdRuasJalan."'
				)
			GROUP BY name
		");
		$r->Mandatory = true;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);	
		
		
		
		$r = $Gui->MakeBottomButton();
		$f->AddRowElement($r);
		
		$f->Action = new LaporanKondisiRuasJalanHandlerMenu();
		$f->Action->IdPropinsi = $p->IdPropinsi;
		$f->Action->IdRuasJalan = $p->IdRuasJalan;
		
		$f->Action->Next = new LaporanKondisiRuasJalanMenu();
		
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
		$m = new LaporanKondisiRuasJalanMenu();
		$m->IdPropinsi = $p->IdPropinsi;				
		$m->IdRuasJalan = $p->IdRuasJalan;
		$m->Time  = $p->Time ;
		
		
		
		$Grafik = new GrafikKondisiJalanMenu();	
		$Grafik->IdPropinsi = $p->IdPropinsi;	
		$Grafik->IdRuasJalan = $p->IdRuasJalan;
		$Grafik->Waktu  = $p->Time ;
		$m->AddTail($Grafik);
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Grafik';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $m->Ref();
#		$Link[0][RowModifierConstant::BottomLink__NewWindow] = true;

/*
		$Grafik = new GrafikKondisiJalanMenu();	
		$Grafik->IdPropinsi = $p->IdPropinsi;		
		$Grafik->IdRuasJalan = $p->IdRuasJalan;
		$Grafik->Waktu  = $p->Time ;
		$Link[0][RowModifierConstant::BottomLink__Name] = 'Grafik';
		$Link[0][RowModifierConstant::BottomLink__RefLink] = $Grafik->Ref();
		$Link[0][RowModifierConstant::BottomLink__NewWindow] = true;

*/		$cetak = new CetakGrafikKondisiJalanMenu();
		$Grafik->IdPropinsi = $p->IdPropinsi;	
		$cetak->IdRuasJalan = $p->IdRuasJalan;
		$cetak->Waktu  = $p->Time ;
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
			array('TABLE' => "svy_kondisi_ruas_jalan"),array('TABLE' => "mst_ruas_jalan")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "CONCAT(svy_kondisi_ruas_jalan.post,' / ',svy_kondisi_ruas_jalan.offset)",
				'ALIAS' => "Km Awal / Km Akhir",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "(SELECT nama
							 FROM mst_lajur
							 WHERE
							 	mst_lajur.id  = svy_kondisi_ruas_jalan.id__mst_lajur)",
				'ALIAS' => "Lajur ",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "(SELECT nama
							 FROM mst_kondisi_jalan
							 WHERE
							 	mst_kondisi_jalan.id  = svy_kondisi_ruas_jalan.id__mst_kondisi_jalan)",
				'ALIAS' => "Kondisi ",
				'IS_SEARCHED' => TRUE
			),			
			array(
				'FIELD' => "svy_kondisi_ruas_jalan.id__mst_ruas_jalan",
				'ALIAS' => "IdRuasJalan _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_kondisi_ruas_jalan.timestamp",
				'ALIAS' => "Time _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_kondisi_ruas_jalan.post",
				'ALIAS' => "Post _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_kondisi_ruas_jalan.offset",
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
				'CONDITION' => "svy_kondisi_ruas_jalan.id__mst_ruas_jalan = '".$p->IdRuasJalan."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_kondisi_ruas_jalan.timestamp = '".$p->Time."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_kondisi_ruas_jalan.id__mst_lajur IN
				('".LajurConstant::KA1."',
				 '".LajurConstant::KA2."',
				 '".LajurConstant::KI1."',				 
				 '".LajurConstant::KI2."')",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_kondisi_ruas_jalan.id__mst_ruas_jalan =  mst_ruas_jalan.id",
				'OPERATOR' => NULL
			)
		);
  	}			  
}


























































































































































/*


		$r = $Gui->MakeSubTitle();
		$r->TextToDisplay = 'Filter';
		$f->AddRowElement($r);
		
  		if(is_null($p->IdPropinsi)) $p->IdPropinsi = 5;
		$r = $Gui->MakeComboBox();
		$r->Name = 'id_propinsi';
		$r->TextToDisplay = 'Propinsi';
		$r->ItemSelected = $p->IdPropinsi;
		$r->OnChange = "
			  for(var i=0; i<this.childNodes.length; i++){
				 oneChild = this.childNodes[i];
				 if(oneChild.selected){
				 	this.AccessUrl('?Menu=' + oneChild.OnChangeMenu);
					return;
				 }
			  }";
		$rsl = $db->Execute("
			SELECT id AS id, nama AS nama 
			FROM `mst_propinsi` 
			ORDER BY nama
		");
		
		$i = 0;
		while($R = $db->FetchObject($rsl)){
			$m = new RequestCandidatePilihanPropinsiMenu();
			$m->IdPropinsi = $R->id;
			$r->Result[$i][ComboBoxConstant::Title] = "
				this.OnChangeMenu = '" . $m->Ref() ."';
			";
			$r->Result[$i][ComboBoxConstant::Value] = $R->id;
			$r->Result[$i][ComboBoxConstant::Label] = $R->nama;
			$r->Result[$i][ComboBoxConstant::Output] = $R->nama;
			$i++;
		}
		$r->Mandatory = true;
		$r->AddValidator(new ComboBoxValidator($r));
		$f->AddRowElement($r);
		
		$r = $Gui->MakeComboBox();
		$r->Name = 'id_ruas_jalan';
		$r->TextToDisplay = 'Ruas Jalan';
		$r->FromQuery($db,"
			SELECT
				id AS id,
				CONCAT(id,' | ',nama_ruas,'    ' ) AS name
			FROM mst_ruas_jalan
			WHERE id__mst_propinsi = '". (is_null($p->IdPropinsi)?5:$p->IdPropinsi) ."'
			ORDER BY name
		");
		$r->Title = "
			this.HandleReceiveString[this.HandleReceiveString.length] = function(sender, txt){
				if(txt.Id == 'RequestCandidatePilihanPropinsiMenu'){
					while(sender.length > 0)sender.remove(0);
					if(txt.nama != null){
						for(var i=0; i<txt.nama.length; i++){
							var elm_select = document.createElement('option');
							elm_select.label = (txt.nama[i]);
							elm_select.value = txt.id[i];
							elm_select.text = (txt.nama[i]); 
							sender.add(elm_select, null);
						}
					}	
				}
				return true;
			};
		";
		$r->Mandatory = true;
		$r->ItemSelected = $p->IdRuasJalan;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
		if(!is_null($p->Time))$TimeData = explode(' ', $p->Time);
		
		$r = $Gui->MakeDateField();
		$r->TextToDisplay = 'Tanggal Survey';
		$r->Name = 'date';
		$r->Value  = $TimeData[0];
		$r->AddValidator(new DateFormatValidator(NULL, NULL));
		$f->AddRowElement($r);
		
		$r = $Gui->MakeTextBox();
		$r->TextToDisplay = 'Waktu Survey';
		$r->Name = 'time';
		$r->Size = 20;
		$r->MaxLength = 8;
		$r->Value  = $TimeData[1];
		$r->Attribute = 'hh:mm:ss';
		$r->AddValidator(new StringLengthValidator(8, 1));
		$f->AddRowElement($r);
*/
?>