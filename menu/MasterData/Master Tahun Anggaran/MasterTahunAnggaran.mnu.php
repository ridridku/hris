<?
class MasterTahunAnggaranMenu extends CommonMasterTabelMenu{
	public function MasterTahunAnggaranMenu(){CommonMasterTabelMenu::CommonMasterTabelMenu();}
	public function Name(){return 'Master Tahun Anggaran';}
	public function Tabel(){return 'mst_tahun_anggaran';}
	public function TabelId(){return 'id';}
	public function TabelName(){return 'nama';}
	public function MakeFrame(){return SimpajatanFrame::Instance();}
	public function MakeDatabase(){return SimpajatanMySqlDatabase::Instance();}
	public function MakeApplication(){return SimpajatanApplication::Instance();}}
?>