<?php 

require_once FW_DIR . '/constant/RowModifier.cst.php';

class SectionGridRowModifier implements RowModifierInterface
{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();	
	
    $aRow[RowModifierConstant::AddLink] = array();
	$baris = 0;
	
	$UpdateSection = new UpdateSectionMenu();
	$UpdateSection->IdSection = $aRow['IdSection _HIDE_'];
	$tail = clone($modified);
	$tail->SelectedIdSection = $aRow['IdSection _HIDE_'];
	$UpdateSection->AddTail($tail);

	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Update ';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $UpdateSection->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] =AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';
	
	
	$baris++;
	$DeleteRecord = new DeleteSectionHandlerMenu();
	$DeleteRecord->IdSection = $aRow['IdSection _HIDE_']; 
	$DeleteRecord->Next = clone($modified);
	
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DeleteRecord->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';



	}
	public function Selected(&$aRow, MenuInterface $modified){
		return 	
			$modified->SelectedIdSection == $aRow['IdSection _HIDE_'];
	}
}
?>