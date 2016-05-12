<?php 

require_once FW_DIR . '/constant/RowModifier.cst.php';

class SurveyKondisiTepiJalanRowModifier implements RowModifierInterface{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();	
    $aRow[RowModifierConstant::AddLink] = array();
	
	$baris = 0;	
	$UpdateSurveyKondisiTepiJalan = new UpdateSurveyKondisiTepiJalanMenu();
	$UpdateSurveyKondisiTepiJalan->IDRuas = $aRow['ID Ruas'];
	$UpdateSurveyKondisiTepiJalan->TimeStamp = $aRow['WaktuSurvey _HIDE_'];
	$UpdateSurveyKondisiTepiJalan->Post = $aRow['Post _HIDE_'];
	$UpdateSurveyKondisiTepiJalan->Offset = $aRow['OffSet _HIDE_'];
	$UpdateSurveyKondisiTepiJalan->IDLajur = $aRow['IDLajur _HIDE_'];
	$UpdateSurveyKondisiTepiJalan->UnixTimeSurvey = $aRow['UnixTimeSurvey _HIDE_'];	
	$tail = clone($modified);
	$tail->SelectedIDRuas = $aRow['ID Ruas'];
	$tail->SelectedTimeStamp = $aRow['WaktuSurvey _HIDE_'];
	$tail->SelectedPost = $aRow['Post _HIDE_'];
	$tail->SelectedOffset = $aRow['OffSet _HIDE_'];
	$tail->SelectedIDJalur = $aRow['IDLajur _HIDE_'];
	$UpdateSurveyKondisiTepiJalan->AddTail($tail);
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Update ';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $UpdateSurveyKondisiTepiJalan->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] =AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';	
	
	$baris++;
	$DeleteSurveyKondisiTepiJalan = new DeleteSurveyKondisiTepiJalanHandlerMenu();
	$DeleteSurveyKondisiTepiJalan->IDRuas = $aRow['ID Ruas'];
	$DeleteSurveyKondisiTepiJalan->TimeStamp = $aRow['WaktuSurvey _HIDE_'];
	$DeleteSurveyKondisiTepiJalan->Post = $aRow['Post _HIDE_'];
	$DeleteSurveyKondisiTepiJalan->Offset = $aRow['OffSet _HIDE_'];
	$DeleteSurveyKondisiTepiJalan->IDLajur = $aRow['IDLajur _HIDE_'];
	$DeleteSurveyKondisiTepiJalan->Next = clone($modified);	
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DeleteSurveyKondisiTepiJalan->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
	}
	public function Selected(&$aRow, MenuInterface $modified){
		return
			$modified->SelectedIDRuas == $aRow['ID Ruas']&&
			$modified->SelectedTimeStamp == $aRow['WaktuSurvey _HIDE_']&&
			$modified->SelectedPost == $aRow['Post _HIDE_']&&
			$modified->SelectedOffset == $aRow['OffSet _HIDE_']&&
			$modified->SelectedIDJalur == $aRow['IDLajur _HIDE_'];
	}
}
?>