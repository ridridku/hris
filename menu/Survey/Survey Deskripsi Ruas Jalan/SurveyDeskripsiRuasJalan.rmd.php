<?php 

require_once FW_DIR . '/constant/RowModifier.cst.php';

class SurveyDeskripsiRuasJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$db = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$baris = 0;		
		$UpdateSurveyDeskripsiRuasJalan = new UpdateSurveyDeskripsiRuasJalanMenu();
		$UpdateSurveyDeskripsiRuasJalan->IDRuas = $aRow['ID Ruas'];
		$UpdateSurveyDeskripsiRuasJalan->WaktuSurvey = $aRow['WaktuSurvey _HIDE_'];
		$UpdateSurveyDeskripsiRuasJalan->Post = $aRow['Post _HIDE_'];
		$UpdateSurveyDeskripsiRuasJalan->Offset = $aRow['OffSet _HIDE_'];
		$UpdateSurveyDeskripsiRuasJalan->IdLajur = $aRow['IdLajur _HIDE_'];
		$tail = clone($modified);
		$tail->IDRuas = $aRow['ID Ruas'];
		$tail->WaktuSurvey = $aRow['WaktuSurvey _HIDE_'];
		$tail->Post = $aRow['Post _HIDE_'];
		$tail->Offset = $aRow['OffSet _HIDE_'];
		$tail->IdLajur = $aRow['IdLajur _HIDE_'];
		$UpdateSurveyDeskripsiRuasJalan->AddTail($tail);	
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Update ';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $UpdateSurveyDeskripsiRuasJalan->Ref();
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] =AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';	
	
		$baris++;
		$DeleteRecord = new DeleteSurveyDeskripsiRuasJalanHandlerMenu();
		$DeleteRecord->IDRuas = $aRow['ID Ruas'];
		$DeleteRecord->WaktuSurvey = $aRow['WaktuSurvey _HIDE_'];
		$DeleteRecord->Post = $aRow['Post _HIDE_'];
		$DeleteRecord->Offset = $aRow['OffSet _HIDE_'];
		$DeleteRecord->IdLajur = $aRow['IdLajur _HIDE_'];
		$DeleteRecord->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DeleteRecord->Ref();
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
	}
	public function Selected(&$aRow, MenuInterface $modified){
		return
			$modified->IDRuas == $aRow['ID Ruas']&&
			$modified->WaktuSurvey == $aRow['WaktuSurvey _HIDE_']&&
			$modified->Post == $aRow['Post _HIDE_']&&
			$modified->Offset == $aRow['OffSet _HIDE_'] &&
			$modified->IdLajur == $aRow['IdLajur _HIDE_'];		
	}
}
?>