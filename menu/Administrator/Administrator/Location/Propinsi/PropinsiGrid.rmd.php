<?php 

require_once FW_DIR . '/constant/RowModifier.cst.php';

class PropinsiGridRowModifier implements RowModifierInterface
{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();	
	
    $aRow[RowModifierConstant::AddLink] = array();
	$baris = 0;
	
	$UpdatePropinsi = new UpdatePropinsiMenu();
	$UpdatePropinsi->IdPropinsi = $aRow['IdPropinsi _HIDE_'];
	$tail = clone($modified);
	$tail->SelectedIdPropinsi = $aRow['IdPropinsi _HIDE_'];
	$UpdatePropinsi->AddTail($tail);

	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Update ';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $UpdatePropinsi->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] =AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';
	
	
	$baris++;
	$DeleteRecord = new DeletePropinsiHandlerMenu();
	$DeleteRecord->IdPropinsi = $aRow['IdPropinsi _HIDE_']; 
	$DeleteRecord->Next = clone($modified);
	
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DeleteRecord->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';



	}
	public function Selected(&$aRow, MenuInterface $modified){
		return 	
			$modified->SelectedIdPropinsi == $aRow['IdPropinsi _HIDE_'];
	}
}
?>