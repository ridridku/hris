<?php
require_once FW_DIR . '/constant/RowModifier.cst.php';

class MasterJembatanRowModifier implements RowModifierInterface{
	public function Modify(&$aRow, MenuInterface $modified){
		$Conn = $modified->MakeDatabase();
		$aRow[RowModifierConstant::AddLink] = array();
		
		$DetailMasterJembatan = new DetailMasterJembatanMenu();
		$DetailMasterJembatan->IDJembatan = $aRow['ID Jembatan'];
		$tail = clone($modified);
		$tail->SelectedIDJembatan = $aRow['ID Jembatan'];
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefName] = 'Detail';
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::NewPanel] = true;
#		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::ActivedMainWindow] = false;
#		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelHeight] = 500;
#		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelWidth] = 900;
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::PanelTitle] = $DetailMasterJembatan->Name();
		$aRow[RowModifierConstant::AddLink][0][RowModifierConstant::RefLink] = $DetailMasterJembatan->Ref();
		$itr = 1;
/*		
		$BangunanBawah = new BangunanBawahJembatanMenu();
		$BangunanBawah->IdJembatan = $aRow['ID Jembatan'];
		$tail = clone($modified);
		$tail->SelectedIDJembatan = $aRow['ID Jembatan'];
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::RefName] = 'Bangunan Bawah';
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::NewPanel] = true;
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::ActivedMainWindow] = false;
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::PanelHeight] = 300;
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::PanelWidth] = 800;
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::PanelTitle] = $BangunanBawah->Name();
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::RefLink] = $BangunanBawah->Ref();
		$itr++;
*/
		$UpdateMasterJembatan = new UpdateMasterJembatanMenu();
		$UpdateMasterJembatan->IDJembatan = $aRow['ID Jembatan'];
		$m = clone($modified);
		$tail = clone($modified);
		$tail->SelectedIDJembatan = $aRow['ID Jembatan'];
		$UpdateMasterJembatan->AddTail($tail);
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::RefName] = 'Edit';
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::RefLink] = $UpdateMasterJembatan->Ref();
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_edit.png';		
		$itr++;
		
		$DeleteMasterJembatan = new DeleteMasterJembatanMenu();
		$DeleteMasterJembatan->IDJembatan = $aRow['ID Jembatan'];
		$DeleteMasterJembatan->Next = clone($modified);		
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::RefName] = 'Delete';
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::RefLink] = $DeleteMasterJembatan->Ref();
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::LinkIsImage] = TRUE;
		$aRow[RowModifierConstant::AddLink][$itr][RowModifierConstant::ImageSource] = AppDescriptionQuery::Instance($modified->MakeApplication())->FwRelatifPath() . 'framework/images/b_drop.png';
  }
	public function Selected(&$aRow, MenuInterface $modified){ return
		$modified->SelectedIDJembatan == $aRow['ID Jembatan'];
	}
}
?>