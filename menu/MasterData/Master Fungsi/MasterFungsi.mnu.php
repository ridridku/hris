<?
class MasterFungsiMenu extends CommonMasterTabelMenu{
	public function MasterFungsiMenu(){CommonMasterTabelMenu::CommonMasterTabelMenu();}
	public function Name(){return 'Master Fungsi';}
	public function Tabel(){return 'mst_fungsi';}
	public function TabelId(){return 'id';}
	public function TabelName(){return 'nama';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>