<?php 
require_once FW_DIR . '/constant/RowModifier.cst.php';

class SearchMasterRuasJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$db = $modified->MakeDatabase();   
		$aRow[RowModifierConstant::AddLink] = array();

		if($modified->Child() != NULL){
			$m = clone($modified->Child());
			$m->Kode = $aRow['ID Ruas'];
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Pilih';
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $m->DownToTailRef();
		}else{
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Pilih';
			$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = NULL;
		}

		$UpdateMasterRuasJalan = new UpdateMasterRuasJalanMenu();
		$UpdateMasterRuasJalan->Kode = $aRow['ID Ruas'];
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['ID Ruas'];
		$UpdateMasterRuasJalan->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $UpdateMasterRuasJalan->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';
	}
	public function Selected(&$aRow, MenuInterface $modified){
		return $modified->SelectedKode == $aRow['ID Ruas'];}
}
?>