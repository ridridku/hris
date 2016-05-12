<?
/**
 * @package Content
 */
class UbahMasterKabupatenContent extends ContentInterface
{
  public function UbahMasterKabupatenContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$p = $this->Parent();
  	$db = $p->MakeDatabase();
	
	$sql = "
			SELECT *
			FROM
				mst_kabupaten_or_kodya
			WHERE
				id = '".$p->IdKabupaten."'
		";
	$rsl = $db->Execute($sql);
	$recSql = $db->FetchObject($rsl);
	

  	$Gui = $p->MakeGuiFactory();
	$Form = $Gui->MakeForm();
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Data Kabupaten ';
	$Form->AddRowElement($r);
		
	$r = $Gui->MakeComboBox();
	$r->Name = 'id_mst_propinsi';
	$r->TextToDisplay = 'Propinsi';
	$r->ItemSelected = $recSql->id_mst_propinsi;
	$r->FromQuery($db,"
				SELECT
					mst_propinsi.id as id,
					mst_propinsi.nama as name
		
				FROM
					mst_propinsi
				GROUP BY mst_propinsi.id 
					
	");
	$r->Mandatory = true;
	$r->AddValidator(new DefaultValidator());
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeTextBox();
	$r->Name = 'name';
	$r->TextToDisplay = 'Kabupaten / Kota';
	$r->Value = $recSql->name;
	$r->Size = 40;
	$r->Mandatory = true;
	$r->AddValidator(new StringLengthValidator(64,0));
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeBottomButton();
	$r->OnClickMenu = clone($p->Child());
	$Form->AddRowElement($r);
	
	$Form->Action = new UbahMasterKabupatenHandlerMenu();
	$Form->Action->IdKabupaten = $p->IdKabupaten;
	$Form->Action->Next = clone($p/*->Child()*/);
	
	$Form->Display($p, $v);  
  }
  public function Path(){return __FILE__;}
}
?>