<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class MasterKabupatenRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$UpdateData = new UbahMasterkabupatenMenu();
		$UpdateData->IdKabupaten = $aRow['Kode'];
		$m = clone($modified);
		$tail = clone($modified);
		$tail->IdKabupaten = $aRow['Kode'];
		$UpdateData->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdateData->Ref();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		
		$HapusData = new DeleteMasterKabupatenHandlerMenu();
		$HapusData->IdKabupaten = $aRow['Kode'];
#		$tail = clone($modified);
#		$tail->IdKabupaten = $aRow['IdKabupaten'];
#		$HapusData->AddTail($tail);
		$HapusData->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $HapusData->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  }
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->IdKabupaten == $aRow['Kode'];
	}
}
?>