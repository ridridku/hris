<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class MasterPropinsiRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		
		$UpdateMasterPropinsi = new UpdateMasterPropinsiMenu();
		$UpdateMasterPropinsi->Kode = $aRow['Kode'];
		$UpdateMasterPropinsi->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdateMasterPropinsi->Ref();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		
		$DeleteMasterPropinsi = new DeleteMasterPropinsiMenu($aRow['NIP']);
		$DeleteMasterPropinsi->Kode = $aRow['Kode'];
	/*	$tail = clone($modified);
		$tail->SelectedKode = $aRow['Kode'];
		$DeleteMasterPropinsi->AddTail($tail);
	*/	$DeleteMasterPropinsi->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $DeleteMasterPropinsi->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  }
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->SelectedKode == $aRow['Kode'];
	}
}
?>