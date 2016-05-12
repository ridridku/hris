<?php 

require_once FW_DIR . '/constant/RowModifier.cst.php';

class SurveyPerkerasanJalanRowModifier implements RowModifierInterface{
  public function Modify(&$aRow, MenuInterface $modified){
  	$db = $modified->MakeDatabase();	
    $aRow[RowModifierConstant::AddLink] = array();
	
	$baris = 0;	
	$Update = new UpdateSurveyPerkerasanJalanMenu();
	$Update->IdRuasJalan = $aRow['ID Ruas'];
	$Update->TimeStamp = $aRow['WaktuSurvey _HIDE_'];
	$Update->Post = $aRow['Post _HIDE_'];
	$Update->Offset = $aRow['OffSet _HIDE_'];
	$Update->IdLajur = $aRow['IdLajur _HIDE_'];
	$Update->IdPerkerasan = $aRow['IdPerkerasan _HIDE_'];	
	$tail = clone($modified);
	$tail->IdRuasJalan = $aRow['ID Ruas'];
	$tail->TimeStamp = $aRow['WaktuSurvey _HIDE_'];
	$tail->Post = $aRow['Post _HIDE_'];
	$tail->OffSet = $aRow['OffSet _HIDE_'];
	$tail->IdJalur = $aRow['IdLajur _HIDE_'];
	$tail->IdPerkerasan = $aRow['IdPerkerasan _HIDE_'];
	$Update->AddTail($tail);
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Update ';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $Update->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] =AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';	
	
	$baris++;
	$Hapus = new DeleteSurveyPerkerasanJalanHandlerMenu();
	$Hapus->IdRuasJalan = $aRow['ID Ruas'];
	$Hapus->TimeStamp = $aRow['WaktuSurvey _HIDE_'];
	$Hapus->Post = $aRow['Post _HIDE_'];
	$Hapus->Offset = $aRow['OffSet _HIDE_'];
	$Hapus->IdLajur = $aRow['IdLajur _HIDE_'];
	$Hapus->IdPerkerasan = $aRow['IdPerkerasan _HIDE_'];
	$Hapus->Next = clone($modified);	
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $Hapus->Ref();
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
	$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
	}
	public function Selected(&$aRow, MenuInterface $modified){
		return
			$modified->IdRuasJalan == $aRow['ID Ruas']&&
			$modified->TimeStamp == $aRow['WaktuSurvey _HIDE_']&&
			$modified->Post == $aRow['Post _HIDE_']&&
			$modified->OffSet == $aRow['OffSet _HIDE_']&&
			$modified->IdJalur == $aRow['IdLajur _HIDE_'] &&
			$modified->IdPerkerasan == $aRow['IdPerkerasan _HIDE_'];
	}
}
?>