<?
/**
 * @package Content
 */
class InsertMasterKabupatenContent extends ContentInterface
{
  public function InsertMasterKabupatenContent(){
	ContentInterface::ContentInterface();
  }
  public function Show(ValidatorInterface $v){
  	$Par = $this->Parent();
  	$db = $Par->MakeDatabase();

    $Row = array();
  	$Gui = $Par->MakeGuiFactory();
	$Form = $Gui->MakeForm();
	
	$r = $Gui->MakeSubTitle();
	$r->TextToDisplay = 'Data Kabupaten ';
	$Form->AddRowElement($r);
		
	$r = $Gui->MakeComboBox();
	$r->Name = 'id_mst_propinsi';
	$r->TextToDisplay = 'Propinsi';
	$r->FromQuery(
		new ResultInflectorWrapperDatabase($db), 
			new QueryFilter("
				SELECT
					mst_propinsi.id as id,
					mst_propinsi.nama as name
		
				FROM
					mst_propinsi
				GROUP BY mst_propinsi.id 
					
			",
			new ColModifierResultInflector(
				$Child = new NoResultInflector(),
				new DynamicNameColModifier(
					$Child = new NoColModifier()
				)	
			)	
		)
	);
	$r->Mandatory = true;
	$r->AddValidator(new DefaultValidator());
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeTextBox();
	$r->Name = 'name';
	$r->TextToDisplay = 'Kabupaten / Kota';
	$r->Size = 40;
	$r->Mandatory = true;
	$r->AddValidator(new StringLengthValidator(64,0));
	$Form->AddRowElement($r);
	
	$r = $Gui->MakeBottomButton();
	$r->OnClickMenu = clone($Par->Child());
	$Form->AddRowElement($r);
	
	$Form->Action = new InsertMasterKabupatenHandlerMenu();
	$Form->Action->Next = clone($Par->Child());
	
	$Form->Display($Par, $v);  
  }
  public function Path(){return __FILE__;}
}
?>