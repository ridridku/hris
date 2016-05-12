<?php 

require_once FW_DIR . '/constant/RowModifier.cst.php';

class SurveyPosisiJembatanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$db = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$baris = 0;		
		$UpdateSurveyPosisiJembatan = new UpdateSurveyPosisiJembatanMenu();
		$UpdateSurveyPosisiJembatan->IDJembatan = $aRow['IDJembatan _HIDE_'];
		$UpdateSurveyPosisiJembatan->IDRuas = $aRow['IDRuas _HIDE_'];
		if(!is_null($aRow['WaktuSurvey _HIDE_'])){
			$TimeStamp = $aRow['WaktuSurvey _HIDE_'];
			$TimeStampTemp = explode(' ', $TimeStamp);
			$TimeFormat1 = explode('-', $TimeStampTemp[0]);
			$TimeFormat2 = explode(':', $TimeStampTemp[1]);
			$TimeFormatResult = $TimeFormat1[0].$TimeFormat1[1].$TimeFormat1[2].$TimeFormat2[0].$TimeFormat2[1].$TimeFormat2[2];
		}
		$UpdateSurveyPosisiJembatan->UnixTimeSurvey = $TimeFormatResult;
		$UpdateSurveyPosisiJembatan->WaktuSurvey = $aRow['WaktuSurvey _HIDE_'];
		$UpdateSurveyPosisiJembatan->Post = $aRow['Post _HIDE_'];
		$UpdateSurveyPosisiJembatan->Offset = $aRow['OffSet _HIDE_'];
		$tail = clone($modified);
		$tail->SelectedIDJembatan = $aRow['IDJembatan _HIDE_'];
		$tail->SelectedIDRuas = $aRow['IDRuas _HIDE_'];
		$tail->SelectedWaktuSurvey = $aRow['WaktuSurvey _HIDE_'];
		$tail->SelectedPost = $aRow['Post _HIDE_'];
		$tail->SelectedOffset = $aRow['OffSet _HIDE_'];
		$UpdateSurveyPosisiJembatan->AddTail($tail);	
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Update ';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $UpdateSurveyPosisiJembatan->Ref();
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] =AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';	
	
		$baris++;
		$DeleteSurveyPosisiJembatan = new DeleteSurveyPosisiJembatanHandlerMenu();
		$DeleteSurveyPosisiJembatan->IDJembatan = $aRow['IDJembatan _HIDE_'];
		$DeleteSurveyPosisiJembatan->IDRuas = $aRow['IDRuas _HIDE_'];
		$DeleteSurveyPosisiJembatan->WaktuSurvey = $aRow['WaktuSurvey _HIDE_'];
		$DeleteSurveyPosisiJembatan->Post = $aRow['Post _HIDE_'];
		$DeleteSurveyPosisiJembatan->Offset = $aRow['OffSet _HIDE_'];
		$DeleteSurveyPosisiJembatan->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::RefLink] = $DeleteSurveyPosisiJembatan->Ref();
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][$baris][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
	}
	public function Selected(&$aRow, MenuInterface $modified){
		return
			$modified->SelectedIDJembatan == $aRow['IDJembatan _HIDE_']&&
			$modified->SelectedIDRuas == $aRow['IDRuas _HIDE_']&&
			$modified->SelectedWaktuSurvey == $aRow['WaktuSurvey _HIDE_']&&
			$modified->SelectedPost == $aRow['Post _HIDE_']&&
			$modified->SelectedOffset == $aRow['OffSet _HIDE_'];
	}
}
?>