<?
class MasterKondisiJalanMenu extends CommonMasterTabelMenu{
	public function MasterKondisiJalanMenu(){CommonMasterTabelMenu::CommonMasterTabelMenu();}
	public function Name(){return 'Master Kondisi Jalan';}
	public function Tabel(){return 'mst_kondisi_jalan';}
	public function TabelId(){return 'id';}
	public function TabelName(){return 'nama';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>