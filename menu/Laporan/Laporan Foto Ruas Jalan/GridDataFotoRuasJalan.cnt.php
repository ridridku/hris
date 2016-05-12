<? 
require_once FW_DIR . '/menu/CommonGrid.cnt.php';
require_once FW_DIR . '/constant/RowModifier.cst.php';
require_once 'constant/Session.cst.php';
require_once Framework::ThisFolder(__FILE__) . 'GridDataFotoRuasJalan.rmd.php';

class GridDataFotoRuasJalanContent extends CommonGridContent
{
	public function GridDataFotoRuasJalanContent(){
		CommonGridContent::CommonGridContent();
	}

	public function MakeRowModifier(){return new GridDataFotoRuasJalanRowModifier();}
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
				svy_ruas_jalan.id__mst_ruas_jalan = '".$p->IdRuasJalan."' AND
				svy_ruas_jalan.time_stamp IN(
					SELECT time_stamp 
					FROM svy_drp_ruas_jalan_image
					WHERE id__mst_ruas_jalan = '".$p->IdRuasJalan."'
				)
			GROUP BY name
		");
		$r->Mandatory = true;
		$r->AddValidator(new DefaultValidator());
		$f->AddRowElement($r);
		
	
		$r = $Gui->MakeBottomButton();
		$f->AddRowElement($r);
		
		$f->Action = new GridDataFotoRuasJalanHandlerMenu();
		$f->Action->IdPropinsi = $p->IdPropinsi;
		$f->Action->IdRuasJalan = $p->IdRuasJalan;
		
		$f->Action->Next = new GridDataFotoRuasJalanMenu();
		
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
		return NULL;
	}

	public function TitleString(){return NULL;}
	public function OrderBy(){return array();}
	public function GroupBy(){return array('svy_drp_ruas_jalan_image.post','svy_drp_ruas_jalan_image.offset');}
	public function Tables(){
		return array(
			array('TABLE' => "svy_drp_ruas_jalan_image"),array('TABLE' => "mst_ruas_jalan")		
		);
	}

	public function Fields(){
		return array(
			array(
				'FIELD' => "CONCAT(svy_drp_ruas_jalan_image.post,'.',svy_drp_ruas_jalan_image.offset)",
				'ALIAS' => "Km ",
				'IS_SEARCHED' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan_image.time_stamp",
				'ALIAS' => "Waktu ",
				'IS_SEARCHED' => TRUE
			),			
			array(
				'FIELD' => "svy_drp_ruas_jalan_image.id__mst_ruas_jalan",
				'ALIAS' => "IdRuasJalan _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan_image.time_stamp",
				'ALIAS' => "Time _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan_image.post",
				'ALIAS' => "Post _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan_image.offset",
				'ALIAS' => "OffSet _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "svy_drp_ruas_jalan_image.img_id",
				'ALIAS' => "ImgId _HIDE_",
				'IS_SEARCHED' => FALSE,
				'IS_HIDDEN' => TRUE
			),
			array(
				'FIELD' => "UNIX_TIMESTAMP(time_stamp)",
				'ALIAS' => "unix_time _HIDE_",
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
				'CONDITION' => "svy_drp_ruas_jalan_image.id__mst_ruas_jalan = '".$p->IdRuasJalan."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_drp_ruas_jalan_image.time_stamp = '".$p->Time."'",
				'OPERATOR' => "AND"
			),
			array(
				'CONDITION' => "svy_drp_ruas_jalan_image.id__mst_ruas_jalan =  mst_ruas_jalan.id",
				'OPERATOR' => NULL
			)
		);
  	}			  
}
?>