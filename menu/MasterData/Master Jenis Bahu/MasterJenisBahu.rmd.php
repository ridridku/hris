<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class MasterJenisBahuRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$UpdateMasterJenisBahu = new UpdateMasterJenisBahuMenu();
		$UpdateMasterJenisBahu->IDJenisBahu = $aRow['ID Jenis Bahu'];
		$tail = clone($modified);
		$tail->SelectedIDJenisBahu = $aRow['ID Jenis Bahu'];
		$UpdateMasterJenisBahu->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $UpdateMasterJenisBahu->Ref();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		
		$DeleteMasterJenisBahu = new DeleteMasterJenisBahuMenu();
		$DeleteMasterJenisBahu->IDJenisBahu = $aRow['ID Jenis Bahu'];
		/*$tail = clone($modified);
		$tail->SelectedIDJenisBahu = $aRow['ID Jenis Bahu'];
		$DeleteMasterJenisBahu->AddTail($tail);*/
		$DeleteMasterJenisBahu->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $DeleteMasterJenisBahu->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  	}
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->SelectedIDJenisBahu == $aRow['ID Jenis Bahu'];
	}
}
?>