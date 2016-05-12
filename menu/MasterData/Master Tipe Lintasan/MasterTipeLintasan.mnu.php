<?
class MasterTipeLintasanMenu extends CommonMasterTabelMenu{
	public function MasterTipeLintasanMenu(){CommonMasterTabelMenu::CommonMasterTabelMenu();}
	public function Name(){return 'Master Tipe Lintasan';}
	public function Tabel(){return 'mst_bridge_tipe_lintasan';}
	public function TabelId(){return 'id';}
	public function TabelName(){return 'nama';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>