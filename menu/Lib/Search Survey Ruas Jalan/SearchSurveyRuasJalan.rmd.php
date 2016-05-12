<?php 
require_once FW_DIR . '/constant/RowModifier.cst.php';

class SearchSurveyRuasJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$db = $modified->MakeDatabase();   
		$aRow[RowModifierConstant::AddLink] = array();

		if($modified->Child() != NULL){
			$m = clone($modified->Child());
			$m->SearchIDRuas = $aRow['ID Ruas'];
			$m->SearchTimeStamp = $aRow['Waktu Survey'];
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Pilih';
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $m->DownToTailRef();
		}else{
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Pilih';
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = NULL;
		}

		$UpdateSurveyRuasJalan = new UpdateSurveyRoadMenu();
		$UpdateSurveyRuasJalan->IdLocRoad = $aRow['ID Ruas'];
		$UpdateSurveyRuasJalan->TimeStamp = $aRow['Waktu Survey'];
		$tail = clone($modified);
		$tail->SelectedIdLocRoad = $aRow['ID Ruas'];
		$tail->SelectedTimeStamp = $aRow['Waktu Survey'];
		$UpdateSurveyRuasJalan->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $UpdateSurveyRuasJalan->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';
	}
	public function Selected(&$aRow, MenuInterface $modified){
		return
			$modified->SelectedIdLocRoad == $aRow['ID Ruas']&& 
			$modified->SelectedTimeStamp == $aRow['Waktu Survey'];
		}
	}
?>