<?
class MasterStatusJalanMenu extends CommonMasterTabelMenu{
	public function MasterStatusJalanMenu(){CommonMasterTabelMenu::CommonMasterTabelMenu();}
	public function Name(){return 'Master Status Jalan';}
	public function Tabel(){return 'mst_status_jalan';}
	public function TabelId(){return 'id';}
	public function TabelName(){return 'nama';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>