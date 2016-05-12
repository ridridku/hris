<?php 

require_once FW_DIR . '/constant/RowModifier.cst.php';

class SurveyKondisiJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$db = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$baris = 0;		
		$ubah = new UpdateSurveyKondisiJalanMenu();
		$ubah->IdRuasJalan = $aRow['IdRuasJalan _HIDE_'];
		$ubah->Time = $aRow['Time _HIDE_'];
		$ubah->Post = $aRow['Post _HIDE_'];
		$ubah->Offset = $aRow['OffSet _HIDE_'];
		$ubah->IdLajur = $aRow['IdLajur _HIDE_'];
		$tail = clone($modified);
		$tail->IdRuasJalan = $aRow['ID Ruas'];
		$tail->Time = $aRow['Time _HIDE_'];
		$tail->Post = $aRow['Post _HIDE_'];
		$tail->Offset = $aRow['OffSet _HIDE_'];
		$tail->IdLajur = $aRow['IdLajur _HIDE_'];
		$ubah->AddTail($tail);	
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Update ';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $ubah->Ref();
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] =AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';	
	
		$baris++;
		$DeleteRecord = new DeleteSurveyKondisiJalanHandlerMenu();
		$DeleteRecord->IDRuas = $aRow['ID Ruas'];
		$DeleteRecord->WaktuSurvey = $aRow['Time _HIDE_'];
		$DeleteRecord->Post = $aRow['Post _HIDE_'];
		$DeleteRecord->Offset = $aRow['OffSet _HIDE_'];
		$DeleteRecord->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DeleteRecord->Ref();
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
	}
	public function Selected(&$aRow, MenuInterface $modified){
		return
			$modified->IdRuasJalan == $aRow['ID Ruas']&&
			$modified->Time == $aRow['Time _HIDE_']&&
			$modified->Post == $aRow['Post _HIDE_']&&
			$modified->Offset == $aRow['OffSet _HIDE_'] &&
			$modified->IdLajur == $aRow['IdLajur _HIDE_'];		
	}
}
?>