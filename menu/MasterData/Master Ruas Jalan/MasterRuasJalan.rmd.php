<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class MasterRuasJalanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['ID Ruas'];
		
		
		$MasterRuasJalan = new DetailMasterRuasJalanMenu();
		$MasterRuasJalan->Kode = $aRow['ID Ruas'];
		
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Detail';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::NewPanel] = true;
#		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ActivedMainWindow] = false;
#		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelHeight] = 400;
#		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelWidth] = 900;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelTitle] = $MasterRuasJalan->Name();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $MasterRuasJalan->Ref();

		$UpdateMasterRuasJalan = new UpdateMasterRuasJalanMenu();
		$UpdateMasterRuasJalan->Kode = $aRow['ID Ruas'];
		$UpdateMasterRuasJalan->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::RefLink] = $UpdateMasterRuasJalan->Ref();
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][1][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		
		$DeleteMasterRuasJalan = new DeleteMasterRuasJalanMenu();
		$DeleteMasterRuasJalan->Kode = $aRow['ID Ruas'];
		/*
		$tail = clone($modified);
		$tail->SelectedKode = $aRow['ID Ruas'];
		$DeleteMasterRuasJalan->AddTail($tail);
		*/
		$DeleteMasterRuasJalan->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::RefLink] = $DeleteMasterRuasJalan->Ref();
		$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][2][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  }
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->SelectedKode == $aRow['ID Ruas'];
	}
}
?>