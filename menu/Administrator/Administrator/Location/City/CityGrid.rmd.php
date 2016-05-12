<?php 

require_once FW_DIR . '/constant/RowModifier.cst.php';

class CityGridRowModifier implements RowModifierInterface
{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();	
	
    $aRow[RowModifierConstant::AddLink] = array();
	$baris = 0;
	
	$UpdateCity = new UpdateCityMenu();
	$UpdateCity->IdCity = $aRow['IdCity _HIDE_'];
	$tail = clone($modified);
	$tail->SelectedIdCity = $aRow['IdCity _HIDE_'];
	$UpdateCity->AddTail($tail);

	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Update ';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $UpdateCity->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] =AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';
	
	
	$baris++;
	$DeleteRecord = new DeleteCityHandlerMenu();
	$DeleteRecord->IdCity = $aRow['IdCity _HIDE_']; 
	$DeleteRecord->Next = clone($modified);
	
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DeleteRecord->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';



	}
	public function Selected(&$aRow, MenuInterface $modified){
		return 	
			$modified->SelectedIdCity == $aRow['IdCity _HIDE_'];
	}
}
?>