<?
class MasterTipeJalanMenu extends CommonMasterTabelMenu{
	public function MasterTipeJalanMenu(){CommonMasterTabelMenu::CommonMasterTabelMenu();}
	public function Name(){return 'Master Tipe Jalan';}
	public function Tabel(){return 'mst_tipe_jalan';}
	public function TabelId(){return 'id';}
	public function TabelName(){return 'nama';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>