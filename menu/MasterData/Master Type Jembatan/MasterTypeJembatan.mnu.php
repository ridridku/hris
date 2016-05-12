<?
class MasterTypeJembatanMenu extends CommonMasterTabelMenu{
	public function MasterTypeJembatanMenu(){CommonMasterTabelMenu::CommonMasterTabelMenu();}
	public function Name(){return 'Master Type Jembatan';}
	public function Tabel(){return 'mst_type_bridge';}
	public function TabelId(){return 'id';}
	public function TabelName(){return 'nama';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>