<?php 

require_once FW_DIR . '/constant/RowModifier.cst.php';

class XhrSurveyRoadGridRowModifier implements RowModifierInterface
{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();	
	
    $aRow[RowModifierConstant::AddLink] = array();
	$baris = 0;
	
	$UpdateSurveyRoad = new UpdateSurveyRoadMenu();
	$UpdateSurveyRoad->IdLocRoad = $aRow['IdLocRoad _HIDE_'];
	$UpdateSurveyRoad->TimeStamp = $aRow['TimeStamp _HIDE_'];
	$tail = clone($modified);
	$tail->SelectedIdLocRoad = $aRow['IdLocRoad _HIDE_'];
	$tail->SelectedTimeStamp = $aRow['TimeStamp _HIDE_'];
	$UpdateSurveyRoad->AddTail($tail);

	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Update ';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $UpdateSurveyRoad->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] =AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';
	
	
	$baris++;
	$DeleteRecord = new DeleteSurveyRoadHandlerMenu();
	$DeleteRecord->IdLocRoad = $aRow['IdLocRoad _HIDE_']; 
	$DeleteRecord->TimeStamp = $aRow['TimeStamp _HIDE_'];
	$DeleteRecord->Next = clone($modified);
	
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DeleteRecord->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';



	}
	public function Selected(&$aRow, MenuInterface $modified){
		return 	
			$modified->SelectedIdLocRoad == $aRow['IdLocRoad _HIDE_'] && 
			$modified->SelectedTimeStamp == $aRow['TimeStamp _HIDE_'];
	}
}
?>